<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Carbon\Carbon;
use Guzzle;

use App\Business\v1\NotificationBusiness;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\CollectionPayment;
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
                'tblDownpayment.dateDueDate',
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

                    (new NotificationBusiness())
                        ->sendDueDownpayment($downpayment);

                }//end if

            }//end foreach

            $collectionList         =   $this->checkNotifCollection();
            $this->info('Collection = '.sizeof($collectionList));

            foreach($collectionList as $collection){

                $notification       =   Notification::where('intCollectionIdFK', '=', $collection->intCollectionId)
                    ->first();

                if (!$notification){

                    $notification   =   Notification::create([
                        'intCollectionIdFK'     =>  $collection->intCollectionId,
                        'intNotificationType'   =>  2
                        ]);

                    (new NotificationBusiness())
                        ->sendDueCollection($collection);

                }//end if

            }//end foreach

            DB::commit();

            $this->info('Notifications are sent.');

        }catch(Exception $e){

            DB::rollBack();

        }//end try catch
    }

    public function checkNotifCollection(){

        $collectionList             =   Collection::where('boolFinish', '=', false)
            ->get();

        $collectionListWithOverDue  =   array();

        foreach($collectionList as $collection){

            $collectionLastPayment      =   CollectionPayment::select(
                'tblCollectionPaymentDetail.dateDue'
                )
                ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                ->where('tblCollectionPayment.intCollectionIdFK', '=', $collection->intCollectionId)
                ->orderBy('tblCollectionPayment.created_at', 'desc')
                ->orderBy('tblCollectionPaymentDetail.dateDue', 'desc')
                ->first();

            if ($collectionLastPayment){

                if (Carbon::parse($collectionLastPayment->dateDue)->addMonth() <= Carbon::today()->addDays(7)){

                    array_push($collectionListWithOverDue, $collection);

                }//end if

            }//end if
            else{

                if (Carbon::parse($collection->dateCollectionStart) <= Carbon::today()->addDays(7)){

                    array_push($collectionListWithOverDue, $collection);

                }//end function

            }//end else

        }//end foreach

        return $collectionListWithOverDue;

    }//end function
}
