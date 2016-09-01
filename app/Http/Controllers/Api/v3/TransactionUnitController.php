<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v2\BusinessDependency;
use App\Unit;
use App\ApiModel\v3\TransactionUnit;
use App\ApiModel\v3\TransactionUnitDetail;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;
use App\Customer;
use App\UnitCategoryPrice;

use App\Business\v1\CollectionBusiness;

use DB;

use Carbon\Carbon;

class TransactionUnitController extends Controller
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

            $deciAmountToPay            =   0;

            $customerCount              =   Customer::where('intCustomerId', '=', $request->intCustomerId)
                ->count();

            if ($customerCount == 0){

                return response()
                    ->json(
                            [
                                'message'       =>      'Customer does not exist.'
                            ],
                            500
                        );

            }//end if

            if ($request->intPaymentType == null){

                return response()
                    ->json(
                            [
                                'message'       =>  'Payment type cannot be blank.'
                            ],
                            500
                        );

            }//end if

            if ($request->intPaymentType == 2){

                if ($request->cheque == null){

                    return response()
                        ->json(
                                [
                                    'message'       =>  'Cheque details cannot be blank.'
                                ],
                                500
                            );

                }//end if

            }//end if

            if ($request->intTransactionType == 3){

                $discountPayOnce        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountPayOnce')
                    ->first([
                        'deciBusinessDependencyValue'
                        ]);

                $pcf                    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
                    ->first([
                    'deciBusinessDependencyValue'
                    ]);

                foreach($request->unitList as $unit){

                    $deciUnitPrice      =      ($unit['unitPrice']['deciPrice']*$discountPayOnce->deciBusinessDependencyValue);
                    $deciPcf            =      ($unit['unitPrice']['deciPrice']*$pcf->deciBusinessDependencyValue);

                    $deciAmountToPay    +=      ($deciUnitPrice+$deciPcf);

                }//end foreach

            }//end if
            else if ($request->intTransactionType == 2){

                $reservationFee         =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
                    ->first([
                        'deciBusinessDependencyValue'
                        ]);
                $deciAmountToPay        +=  ($reservationFee->deciBusinessDependencyValue*sizeof($request->unitList));

            }//end else if
            else if ($request->intTransactionType == 4){

                $pcf                    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
                    ->first([
                        'deciBusinessDependencyValue'
                        ]);

                foreach($request->unitList as $unit){

                    $deciAmountToPay        +=  ($unit['unitPrice']['deciPrice']*$pcf->deciBusinessDependencyValue);

                }//end foreach

            }//end else if

            if ($deciAmountToPay > $request->deciAmountPaid){

                \DB::rollBack();
                return response()
                    ->json(
                            [
                                'message'       =>  'Amount to pay is greater than amount paid.'
                            ],
                            500
                        );

            }//end if

            $transactionUnit                =   TransactionUnit::create([
                'intCustomerIdFK'           =>  $request->intCustomerId,
                'intPaymentType'            =>  $request->intPaymentType,
                'deciAmountPaid'            =>  $request->deciAmountPaid
                ]);

            $downpaymentDueDate             =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
                ->first([
                    'deciBusinessDependencyValue'
                    ]);

            foreach($request->unitList as $unit){

                $unitPrice                      =   $unit['unitPrice'];

                $transactionUnitDetail          =   TransactionUnitDetail::create([
                    'intUnitIdFK'                       =>  $unit['intUnitId'],
                    'intUnitCategoryPriceIdFK'          =>  $unitPrice['intUnitCategoryPriceId'],
                    'intTransactionUnitIdFK'            =>  $transactionUnit->intTransactionUnitId,
                    'intTransactionType'                =>  $request->intTransactionType,
                    ]);

                $unitData                       =   Unit::find($unit['intUnitId']);
                $unitData->intUnitStatus        =   $request->intTransactionType;
                $unitData->intCustomerIdFK      =   $request->intCustomerId;
                $unitData->save();

                if ($request->intTransactionType != 3){

                    $interest                       =   $unit['interest'];
                    $interestRate                   =   $interest['interestRate'];

                    $downpayment                    =   Downpayment::create([
                        'intCustomerIdFK'               =>  $request->intCustomerId,
                        'intUnitIdFK'                   =>  $unit['intUnitId'],
                        'intUnitCategoryPriceIdFK'      =>  $unitPrice['intUnitCategoryPriceId'],
                        'boolPaid'                      =>  false,
                        'intInterestIdFK'               =>  $interest['intInterestId'],
                        'intInterestRateIdFK'           =>  $interestRate['intInterestRateId'],
                        'dateDueDate'                   =>  Carbon::parse($transactionUnit->created_at)->addDays($downpaymentDueDate->deciBusinessDependencyValue)
                        ]);

                    $downpaymentPayment             =   DownpaymentPayment::create([
                        'intDownpaymentIdFK'        =>  $downpayment->intDownpaymentId,
                        'deciAmountPaid'            =>  $reservationFee->deciBusinessDependencyValue,
                        'intPaymentType'            =>  $request->intPaymentType
                    ]);

                }//end if

            }//end foreach

            \DB::commit();
            return response()
                ->json(
                        [
                            'message'                   =>  'Success!',
                            'transactionUnit'           =>  $this->queryTransactionUnit($transactionUnit->intTransactionUnitId),
                            'transactionType'           =>  $request->intTransactionType,
                            'transactionUnitDetailList' =>  $this->queryTransactionUnitDetail($transactionUnit->intTransactionUnitId)
                        ],
                        200
                    );


        }catch(Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                        [
                            'message'       =>  $e->getMessage()
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
        $reservationFee                 =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
            ->first(['deciBusinessDependencyValue']);

        $downpaymentBD                  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        $downpayment                    =   Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
            ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblDownpayment.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->where('intUnitIdFK', '=', $id)
            ->orderBy('tblDownpayment.created_at', 'desc')
            ->first([
                'tblDownpayment.intDownpaymentId',
                'tblDownpayment.dateDueDate',
                'tblDownpayment.intUnitIdFK',
                'tblUnitCategoryPrice.deciPrice',
                'tblInterest.intNoOfYear',
                'tblInterestRate.deciInterestRate'
            ]);

        $deciAmountPaid                 =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
            ->sum('deciAmountPaid');

        $transactionUnitDetail          =   array(
            'intUnitId'                 =>  $id,
            'deciPrice'                 =>  $downpayment->deciPrice,
            'intNoOfYear'               =>  $downpayment->intNoOfYear,
            'dateDueDate'               =>  $downpayment->dateDueDate,
            'deciDownpayment'           =>  $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue,
            'deciMonthlyAmortization'   =>  (new CollectionBusiness())->getMonthlyAmortization($downpayment->deciPrice, $downpayment->deciInterestRate, $downpayment->intNoOfYear),
            'deciTotalAmountPaid'       =>  $reservationFee->deciBusinessDependencyValue + $deciAmountPaid
        );

        return response()
            ->json(
                [
                    'transactionUnitDetail'     =>  $transactionUnitDetail
                ],
                200
            );
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
        DB::beginTransaction();
        try{

            if (!$request->intTransactionType){

                DB::rollBack();
                return response()
                    ->json(
                        [
                            'message'       =>  'Transaction type cannot be blank.'
                        ],
                        500
                    );

            }//end if
            $deciAmountToPay                =   0;
            $reservationFee                 =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
                ->first(['deciBusinessDependencyValue']);
            $pcf                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
                ->first(['deciBusinessDependencyValue']);
            $transactionUnitDetail          =   TransactionUnitDetail::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblTransactionUnitDetail.intUnitCategoryPriceIdFK')
                ->where('intUnitIdFK', '=', $id)
                ->orderBy('tblTransactionUnitDetail.created_at', 'desc')
                ->first();

            $transactionUnit                =   TransactionUnit::where('intTransactionUnitId', '=', $transactionUnitDetail->intTransactionUnitIdFK)
                ->orderBy('created_at', 'desc')
                ->first();

            $transactionUnit->deciAmountPaid        =   $transactionUnit->deciAmountPaid + $request->deciAmountPaid;
            $transactionUnit->save();

            $unit                   =   Unit::find($transactionUnitDetail->intUnitIdFK);
            $unit->intUnitStatus    =   $request->intTransactionType;
            $unit->save();

            $transactionUnitDetail->intTransactionType      =   $request->intTransactionType;
            $transactionUnitDetail->save();

            $downpayment            =   Downpayment::where('intUnitIdFK', '=', $id)
                ->orderBy('created_at', 'desc')
                ->first();
            if ($request->intTransactionType == 4){

                if (!$request->interest){

                    DB::rollBack();
                    return response()
                        ->json(
                            [
                                'message'           =>  'Years to pay is required for At Need.'
                            ],
                            500
                        );

                }//end if

                $interestRate                               =   $request->interest['interestRate'];
                $downpayment->intInterestRateIdFK           =   $interestRate['intInterestRateId'];
                $downpayment->save();

                $deciAmountToPay            =   $transactionUnitDetail->deciPrice*$pcf->deciBusinessDependencyValue;

            }//end if
            else if ($request->intTransactionType == 3){

                $downpayment->delete();
                $discountPayOnce            =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountPayOnce')
                    ->first(['deciBusinessDependencyValue']);

                $deciAmountToPay            =   ($transactionUnitDetail->deciPrice - ($transactionUnitDetail->deciPrice * $discountPayOnce->deciBusinessDependencyValue))+($pcf->deciBusinessDependencyValue * $transactionUnitDetail->deciPrice);

            }//end else if

            if ($deciAmountToPay > ($reservationFee->deciBusinessDependencyValue + $request->deciAmountPaid)){
                DB::rollBack();
                return response()
                    ->json(
                        [
                            'message'           =>  'Amount to pay is greater than amount paid.'
                        ],
                        500
                    );
            }//end if

            DB::commit();
            return response()
                ->json(
                    [
                        'message'           =>  'Success!'
                    ],
                    201
                );

        }catch(Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'           =>  $e->getMessage()
                    ],
                    500
                );

        }//end try catch
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            \DB::beginTransaction();
            $unit                       =   Unit::find($id);
            $unit->intUnitStatus        =   1;
            $unit->intCustomerIdFK      =   null;
            $unit->save();

            $downpayment                =   Downpayment::where('intUnitIdFK', '=', $id)
                ->where('boolPaid', '=', false)
                ->orderBy('created_at', 'desc')
                ->first();
            $downpayment->delete();

            \DB::commit();
            return response()
                ->json(
                    [
                        'message'           =>  'Reservation is successfully cancelled.'
                    ],
                    201
                );

        }catch(Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'           =>  $e->getMessage()
                    ],
                    500
                );
        }
    }

    public function queryTransactionUnit($id){

        $transactionUnit            =   TransactionUnit::select(
            'tblTransactionUnit.intTransactionUnitId',
            'tblTransactionUnit.created_at',
            'tblTransactionUnit.intPaymentType',
            'tblTransactionUnit.deciAmountPaid',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblTransactionUnit.intCustomerIdFK');

        if ($id){
            return $transactionUnit->where('tblTransactionUnit.intTransactionUnitId', '=', $id)
                ->first();
        }//end if

        return $transactionUnit->get();

    }//end function

    public function queryTransactionUnitDetail($id){
        $transactionUnitDetail      =   TransactionUnitDetail::select(
            'tblUnit.intUnitId',
            'tblTransactionUnitDetail.intUnitCategoryPriceIdFK',
            'tblUnit.intColumnNo',
            'tblUnitCategory.intLevelNo',
            'tblTransactionUnitDetail.intTransactionType'
            )
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblTransactionUnitDetail.intUnitIdFK')
            ->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK');
        $transactionUnitDetailList          =   null;
        if ($id){
            $transactionUnitDetailList      =   $transactionUnitDetail->where('intTransactionUnitIdFK', '=', $id)
                ->get();

        }else{
            $transactionUnitDetailList      =   $transactionUnitDetail->get();
        }
        foreach($transactionUnitDetailList as $transactionUnitDetail){
            $price          =   UnitCategoryPrice::where('intUnitCategoryPriceId', '=', $transactionUnitDetail->intUnitCategoryPriceIdFK)
                ->orderBy('created_at', 'desc')
                ->first(['deciPrice']);
            $transactionUnitDetail->price       =   $price->deciPrice;
        }//end foreach
        return $transactionUnitDetailList;
    }//end function

    public function getReports(Request $request){

        $transactionUnitDetailList          =   $this->queryReportTransactionUnit(null)
            ->whereBetween('tblTransactionUnit.created_at', [
                Carbon::parse($request->dateFrom)->startOfDay()->toDateTimeString(),
                Carbon::parse($request->dateTo)->endOfDay()->toDateTimeString()
                ])
            ->get();

        $reservationFee                     =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
            ->first(['deciBusinessDependencyValue']);
        $discountPayOnce                    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountPayOnce')
            ->first(['deciBusinessDependencyValue']);
        $pcf                                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
            ->first(['deciBusinessDependencyValue']);

        foreach($transactionUnitDetailList as $transactionUnitDetail){
            if ($transactionUnitDetail->intTransactionType == 2){
                $transactionUnitDetail->amount      =   $reservationFee->deciBusinessDependencyValue;
            }else if ($transactionUnitDetail->intTransactionType == 3){
                $transactionUnitDetail->amount      =   ($transactionUnitDetail->deciPrice - ($transactionUnitDetail->deciPrice * $discountPayOnce->deciBusinessDependencyValue))+($transactionUnitDetail->deciPrice * $pcf->deciBusinessDependencyValue);
            }else if ($transactionUnitDetail->intTransactionType == 4){
                $transactionUnitDetail->amount      =   $transactionUnitDetail->deciPrice * $pcf->deciBusinessDependencyValue;
            }//end else if
        }//end foreach

        return response()
            ->json(
                [
                    'transactionUnitDetailList'     => $transactionUnitDetailList
                ],
                200
            );

    }//end public function

    public function queryReportTransactionUnit($id){

        $transactionUnit        =   TransactionUnit::select(
            'tblTransactionUnit.intTransactionUnitId',
            'tblTransactionUnit.created_at',
            'tblTransactionUnit.intTransactionType',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblUnitCategoryPrice.deciPrice',
            'tblRoomType.strRoomTypeName',
            'tblUnit.intUnitId'
            )
            ->join('tblTransactionUnitDetail', 'tblTransactionUnit.intTransactionUnitId', '=', 'tblTransactionUnitDetail.intTransactionUnitIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblTransactionUnitDetail.intUnitCategoryPriceIdFK')
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblTransactionUnitDetail.intUnitIdFK')
            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblTransactionUnit.intCustomerIdFK');

        if ($id){
            return $transactionUnit->where('tblTransactionUnit.intTransactionUnitId', '=', $id);
        }

        return $transactionUnit;

    }//end public function

    public function getWeeklyReports($dateFilter){

        $dateFilter             =   Carbon::parse($dateFilter);
        $weekStart              =   $dateFilter->startOfWeek();
        $weekStatisticList      =   array();
        
        for($intCtr = 0; $intCtr < 7; $intCtr++){

            $weekStatistic      =   $this->queryTotalPerDay($weekStart);
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

    public function getMonthlyReports($dateFilter){

        $dateFilter             =   Carbon::parse($dateFilter);
        $intNoOfDays            =   $dateFilter->daysInMonth;
        $monthStart             =   $dateFilter->startOfMonth();
        $monthStatisticList     =   array();

        for($intCtr = 0; $intCtr < $intNoOfDays; $intCtr++){

            $monthStatistic         =   $this->queryTotalPerDay($monthStart);
            array_push($monthStatisticList, $monthStatistic);
            $monthStart->addDay();

        }//end for

        return response()
            ->json(
                [
                    'monthStatisticList'        =>  $monthStatisticList,
                    'noOfDays'                  =>  $intNoOfDays
                ],
                200
            );

    }//end function

    public function getQuarterlyReports($dateFilter){

        $dateFilter         =   Carbon::parse($dateFilter);
        $intQuarter         =   $dateFilter->quarter - 1;
        $quarterMonth       =   Carbon::createFromDate($dateFilter->year, ($intQuarter * 3)+1, 1);

        $quarterStatisticList       =   array();
        $quarterMonthList           =   array();

        for ($intCtr = 0; $intCtr < 3; $intCtr++){

            $quarterStatistic       =   $this->queryTotalPerMonth($quarterMonth);
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

    public function getYearlyReports($dateFilter){

        $dateFilter             =   Carbon::parse($dateFilter);
        $yearStart              =   Carbon::createFromDate($dateFilter->year, 1, 1);
        $yearStatisticList      =   array();

        for($intCtr = 0; $intCtr < 4; $intCtr++){

            $yearStatistic      =   $this->queryTotalPerQuarter($yearStart);
            array_push($yearStatisticList, $yearStatistic);
            $yearStart->addMonths(3)->startOfMonth();

        }//end for

        return response()
            ->json(
                [
                    'yearStatisticList'         =>  $yearStatisticList
                ],
                200
            );

    }//end function

    public function queryTotalPerQuarter($dateFilter){
        
        $dateFilter             =   Carbon::parse($dateFilter);

        $transactionList        =   $this->queryTotalTransactionUnit()
            ->whereBetween('tblTransactionUnit.created_at', [
                $dateFilter->startOfMonth()->startOfDay()->toDateTimeString(),
                $dateFilter->addMonths(2)->endOfMonth()->endOfDay()->toDateTimeString()
                ])
            ->get();

        return $this->computeTotalSales($transactionList);

    }

    public function queryTotalPerMonth($dateNow){

        $dateFilter             =   Carbon::parse($dateNow);

        $transactionList        =   $this->queryTotalTransactionUnit()
            ->whereBetween('tblTransactionUnit.created_at', [
                $dateFilter->startOfMonth()->startOfDay()->toDateTimeString(),
                $dateFilter->endOfMonth()->endOfDay()->toDateTimeString()
                ])
            ->get();

        return $this->computeTotalSales($transactionList);

    }//end function

    public function queryTotalPerDay($dateFilter){

        $transactionList    =   $this->queryTotalTransactionUnit()
            ->whereBetween('tblTransactionUnit.created_at', [
                $dateFilter->startOfDay()->toDateTimeString(),
                $dateFilter->endOfDay()->toDateTimeString()
                ])
            ->get();

        return $this->computeTotalSales($transactionList);

   }//end function

   public function computeTotalSales($transactionList){

        $arrTotalAmount         =   array(
            'payOnce'       =>  0,
            'reservation'   =>  0,
            'atNeed'        =>  0
            );

        $reservationFee         =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
            ->first(['deciBusinessDependencyValue']);

        $discountPayOnce        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountPayOnce')
            ->first(['deciBusinessDependencyValue']);

        $pcf                    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
            ->first(['deciBusinessDependencyValue']);

        foreach($transactionList as $transaction){

            if ($transaction->intTransactionType == 2){

                $arrTotalAmount['reservation']          +=  $reservationFee->deciBusinessDependencyValue;

            }//end if
            else if ($transaction->intTransactionType == 3){

                $arrTotalAmount['payOnce']              +=  ($transaction->deciPrice - ($transaction->deciPrice * $discountPayOnce->deciBusinessDependencyValue) + ($transaction->deciPrice * $pcf->deciBusinessDependencyValue));

            }//end else if
            else if ($transaction->intTransactionType == 4){

                $arrTotalAmount['atNeed']               +=  ($transaction->deciPrice * $pcf->deciBusinessDependencyValue);

            }//end else if

        }//end foreach

        return $arrTotalAmount;

   }//end function

    public function queryTotalTransactionUnit(){

        $totalTransactionUnit           =   TransactionUnit::select(
            'tblTransactionUnit.intTransactionType',
            'tblUnitCategoryPrice.deciPrice'
            )
            ->join('tblTransactionUnitDetail', 'tblTransactionUnit.intTransactionUnitId', '=', 'tblTransactionUnitDetail.intTransactionUnitIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblTransactionUnitDetail.intUnitCategoryPriceIdFK');
        return $totalTransactionUnit;

    }//end function

}
