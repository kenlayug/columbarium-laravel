<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Carbon\Carbon;
use Guzzle;

use App\Business\v1\SmsGateway;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;

use App\ApiModel\v3\Notification;

class CheckNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks new notification.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{

            DB::beginTransaction();
            $downpaymentList            =   Downpayment::select(
                'tblDownpayment.intDownpaymentId',
                'tblDownpayment.boolNotFullWarning',
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblCustomer.intGender',
                'tblCustomer.intCivilStatus',
                'tblCustomer.strContactNo',
                'tblUnit.intColumnNo',
                'tblUnitCategory.intLevelNo',
                'tblUnitCategoryPrice.deciPrice',
                'tblBlock.intBlockNo',
                'tblRoom.strRoomName',
                'tblFloor.intFloorNo',
                'tblBuilding.strBuildingName',
                'tblBuilding.strBuildingCode'
                )
                ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
                ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblDownpayment.intUnitIdFK')
                ->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
                ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
                ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
                ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
                ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
                ->where('tblDownpayment.boolPaid', '=', false)
                ->where('tblDownpayment.dateDueDate', '<=', Carbon::today()
                    ->addDays(7))
                ->get();

            $this->info($downpaymentList->count().' is found.');

            foreach($downpaymentList as $downpayment){

                $notification       =   Notification::where('intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
                    ->first();

                if (!$notification){

                    $notification   =   Notification::create([
                        'intDownpaymentIdFK'        =>  $downpayment->intDownpaymentId,
                        'intNotificationType'       =>  1
                        ]);

                    $deciTotalDownpayment           =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
                        ->sum('deciAmountPaid');

                    $downpaymentBD                  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                        ->first(['deciBusinessDependencyValue']);

                    $deciAmountToPay                =   $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue;

                    $smsGateway     =   new SmsGateway();
                    $deviceNo       =   env('GATEWAY_ID', '123');

                    $strPrefixName  =   $downpayment->intGender == 1? 'Mr.' : ($downpayment->intCivilStatus == 1? 'Ms.' : 'Mrs.');

                    $strMessagePartOne     =   '1/3 Good day '.$strPrefixName.' '.$downpayment->strFirstName.'. We want to remind you that your downpayment for Unit '.$downpayment->intUnitIdFK.' is not yet complete.';

                    $strMessagePartTwo      =   '2/3 You still have 7 days to finish your balance. Your current balance is P'.number_format($deciAmountToPay - $deciTotalDownpayment).'. If balance is not finished within these days, reservation will be forfeited.';

                    $strMessagePartThree    =   '3/3 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

                    $number             =   $downpayment->strContactNo;

                    $response           =   Guzzle::post(
                        'http://smsgateway.me/api/v3/messages/send',
                        [
                            'form_params'       =>  [
                                'email'     =>  env('GATEWAY_EMAIL', 'localhost@yahoo.com'),
                                'password'  =>  env('GATEWAY_PASSWORD', 'password'),
                                'device'    =>  env('GATEWAY_ID', '123'),
                                'number'    =>  $number,
                                'message'   =>  $strMessagePartOne
                            ]
                        ]
                        );

                    $response           =   Guzzle::post(
                        'http://smsgateway.me/api/v3/messages/send',
                        [
                            'form_params'       =>  [
                                'email'     =>  env('GATEWAY_EMAIL', 'localhost@yahoo.com'),
                                'password'  =>  env('GATEWAY_PASSWORD', 'password'),
                                'device'    =>  env('GATEWAY_ID', '123'),
                                'number'    =>  $number,
                                'message'   =>  $strMessagePartTwo
                            ]
                        ]
                        );

                    $response           =   Guzzle::post(
                        'http://smsgateway.me/api/v3/messages/send',
                        [
                            'form_params'       =>  [
                                'email'     =>  env('GATEWAY_EMAIL', 'localhost@yahoo.com'),
                                'password'  =>  env('GATEWAY_PASSWORD', 'password'),
                                'device'    =>  env('GATEWAY_ID', '123'),
                                'number'    =>  $number,
                                'message'   =>  $strMessagePartThree
                            ]
                        ]
                        );

                    $this->info('Message sent to '.$downpayment->strContactNo);

                    $downpayment->boolNotFullWarning       =   true;
                    $downpayment->save();


                }//end if

            }//end foreach

            DB::commit();

            $this->info('Notifications are sent.');

        }catch(Exception $e){

            DB::rollBack();

        }//end try catch
    }
}
