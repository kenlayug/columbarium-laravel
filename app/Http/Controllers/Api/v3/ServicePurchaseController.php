<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Customer;
use App\AdditionalPrice;
use App\ServicePrice;
use App\PackagePrice;
use App\ApiModel\v2\TransactionPurchase;
use App\ApiModel\v2\TransactionPurchaseDetail;
use App\ApiModel\v2\ScheduleDay;
use App\ApiModel\v2\ScheduleDetail;
use App\ApiModel\v2\ScheduleDetailLog;
use App\ApiModel\v2\Deceased;

use Carbon\Carbon;

class ServicePurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            \DB::beginTransaction();

            $deciTotalAmountToPay       =   0;

            $customer = Customer::whereRaw("CONCAT(strLastName, ', ',strFirstName, ' ', strMiddleName) = '".$request->strCustomerName."'")
                ->first(['intCustomerId']);

            if ($customer == null){

                return response()
                    ->json(
                            [
                                'message'       =>  'Customer does not exist.'
                            ],
                            500
                        );

            }//end if

            $transactionPurchase            =   TransactionPurchase::create([
                    'intCustomerIdFK'       =>  $customer->intCustomerId,
                    'intPaymentType'        =>  $request->intPaymentType != null? $request->intPaymentType : 0,
                    'intPaymentMode'        =>  $request->intPaymentMode,
                    'deciAmountPaid'        =>  $request->deciAmountPaid
                ]);

            foreach ($request->cartList as $cartObject) {
            
                if (array_key_exists('intAdditionalId', $cartObject)){

                    $additionalPrice            =   AdditionalPrice::where('intAdditionalIdFK', '=', $cartObject['intAdditionalId'])
                        ->orderBy('created_at', 'desc')
                        ->first([
                            'intAdditionalPriceId',
                            'deciPrice'
                            ]);

                    $deciTotalAmountToPay       +=  ($additionalPrice->deciPrice * $cartObject['intQuantity']);

                    $transactionPurchaseDetail  =   TransactionPurchaseDetail::create([
                        'intTPurchaseIdFK'          =>  $transactionPurchase->intTransactionPurchaseId,
                        'intTPurchaseDetailType'    =>  1,
                        'intAdditionalIdFK'         =>  $cartObject['intAdditionalId'],
                        'intAdditionalPriceIdFK'    =>  $additionalPrice->intAdditionalPriceId,
                        'intQuantity'               =>  $cartObject['intQuantity']
                        ]);

                }else if (array_key_exists('intServiceId', $cartObject)){

                    $servicePrice           =   ServicePrice::where('intServiceIdFK', '=', $cartObject['intServiceId'])
                        ->orderBy('created_at', 'desc')
                        ->first([
                            'intServicePriceId',
                            'deciPrice'
                            ]);

                    $deciTotalAmountToPay       +=  ($servicePrice->deciPrice * $cartObject['intQuantity']);

                    $transactionPurchaseDetail  =   TransactionPurchaseDetail::create([
                        'intTPurchaseIdFK'          =>  $transactionPurchase->intTransactionPurchaseId,
                        'intTPurchaseDetailType'    =>  2,
                        'intServiceIdFK'            =>  $cartObject['intServiceId'],
                        'intServicePriceIdFK'       =>  $servicePrice->intServicePriceId,
                        'intQuantity'               =>  $cartObject['intQuantity']
                        ]);

                    $status         =   $this->saveSchedule($cartObject['serviceList'], $transactionPurchaseDetail->intTPurchaseDetailId, $customer->intCustomerId);

                    if ($status == 'error'){

                        \DB::rollback();
                        return response()
                            ->json(
                                    [
                                        'message'       =>  'One or more services are not yet configured.'
                                    ],
                                    500
                                );

                    }

                }else if (array_key_exists('intPackageId', $cartObject)){

                    $packagePrice           =   PackagePrice::where('intPackageIdFK', '=', $cartObject['intPackageId'])
                        ->orderBy('created_at', 'desc')
                        ->first([
                            'intPackagePriceId',
                            'deciPrice'
                            ]);

                    $deciTotalAmountToPay       +=  ($packagePrice->deciPrice * $cartObject['intQuantity']);

                    $transactionPurchaseDetail  =   TransactionPurchaseDetail::create([
                        'intTPurchaseIdFK'          =>  $transactionPurchase->intTransactionPurchaseId,
                        'intTPurchaseDetailType'    =>  3,
                        'intPackageIdFK'            =>  $cartObject['intPackageId'],
                        'intPackagePriceIdFK'       =>  $packagePrice->intPackagePriceId,
                        'intQuantity'               =>  $cartObject['intQuantity']
                        ]);

                    $status         =   $this->saveSchedule($cartObject['serviceList'], $transactionPurchaseDetail->intTPurchaseDetailId, $customer->intCustomerId);

                    if ($status == 'error'){

                        \DB::rollback();
                        return response()
                            ->json(
                                    [
                                        'message'       =>  'One or more services are not yet configured.'
                                    ],
                                    500
                                );

                    }

                }//end else if

            }//end foreach

            if ($deciTotalAmountToPay > $request->deciAmountPaid){

                \DB::rollback();
                return response()
                    ->json(
                        [
                            'message'       =>  'Amount to pay is greater than amount paid.'
                        ],
                        500
                        );

            }

            \DB::commit();
            return response()
                ->json(
                        [
                            'message'       =>  'Transaction is successfully processed.'
                        ],
                        200
                    );

        }catch(Exception $e){

            \DB::rollback();
            return response()
                ->json(
                        [
                            'message'   =>  $e->getMessage()
                        ],
                        500
                    );

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveSchedule($serviceList, $intTransactionPurchaseDetailId, $intCustomerId){

        foreach($serviceList as $service){

            if (!array_key_exists('scheduleTime', $service) || !array_key_exists('strDeceasedName', $service)){

                return 'error';

            }

            $deceased = Deceased::whereRaw("CONCAT(strLastName, ', ',strFirstName, ' ', strMiddleName) = '".$service['strDeceasedName']."'")
                ->first();

            $scheduleTime       =   $service['scheduleTime'];
            $dateSchedule       =   Carbon::parse($scheduleTime['dateSchedule'])->toDateString();

            $scheduleDay        =   ScheduleDay::where('dateSchedule', '=', $dateSchedule)
                ->first([
                    'intScheduleDayId'
                    ]);

            if ($scheduleDay == null){

                $scheduleDay    =   ScheduleDay::create([
                    'dateSchedule'      =>  $dateSchedule
                    ]);

            }//end if

            $scheduleDetail         =   ScheduleDetail::create([
                'intSchedServiceIdFK'       =>  $scheduleTime['intSchedServiceId'],
                'intScheduleDayIdFK'        =>  $scheduleDay->intScheduleDayId,
                'intTPDetailIdFK'           =>  $intTransactionPurchaseDetailId,
                'strRemarks'                =>  '',
                'intMinuteDelayCaused'      =>  0,
                'intDeceasedIdFK'           =>  $deceased->intDeceasedId
                ]);

            $scheduleDetailLog      =   ScheduleDetailLog::create([
                'intSDIdFK'         =>  $scheduleDetail->intScheduleDetailId,
                'intScheduleStatus' =>  2
                ]);

            $deceased->intCustomerIdFK          =   $intCustomerId;
            $deceased->save();

        }//end foreach

        return 'success';

    }//end function
}