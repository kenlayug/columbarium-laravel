<?php

namespace App\Http\Controllers\Api\v2;

use App\AdditionalPrice;
use App\ApiModel\v2\ScheduleDay;
use App\ApiModel\v2\ScheduleDetail;
use App\ApiModel\v2\ScheduleDetailLog;
use App\ApiModel\v2\TransactionPurchase;
use App\ApiModel\v2\TransactionPurchaseDetail;
use App\Customer;
use App\PackagePrice;
use App\ServicePrice;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TransactionPurchaseController extends Controller
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
            $intPaymentType     =   0;

            if ($request->boolFuture == 1){
                $intPaymentType     =   $request->intPaymentType;
            }

            $customer = Customer::whereRaw("CONCAT(strLastName, ', ',strFirstName, ' ', strMiddleName) = '".$request->strCustomerName."'")
                ->first(['intCustomerId']);

            if ($customer == null){

                return response()
                    ->json(
                        [
                            'error'     =>  'Customer does not exist.'
                        ],
                        500
                    );

            }

            if ($request->deciTotalAmountToPay > $request->deciAmountPaid){

                return response()
                    ->json(
                        [
                            'error'     =>  'Amount to pay is greater than amount paid.'
                        ],
                        500
                    );

            }//end if

            $transactionPurchase    =   TransactionPurchase::create([
                'intCustomerIdFK'       =>  $customer->intCustomerId,
                'intPaymentType'        =>  $intPaymentType,
                'intPaymentMode'        =>  $request->intPaymentMode,
                'deciAmountPaid'        =>  $request->deciAmountPaid
            ]);

            foreach ($request->selectedAdditionalList as $selectedAdditional){

                if ($selectedAdditional['intQuantity'] == null){

                    \DB::rollBack();
                    return response()
                        ->json(
                            [
                                'error'     =>  'Quantity cannot be blank.'
                            ],
                            500
                        );

                }//end if

                $additionalPrice            =   AdditionalPrice::where('intAdditionalIdFK', '=', $selectedAdditional['intAdditionalId'])
                                                    ->orderBy('created_at', 'desc')
                                                    ->first();

                $transactionPurchaseDetail  =   TransactionPurchaseDetail::create([
                    'intTPurchaseIdFK'          =>  $transactionPurchase->intTransactionPurchaseId,
                    'intTPurchaseDetailType'    =>  1,
                    'intAdditionalIdFK'         =>  $selectedAdditional['intAdditionalId'],
                    'intAdditionalPriceIdFK'    =>  $additionalPrice->intAdditionalPriceId,
                    'intQuantity'               =>  $selectedAdditional['intQuantity']
                ]);

            }//end foreach additional

            $serviceList        =   $request->serviceList;

            foreach ($request->selectedServiceList as $selectedService){

                if ($selectedService['intQuantity'] == null){

                    \DB::rollBack();
                    return response()
                        ->json(
                            [
                                'error'     =>  'Quantity cannot be blank.'
                            ],
                            500
                        );

                }//end if

                $servicePrice                   =   ServicePrice::where('intServiceIdFK', '=', $selectedService['intServiceId'])
                                                        ->orderBy('created_at', 'desc')
                                                        ->first();

                $transactionPurchaseDetail      =   TransactionPurchaseDetail::create([
                    'intTPurchaseIdFK'          =>  $transactionPurchase->intTransactionPurchaseId,
                    'intTPurchaseDetailType'    =>  2,
                    'intServiceIdFK'            =>  $selectedService['intServiceId'],
                    'intServicePriceIdFK'       =>  $servicePrice->intServicePriceId,
                    'intQuantity'               =>  $selectedService['intQuantity']
                ]);

                for ($intCtr = 0; $intCtr < $selectedService['intQuantity']; $intCtr++){

                    $intIndex   =   -1;
                    foreach ($serviceList as $service){

                        $intIndex++;

                        if ($service['intServiceId'] == $selectedService['intServiceId']
                            && !array_key_exists('intPackageIdFK', $service)){

                            $schedule           =   $service['schedule'];
                            $scheduleDate       =   Carbon::parse($schedule['dateSchedule'])->toDateString();

                            $scheduleDay        =   ScheduleDay::whereDate('dateSchedule', '=', $scheduleDate)
                                                        ->first();

                            if ($scheduleDay == null){

                                $scheduleDay    =   ScheduleDay::create([
                                    'dateSchedule'      =>  $scheduleDate
                                ]);

                            }//end if

                            $scheduleDetail     =   ScheduleDetail::create([
                                'intSchedServiceIdFK'       =>  $schedule['intSchedServiceId'],
                                'intScheduleDayIdFK'        =>  $scheduleDay->intScheduleDayId,
                                'intTPDetailIdFK'           =>  $transactionPurchaseDetail->intTPurchaseDetailId,
                                'strRemarks'                =>  '',
                                'intMinuteDelayCaused'      =>  0
                            ]);
                            
                            $sDLog              =   ScheduleDetailLog::create([
                                'intSDIdFK'                 =>  $scheduleDetail->intScheduleDetailId,
                                'intScheduleStatus'         =>  2
                            ]);

                            unset($serviceList[$intIndex]);

                        }//end if

                    }//end foreach

                }//end for

            }//end foreach

            foreach ($request->selectedPackageList as $selectedPackage){

                if ($selectedPackage['intQuantity'] == null){

                    \DB::rollBack();
                    return response()
                        ->json(
                            [
                                'error'         =>  'Quantity cannot be blank.'
                            ],
                            500
                        );

                }//end if

                $packagePrice               =   PackagePrice::where('intPackageIdFK', '=', $selectedPackage['intPackageId'])
                                                    ->orderBy('created_at', 'desc')
                                                    ->first();

                $transactionPurchaseDetail  =   TransactionPurchaseDetail::create([
                    'intTPurchaseIdFK'          =>  $transactionPurchase->intTransactionPurchaseId,
                    'intTPurchaseDetailType'    =>  3,
                    'intPackageIdFK'            =>  $selectedPackage['intPackageId'],
                    'intPackagePriceIdFK'       =>  $packagePrice->intPackagePriceId,
                    'intQuantity'               =>  $selectedPackage['intQuantity']
                ]);

                for ($intCtr = 0; $intCtr < $selectedPackage['intQuantity']; $intCtr++){

                    $intIndex   =   -1;

                    foreach ($serviceList as $service){

                        $intIndex++;
                        if ($service['intPackageIdFK'] == $selectedPackage['intPackageId']){

                            $schedule           =   $service['schedule'];
                            $scheduleDate       =   Carbon::parse($schedule['dateSchedule'])->toDateString();

                            $scheduleDay        =   ScheduleDay::where('dateSchedule', '=', $scheduleDate)
                                                        ->first();

                            if ($scheduleDay == null){

                                $scheduleDay    =   ScheduleDay::create([
                                    'dateSchedule'      =>  $scheduleDate
                                ]);

                            }//end if

                            $scheduleDetail     =   ScheduleDetail::create([
                                'intSchedServiceIdFK'       =>  $schedule['intSchedServiceId'],
                                'intScheduleDayIdFK'        =>  $scheduleDay->intScheduleDayId,
                                'intTPDetailIdFK'           =>  $transactionPurchaseDetail->intTPurchaseDetailId,
                                'strRemarks'                =>  '',
                                'intMinuteDelayCaused'      =>  0
                            ]);

                            $sDLog              =   ScheduleDetailLog::create([
                                'intSDIdFK'                 =>  $scheduleDetail->intScheduleDetailId,
                                'intScheduleStatus'         =>  2
                            ]);

                            unset($serviceList[$intIndex]);

                        }//end if

                    }//end foreach

                }//end for

            }//end foreach

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>  'Transaction is successfully processed!'
                    ],
                    201
                );

        }catch(\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'         =>  $e->getMessage()
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
}
