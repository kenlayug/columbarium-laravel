<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;

use App;

use App\ApiModel\v3\TransactionUnitDetail;
use App\ApiModel\v3\AssignDiscount;
use App\ApiModel\v3\DiscountRate;
use App\ApiModel\v3\DownpaymentDiscount;

use App\ReservationDetail;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Business\v1\SmsGateway;
use App\Business\v1\CollectionBusiness;
use App\Business\v1\PenaltyBusiness;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DownpaymentController extends Controller
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
        try {

            \DB::beginTransaction();

            $collection       =   null;

            $payment = DownpaymentPayment::create([
                'intDownpaymentIdFK' => $request->intDownpaymentId,
                'intPaymentType' => $request->intPaymentType,
                'deciAmountPaid' => $request->deciAmountPaid
            ]);

            $downpayment = Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                            ->where('tblDownpayment.intDownpaymentId', '=', $request->intDownpaymentId)
                            ->first(['tblUnitCategoryPrice.deciPrice', 'tblDownpayment.intUnitIdFK']);

            $paymentPaid = DownpaymentPayment::where('intDownpaymentIdFK', '=', $request->intDownpaymentId)
                                ->sum('deciAmountPaid');

            $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                ->first();

            $discountList       =   DownpaymentDiscount::select(
                'intDiscountRateIdFK'
                )
                ->where('intDownpaymentIdFK', '=', $request->intDownpaymentId)
                ->get();

            foreach($discountList as $discount){

                $discountRate       =   DiscountRate::select(
                    'deciDiscountRate',
                    'intDiscountType'
                    )
                    ->where('intDiscountRateId', '=', $discount->intDiscountRateIdFK)
                    ->orderBy('created_at', 'desc')
                    ->first();

                $discount->deciDiscountRate         =   $discountRate->deciDiscountRate;
                $discount->intDiscountType          =   $discountRate->intDiscountType;

            }//end foreach

            $downpaymentPrice   =   $downpayment->deciPrice*$downpaymentPercentage->deciBusinessDependencyValue;

            $dateNow                =   Carbon::today();
            $dateWithDiscount       =   Carbon::parse($downpayment->created_at)->addDays(7);

            if ($dateNow <= $dateWithDiscount){

                $deciDiscount       =   0;
                foreach($discountList as $discount){

                    if ($discount->intDiscountType == 1){

                        $deciDiscount       +=  ($downpaymentPrice * $discount->deciDiscountRate);

                    }//end if
                    else{

                        $deciDiscount       +=  $discount->deciDiscountRate;

                    }//end else

                }//end foreach
                $downpaymentPrice        -=  $deciDiscount;

            }//end if

            $unitId             =   $downpayment->intUnitIdFK;

            $downpaymentFinished = false;
            if ($downpaymentPrice-$paymentPaid <= 0){
                $downpayment            =   Downpayment::find($request->intDownpaymentId);
                $downpayment->boolPaid  =   true;
                $downpayment->save();
                $downpaymentFinished    =   true;

                $unit                   =   Unit::find($downpayment->intUnitIdFK);

                $transactionUnit        =   TransactionUnitDetail::where('intUnitIdFK', '=', $downpayment->intUnitIdFK)
                    ->orderBy('created_at', 'desc')
                    ->first(['intTransactionType']);

                if ($transactionUnit->intTransactionType == 2){

                    $unit->intUnitStatus    =   5;
                    $unit->save();

                }//end if
                else if ($transactionUnit->intTransactionType == 4){

                    $unit->intUnitStatus    =   7;
                    $unit->save();

                }//end else if

                $startDate = Carbon::parse($downpayment->created_at)->addMonth(1);
                $collection = Collection::create([
                    'intCustomerIdFK'               =>  $downpayment->intCustomerIdFK,
                    'intUnitIdFK'                   =>  $downpayment->intUnitIdFK,
                    'intUnitCategoryPriceIdFK'      =>  $downpayment->intUnitCategoryPriceIdFK,
                    'intInterestRateIdFK'           =>  $downpayment->intInterestRateIdFK,
                    'dateCollectionStart'           =>  $startDate
                ]);

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'downpayment'       =>  $payment,
                        'message'           =>  'Payment is successfully processed.',
                        'paid'              =>  $downpaymentFinished,
                        'intUnitId'         =>  $unitId,
                        'downpaymentPrice'  =>  $downpaymentPrice,
                        'collection'        =>  $collection,
                        'balance'           =>  $downpaymentPrice-$paymentPaid
                    ],
                    201
                );

        }catch (\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  'Something occurred.',
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

    public function deleteDueDateDownpayment(){

        try {

            \DB::beginTransaction();

            $this->sendWarningDeadlines();

            $downpaymentList = Downpayment::leftJoin('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
                ->where('tblDownpayment.boolPaid', '=', false)
                ->whereNull('tblDownpaymentPayment.intDownpaymentPaymentId')
                ->groupBy('tblDownpayment.intDownpaymentId')
                ->get([
                    'tblDownpayment.intDownpaymentId',
                    'tblDownpayment.intCustomerIdFK',
                    'tblDownpayment.intUnitIdFK',
                    'tblDownpayment.created_at'
                ]);

            $voidDownpaymentNoPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
                ->first();

            $voidDownpaymentNotFullPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
                ->first();

            foreach ($downpaymentList as $downpayment) {

                $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNoPayment->deciBusinessDependencyValue);
                $current = Carbon::now();

                if ($current >= $date) {

                    $downpayment->delete();

                    $unit = Unit::find($downpayment->intUnitIdFK);
                    $unit->intUnitStatus = 1;
                    $unit->save();

                }

            }

            $downpaymentList = Downpayment::where('tblDownpayment.boolPaid', '=', false)
                                ->get([
                                    'tblDownpayment.intDownpaymentId',
                                    'tblDownpayment.created_at',
                                    'tblDownpayment.intUnitIdFK'
                                ]);

            foreach ($downpaymentList as $downpayment) {

                $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNotFullPayment->deciBusinessDependencyValue);
                $current = Carbon::now();

                if ($current >= $date) {
                    $downpayment->delete();

                    $unit = Unit::find($downpayment->intUnitIdFK);
                    $unit->intUnitStatus        =   1;
                    $unit->intCustomerIdFK      =   null;
                    $unit->save();
                }

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>      'Deleted downpayment due dates...'
                    ],
                    200
                );

        }catch (\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'     =>  $e->getMessage()
                    ],
                    500
                );

        }

    }

    public function getAllPayments($id){

        $paymentList            =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $id)
                                        ->get();
        $totalAmountPaid        =   0;
        foreach ($paymentList as $payment){

            $totalAmountPaid += $payment->deciAmountPaid;

        }
        $downpayment            =   Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                                        ->where('tblDownpayment.intDownpaymentId', '=', $id)
                                        ->first([
                                            'tblUnitCategoryPrice.deciPrice'
                                        ]);

        $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                        ->first();

        $balance        =   ($downpayment->deciPrice * $downpaymentPercentage->deciBusinessDependencyValue) - $totalAmountPaid;

        return response()
            ->json(
                [
                    'paymentList'   =>  $paymentList,
                    'balance'       =>  $balance
                ],
                200
            );

    }//end function

    public function getBalance($id){

        $paymentList            =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $id)
                                        ->get();
        $totalAmountPaid        =   0;
        foreach ($paymentList as $payment){

            $totalAmountPaid += $payment->deciAmountPaid;

        }

        $downpayment            =   Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                                        ->where('tblDownpayment.intDownpaymentId', '=', $id)
                                        ->first([
                                            'tblUnitCategoryPrice.deciPrice'
                                        ]);

        $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                        ->first();

        $balance        =   ($downpayment->deciPrice * $downpaymentPercentage->deciBusinessDependencyValue) - $totalAmountPaid;

        return $balance;

    }

    public function sendWarningDeadlines(){

        $smsGateway     =   new SmsGateway();
        $deviceNo       =   env('GATEWAY_ID', '123');

        $voidDownpaymentNoPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
                ->first();

        $voidDownpaymentNotFullPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
            ->first();

        $downpaymentList = Downpayment::leftJoin('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->whereNull('tblDownpaymentPayment.intDownpaymentPaymentId')
            ->groupBy('tblDownpayment.intDownpaymentId')
            ->get([
                'tblDownpayment.intDownpaymentId',
                'tblDownpayment.intCustomerIdFK',
                'tblDownpayment.intUnitIdFK',
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblCustomer.intGender',
                'tblCustomer.intCivilStatus',
                'tblCustomer.strContactNo',
                'tblDownpayment.created_at',
                'tblDownpayment.boolNoPaymentWarning'
            ]);

        $currentDate                =   Carbon::today();

        foreach($downpaymentList as $downpayment){

            $downpaymentWarningDate        =   Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNoPayment->deciBusinessDependencyValue - 3);

            if (($downpaymentWarningDate->isToday() || $downpaymentWarningDate < $currentDate) && !($downpayment->boolNoPaymentWarning)){

                $strPrefixName  =   $downpayment->intGender == 1? 'Mr.' : ($downpayment->intCivilStatus == 1? 'Ms.' : 'Mrs.');

                $strMessagePartOne     =   '1/3 Good day '.$strPrefixName.' '.$downpayment->strFirstName.'. We want to remind you that no payment has been made within the last 4 days in your downpayment at the Columbarium.';

                $strMessagePartTwo      =   '2/3 After 3 more days, your reservation will be forfeited. To prevent this from happening, please make your first payment transaction within the following days.';

                $strMessagePartThree    =   '3/3 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

                $number             =   $downpayment->strContactNo;

                $result1             =   $smsGateway->sendMessageToNumber($number, $strMessagePartOne, $deviceNo);
                $result2             =   $smsGateway->sendMessageToNumber($number, $strMessagePartTwo, $deviceNo);
                $result3             =   $smsGateway->sendMessageToNumber($number, $strMessagePartThree, $deviceNo);

                if ($result1['response']['success']){

                    $downpayment->boolNoPaymentWarning       =   true;
                    $downpayment->save();

                }//end if

            }//end if


        }//end foreach

        $intCtr = 0;

        $downpaymentList = Downpayment::join('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->groupBy('tblDownpayment.intDownpaymentId')
            ->get([
                'tblDownpayment.intDownpaymentId',
                'tblDownpayment.created_at',
                'tblDownpayment.intUnitIdFK',
                'tblDownpayment.boolNotFullWarning',
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblCustomer.intGender',
                'tblCustomer.intCivilStatus',
                'tblCustomer.strContactNo',
                'tblDownpayment.intUnitIdFK'
            ]);

            foreach ($downpaymentList as $downpayment) {

                $deciBalance            =   $this->getBalance($downpayment->intDownpaymentId);

                $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNotFullPayment->deciBusinessDependencyValue - 7);

                if (($currentDate >= $date || $date->isToday()) && !($downpayment->boolNotFullWarning)) {
                    
                    $intCtr++;

                    $strPrefixName  =   $downpayment->intGender == 1? 'Mr.' : ($downpayment->intCivilStatus == 1? 'Ms.' : 'Mrs.');

                    $strMessagePartOne     =   '1/3 Good day '.$strPrefixName.' '.$downpayment->strFirstName.'. We want to remind you that your downpayment for Unit '.$downpayment->intUnitIdFK.' is not yet complete.';

                    $strMessagePartTwo      =   '2/3 You still have 7 days to finish your balance. Your current balance is P'.number_format($deciBalance).'. If balance is not finished within these days, reservation will be forfeited.';

                    $strMessagePartThree    =   '3/3 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

                    $number             =   $downpayment->strContactNo;

                    $result             =   $smsGateway->sendMessageToNumber($number, $strMessagePartOne, $deviceNo);
                    $result             =   $smsGateway->sendMessageToNumber($number, $strMessagePartTwo, $deviceNo);
                    $result             =   $smsGateway->sendMessageToNumber($number, $strMessagePartThree, $deviceNo);

                    if ($result['response']['success']){

                        $downpayment->boolNotFullWarning       =   true;
                        $downpayment->save();

                    }//end if

                }//end if

            }//end foreach

    }//end function


    public function getTabularReport($dateFrom, $dateTo){

        return response()
            ->json(
                [
                    'reportList'        =>  $this->queryTabularReport($dateFrom, $dateTo)
                ],
                200
            );

    }//end function

    public function getWeeklyStatistics($dateFilter){

        $weekStart          =   Carbon::parse($dateFilter);
        $weekStatisticList  =   array();

        for($intCtr = 0; $intCtr < 7; $intCtr++){

            $weekStatistic      =   $this->queryPerDay($weekStart);
            array_push($weekStatisticList, $weekStatistic);
            $weekStart->addDay();

        }//end for

        return response()
            ->json(
                [
                    'weekStatisticList'     =>  $weekStatisticList
                ],
                200
            );

    }//end function

    public function getMonthlyStatistics($dateFilter){

        $monthStart             =   Carbon::parse($dateFilter)
            ->startOfMonth();
        $monthStatisticList     =   array();
        $intNoOfDay             =   $monthStart->daysInMonth;

        for ($intCtr = 0; $intCtr < $intNoOfDay; $intCtr++){

            $monthStatistic         =   $this->queryPerDay($monthStart);
            array_push($monthStatisticList, $monthStatistic);
            $monthStart->addDay();

        }//end for

        return response()
            ->json(
                [
                    'monthStatisticList'        =>  $monthStatisticList,
                    'intNoOfDay'                =>  $intNoOfDay
                ],
                200
            );

    }//end function

    public function getQuarterlyStatistics($dateFilter){

        $dateFilter             =   Carbon::parse($dateFilter);
        $quarter                =   $dateFilter->quarter;
        $dateStart              =   Carbon::createFromDate($dateFilter->year, (($quarter-1) * 3)+1, 1);
        $quarterStatisticList   =   array();
        $quarterMonthList       =   array();

        for($intCtr = 1; $intCtr <= 3; $intCtr++){

            array_push($quarterMonthList, $dateStart->format('F'));
            $quarterStatistic       =   $this->queryPerMonth($dateStart);
            array_push($quarterStatisticList, $quarterStatistic);
            $dateStart->addMonth();

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

    public function getYearlyStatistics($dateFilter){

        $dateFilter         =   Carbon::parse($dateFilter);

        $dateStart          =   Carbon::createFromDate($dateFilter->year, 1, 1);
        $yearStatisticList  =   array();

        for ($intCtr = 0; $intCtr < 4; $intCtr++){

            $yearStatistic      =   $this->queryPerQuarter($dateStart);
            array_push($yearStatisticList, $yearStatistic);
            $dateStart->addMonths(3);

        }//end for

        return response()
            ->json(
                [
                    'yearStatisticList'         =>  $yearStatisticList
                ],
                200
            );

    }//end function

    public function queryPerDay($dateFilter){

        $reportList                 =   $this->queryTabularReport($dateFilter->toDateTimeString(), $dateFilter->toDateTimeString());
        $deciTotalDownpayment       =   0;
        $deciTotalCollection        =   0;

        foreach($reportList as $report){

            if ($report['intCategory'] == 1){
                $deciTotalCollection    +=  $report['deciAmountPaid'];
            }else{
                $deciTotalDownpayment   +=  $report['deciAmountPaid'];
            }//end if else

        }//end foreach

        return array(
            'collections'   =>  $deciTotalCollection,
            'downpayments'  =>  $deciTotalDownpayment
            );

    }//end function

    public function queryPerMonth($dateFilter){

        $monthStart                 =   Carbon::parse($dateFilter)
            ->startOfMonth();

        $monthEnd                   =   Carbon::parse($dateFilter)
            ->endOfMonth();

        $reportList                 =   $this->queryTabularReport($monthStart, $monthEnd);
        $deciTotalDownpayment       =   0;
        $deciTotalCollection        =   0;

        foreach($reportList as $report){

            if ($report['intCategory'] == 1){
                $deciTotalCollection    +=  $report['deciAmountPaid'];
            }else{
                $deciTotalDownpayment   +=  $report['deciAmountPaid'];
            }//end if else

        }//end foreach

        return array(
            'collections'   =>  $deciTotalCollection,
            'downpayments'  =>  $deciTotalDownpayment
            );

    }//end function

    public function queryPerQuarter($dateFilter){

        $dateFrom                   =   Carbon::parse($dateFilter)
            ->startOfMonth();
        $dateTo                     =   Carbon::parse($dateFilter)
            ->addMonths(2)
            ->endOfMonth();

        $reportList                 =   $this->queryTabularReport($dateFrom, $dateTo);
        $deciTotalDownpayment       =   0;
        $deciTotalCollection        =   0;

        foreach($reportList as $report){

            if ($report['intCategory'] == 1){
                $deciTotalCollection    +=  $report['deciAmountPaid'];
            }else{
                $deciTotalDownpayment   +=  $report['deciAmountPaid'];
            }//end if else

        }//end foreach

        return array(
            'collections'   =>  $deciTotalCollection,
            'downpayments'  =>  $deciTotalDownpayment
            );

    }//end function

    public function generatePdf($dateFrom, $dateTo){

        $transactionType            =   array(
            '',
            'Regular Collection',
            'Downpayment'
        );

        $reportList                 =   $this->queryTabularReport($dateFrom, $dateTo);

        $intNoOfTransaction         =   0;
        $deciTotalAmountReceived    =   0;

        foreach($reportList as $report){

            $intNoOfTransaction++;
            $deciTotalAmountReceived    +=  $report['deciAmountPaid'];

        }//end foreach

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'landscape');
        $pdf->loadView('pdf.collection-report', [
            'dateFrom'                  =>  Carbon::parse($dateFrom)
                ->toFormattedDateString(),
            'dateTo'                    =>  Carbon::parse($dateTo)
                ->toFormattedDateString(),
            'reportList'                =>  $reportList,
            'datePrinted'               =>  Carbon::now()
                ->toDayDateTimeString(),
            'categoryList'  =>  $transactionType,
            'deciTotalAmountReceived'   =>  $deciTotalAmountReceived,
            'intNoOfTransaction'        =>  $intNoOfTransaction
            ]);
        return $pdf->stream('collection-report.pdf');

    }//end function

    public function queryTabularReport($dateFrom, $dateTo){

        $reportList                     =   array();

        $collectionList                 =   $this->getCollectionTabularReport($dateFrom, $dateTo);
        $downpaymentList                =   $this->getDownpaymentTabularReport($dateFrom, $dateTo);

        foreach($collectionList as $collection){

            $report                 =   array(
                'dateTransaction'       =>  Carbon::parse($collection->created_at)->toDateTimeString(),
                'strCustomerName'       =>  $collection->strLastName.', '.$collection->strFirstName.' '.$collection->strMiddleName,
                'intCategory'           =>  1,
                'strUnitType'           =>  $collection->strRoomTypeName,
                'intUnitId'             =>  $collection->intUnitId,
                'deciPrice'             =>  $collection->deciPrice,
                'deciAmountPaid'        =>  $collection->monthly + $collection->penalty
            );

            array_push($reportList, $report);

        }//end foreach

        foreach($downpaymentList as $downpayment){

            $report                 =   array(
                'dateTransaction'       =>  Carbon::parse($downpayment->created_at)->toDateTimeString(),
                'strCustomerName'       =>  $downpayment->strLastName.', '.$downpayment->strFirstName.' '.$downpayment->strMiddleName,
                'intCategory'           =>  2,
                'strUnitType'           =>  $downpayment->strRoomTypeName,
                'intUnitId'             =>  $downpayment->intUnitId,
                'deciPrice'             =>  $downpayment->deciPrice,
                'deciAmountPaid'        =>  $downpayment->deciAmountPaid
            );

            array_push($reportList, $report);

        }//end foreach

        $collection             =   collect($reportList);
        $sortedReportList       =   $collection->sortBy('dateTransaction');

        return $sortedReportList->values()->all();

    }//end function

    public function getCollectionTabularReport($dateFrom, $dateTo){

        $collectionList             =   $this->queryCollection()
            ->whereBetween('tblCollectionPayment.created_at', [
                Carbon::parse($dateFrom)
                    ->startOfDay(),
                Carbon::parse($dateTo)
                    ->endOfDay()
                ])
            ->get();

        $penalty            =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'penalty')
            ->first(['deciBusinessDependencyValue']);

        $gracePeriod        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
            ->first(['deciBusinessDependencyValue']);

        foreach($collectionList as $collection){

            $deciMonthlyAmortization            =   (new CollectionBusiness())
                ->getMonthlyAmortization($collection->deciPrice, $collection->deciInterestRate, $collection->intNoOfYear);

            $collection->monthly                =   $deciMonthlyAmortization;

            $datePayment            =   Carbon::parse($collection->created_at);
            $dateDue                =   Carbon::parse($collection->dateDue)
                ->addDays($gracePeriod->deciBusinessDependencyValue);

            $collection->penalty        =   0;

            if ($datePayment > $dateDue){

                $collection->penalty            =   (new PenaltyBusiness())
                    ->getPenalty($deciMonthlyAmortization, $datePayment->diffInMonths($dateDue)+1);

            }//end if

        }//end foreach

        return $collectionList;

    }//end function

    public function getDownpaymentTabularReport($dateFrom, $dateTo){

        $downpaymentList            =   $this->queryDownpayment()
            ->whereBetween('tblDownpaymentPayment.created_at', [
                Carbon::parse($dateFrom)->startOfDay(),
                Carbon::parse($dateTo)->endOfDay()
                ])
            ->get();

        $downpaymentBD              =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        $discountSpotdown           =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountSpotdown')
            ->first(['deciBusinessDependencyValue']);

        foreach($downpaymentList as $downpayment){

            $deciDownpaymentToPay           =   $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue;

            if (Carbon::parse($downpayment->dateDownpaymentStart)->addDays(7) >= Carbon::parse($downpayment->created_at)){

                $deciDownpaymentToPay       -=   ($deciDownpaymentToPay * $discountSpotdown->deciBusinessDependencyValue);

            }//end if

            $deciAmountPaid                 =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
                ->where('created_at', '>=', $downpayment->created_at)
                ->sum('deciAmountPaid');
            if ($deciAmountPaid > $deciDownpaymentToPay){

                $downpayment->deciAmountPaid        =   $downpayment->deciAmountPaid - ($deciAmountPaid - $deciDownpaymentToPay);

            }//end if

        }//end foreach

        return $downpaymentList;

    }//end function

    public function queryDownpayment(){

        $downpaymentList            =   DownpaymentPayment::select(
            'tblDownpayment.intDownpaymentId',
            'tblDownpayment.created_at as dateDownpaymentStart',
            'tblDownpaymentPayment.created_at',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblUnit.intUnitId',
            'tblRoomType.strRoomTypeName',
            'tblUnitCategoryPrice.deciPrice',
            'tblDownpaymentPayment.deciAmountPaid'
            )
            ->join('tblDownpayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblDownpayment.intUnitIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
            ->whereNull('tblDownpayment.deleted_at')
            ->orderBy('tblDownpaymentPayment.created_at', 'asc');

        return $downpaymentList;

    }//end function

    public function queryCollection(){

        $collectionList             =   Collection::select(
            'tblCollection.intCollectionId',
            'tblCollectionPayment.created_at',
            'tblCollectionPaymentDetail.dateDue',
            'tblInterest.intNoOfYear',
            'tblInterestRate.deciInterestRate',
            'tblUnitCategoryPrice.deciPrice',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblCollectionPaymentDetail.dateDue',
            'tblRoomType.strRoomTypeName',
            'tblUnit.intUnitId'
            )
            ->join('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
            ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
            ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblCollection.intUnitIdFK')
            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
            ->orderBy('tblCollectionPayment.created_at', 'asc');

        return $collectionList;

    }//end function

}
