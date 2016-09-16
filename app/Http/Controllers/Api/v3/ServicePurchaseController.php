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
use App\Unit;
use App\ApiModel\v2\TransactionPurchase;
use App\ApiModel\v2\TransactionPurchaseDetail;
use App\ApiModel\v2\ScheduleDay;
use App\ApiModel\v2\ScheduleDetail;
use App\ApiModel\v2\ScheduleDetailLog;
use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\UnitDeceased;
use App\ApiModel\v2\UnitTypeStorage;

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

            $customer = Customer::find($request->intCustomerId);

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

                    if (array_key_exists('serviceList', $cartObject)){

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

                        }//end if

                    }//end if

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

            foreach($request->deceasedList as $deceased){

                if (array_key_exists('intermentInfo', $deceased)){

                    $intermentInfo          =   $deceased['intermentInfo'];

                    $unitDeceased           =   UnitDeceased::select(
                        'intStorageTypeIdFK'
                        )
                        ->where('intUnitIdFK', '=', $intermentInfo['intUnitId'])
                        ->get();

                    if ($unitDeceased != null && sizeof($unitDeceased) > 0){

                        $unit               =   Unit::select(
                            'tblRoomType.intRoomTypeId'
                            )
                            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
                            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
                            ->where('tblUnit.intUnitId', '=', $intermentInfo['intUnitId'])
                            ->first();

                        $storageType        =   UnitTypeStorage::select(
                            'tblUnitTypeStorage.intQuantity'
                            )
                            ->where('intUnitTypeIdFK', '=', $unit->intRoomTypeId)
                            ->where('intStorageTypeIdFK', '=', $unitDeceased[0]->intStorageTypeIdFK)
                            ->first();

                        if ($storageType->intQuantity == $unitDeceased->count()){

                            \DB::rollBack();
                            return response()
                                ->json(
                                    [
                                        'message'       =>  'Unit is full.'
                                    ],
                                    500
                                );

                        }//end if

                    }//end if

                    $unitDeceased           =   UnitDeceased::create([
                        'intDeceasedIdFK'       =>  $deceased['intDeceasedId'],
                        'intUnitIdFK'           =>  $intermentInfo['intUnitId'],
                        'intStorageTypeIdFK'    =>  $intermentInfo['intStorageTypeId']
                        ]);

                    $deceasedInfo           =   Deceased::where('intDeceasedId', '=', $deceased['intDeceasedId'])
                        ->first();

                    $deceasedInfo->dateInterment        =   $intermentInfo['dateInterment'];
                    $deceasedInfo->timeInterment        =   $intermentInfo['timeInterment'];

                    $deceasedInfo->save();

                }//end if

            }//end foreach

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

            $deceased = Deceased::find($service['intDeceasedId']);

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

    public function getReports($id, Request $request){

        $dateTo             =   Carbon::parse($request->dateTo)
            ->setTime(23, 59, 59);
        $dateFrom           =   Carbon::parse($request->dateFrom)
            ->setTime(0, 0, 0);

        $transactionPurchaseList            =   TransactionPurchase::select(
            'tblTransactionPurchase.intTransactionPurchaseId',
            'tblTransactionPurchase.created_at',
            'tblTPurchaseDetail.intTPurchaseDetailType',
            'tblAdditional.strAdditionalName',
            'tblAdditionalPrice.deciPrice AS additionalPrice',
            'tblService.strServiceName',
            'tblServicePrice.deciPrice AS servicePrice',
            'tblPackage.strPackageName',
            'tblPackagePrice.deciPrice AS packagePrice',
            'tblTPurchaseDetail.intQuantity',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblTransactionPurchase.intCustomerIdFK')
            ->join('tblTPurchaseDetail', 'tblTransactionPurchase.intTransactionPurchaseId', '=', 'tblTPurchaseDetail.intTPurchaseIdFK')
            ->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblTPurchaseDetail.intServiceIdFK')
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblTPurchaseDetail.intServicePriceIdFK')
            ->leftJoin('tblAdditional', 'tblAdditional.intAdditionalId', '=', 'tblTPurchaseDetail.intAdditionalIdFK')
            ->leftJoin('tblAdditionalPrice', 'tblAdditionalPrice.intAdditionalPriceId', '=', 'tblTPurchaseDetail.intAdditionalIdFK')
            ->leftJoin('tblPackage', 'tblPackage.intPackageId', '=', 'tblTPurchaseDetail.intPackageIdFK')
            ->leftJoin('tblPackagePrice', 'tblPackagePrice.intPackagePriceId', '=', 'tblTPurchaseDetail.intPackagePriceIdFK')
            ->whereBetween('tblTransactionPurchase.created_at', [$dateFrom->toDateTimeString(), $dateTo->toDateTimeString()]);

        return response()
            ->json(
                    [
                        'transactionPurchaseList'       =>
                          ($id == 0)? $transactionPurchaseList->get() : 
                                    $transactionPurchaseList->where('tblTransactionPurchase.intTransactionPurchaseId', '=', $id)
                                        ->get()
                    ],
                    200
                );

    }

    public function getWeeklyStatistics($dateNow){

        $dateNow            =   Carbon::parse($dateNow);
        $weekStart          =   $dateNow->startOfWeek();
        $weeklyStatisticList    =   [];

        for ($intCtr    =   0; $intCtr < 7; $intCtr++){
            $dayStatistic       =   $this->queryTotalDay($weekStart);
            array_push($weeklyStatisticList, $dayStatistic);
            $weekStart->addDay();
        }//end for
        return response()
            ->json(
                    [
                        'weeklyStatisticList'       =>  $weeklyStatisticList
                    ],
                    200
                );
    }//end public function getWeeklyStatistics

    public function getMonthlyStatistics($dateNow){
        $dateNow            =   Carbon::parse($dateNow);
        $dateStartMonth     =   $dateNow->startOfMonth();
        $intNoOfMonth       =   intval($dateNow->daysInMonth);
        $monthStatisticList  =   array();
        for($intCtr     =   0; $intCtr < $intNoOfMonth; $intCtr++){
            $monthStatistic  =   $this->queryTotalDay($dateStartMonth);
            array_push($monthStatisticList, $monthStatistic);
            $dateStartMonth->addDay();
        }//end for
        return response()
            ->json(
                [
                    'monthStatisticList'     =>  $monthStatisticList,
                    'intNoOfMonth'            =>  $intNoOfMonth
                ],
                200
            );
    }//end function

    public function getQuarterlyStatistics($dateNow){
        
        $dateNow            =   Carbon::parse($dateNow);
        $intQuarter         =   $dateNow->quarter - 1;
        $quarterMonth       =   Carbon::createFromDate($dateNow->year, ($intQuarter*3)+1, 1);

        $quarterStatisticList       =   array();
        $quarterMonthList           =   array();

        for ($intCtr = 0; $intCtr < 3; $intCtr++){

            $quarterStatistic       =   $this->queryTotalMonth($quarterMonth);
            array_push($quarterStatisticList, $quarterStatistic);
            array_push($quarterMonthList, $quarterMonth->toDateString());
            $quarterMonth->addMonth();

        }//end for

        return response()
            ->json(
                [
                    'quarterStatisticList'      =>  $quarterStatisticList,
                    'quarterMonthList'          =>  $quarterMonthList
                ],
                200
            );

    }//end function

    public function getYearlyStatistics($dateNow){

        $dateNow            =   Carbon::parse($dateNow);
        $dateYearStart      =   $dateNow->startOfYear();

        $yearStatisticList      =   array();

        for ($intCtr = 0; $intCtr < 4; $intCtr++){

            $yearStatistic          =   $this->queryTotalQuarter($dateYearStart);
            array_push($yearStatisticList, $yearStatistic);
            $dateYearStart->startOfMonth()->addMonth();

        }//end for

        return response()
            ->json(
                [
                    'yearStatisticList'     =>  $yearStatisticList
                ],
                200
            );

    }//end function

    public function queryTotalWeek($dateFilter){
        return $this->queryTotalSales()
            ->whereBetween('tblTransactionPurchase.created_at', 
                [$dateFilter->startOfWeek()->startOfDay()->toDateTimeString(),
                 $dateFilter->endOfWeek()->endOfDay()->toDateTimeString()])
            ->first();
    }//end function

    public function queryTotalSales(){
        $deciTotalSales         =   TransactionPurchase::select(
            DB::raw('SUM(tblTPurchaseDetail.intQuantity * tblAdditionalPrice.deciPrice) as deciAdditionalTotalSales'),
            DB::raw('SUM(tblTPurchaseDetail.intQuantity * tblServicePrice.deciPrice) as deciServiceTotalSales'),
            DB::raw('SUM(tblTPurchaseDetail.intQuantity * tblPackagePrice.deciPrice) as deciPackageTotalSales'))
            ->leftJoin('tblTPurchaseDetail', 'tblTransactionPurchase.intTransactionPurchaseId', '=', 'tblTPurchaseDetail.intTPurchaseIdFK')
            ->leftJoin('tblAdditionalPrice', 'tblAdditionalPrice.intAdditionalPriceId', '=', 'tblTPurchaseDetail.intAdditionalPriceIdFK')
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblTPurchaseDetail.intServicePriceIdFK')
            ->leftJoin('tblPackagePrice', 'tblPackagePrice.intPackagePriceId', '=', 'tblTPurchaseDetail.intPackagePriceIdFK');
        return $deciTotalSales;
    }//end public function

    public function queryTotalDay($dateFilter){
        $from           =   $dateFilter->startOfDay()->toDateTimeString();
        $to             =   $dateFilter->endOfDay()->toDateTimeString();
        return $this->queryTotalSales()
            ->whereBetween('tblTransactionPurchase.created_at', 
                [$from, $to])
            ->first();
    }//end function

    public function queryTotalMonth($dateFilter){
        return $this->queryTotalSales()
            ->whereBetween('tblTransactionPurchase.created_at',
                [$dateFilter->startOfMonth()->startOfDay()->toDateTimeString(),
                 $dateFilter->endOfMonth()->endOfDay()->toDateTimeString()])
            ->first();
    }//end function

    public function queryTotalQuarter($dateFilter){
        $dateStart          =   $dateFilter->startOfMonth()->startOfDay()->toDateTimeString();
        $dateEnd            =   $dateFilter->addMonths(2)->endOfMonth()->endOfDay()->toDateTimeString();
        return $this->queryTotalSales()
            ->whereBetween('tblTransactionPurchase.created_at',
                [$dateStart, $dateEnd])
            ->first();
    }

}
