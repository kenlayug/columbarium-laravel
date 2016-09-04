<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App;
use DB;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\Relationship;
use App\ApiModel\v2\Service;
use App\ApiModel\v2\StorageType;
use App\ApiModel\v2\TransactionDeceased;
use App\ApiModel\v2\TransactionDeceasedDetail;
use App\ApiModel\v2\UnitDeceased;
use App\ApiModel\v2\UnitService;
use App\ApiModel\v2\UnitTypeStorage;
use App\Unit;
use App\ApiModel\v2\TransactionOwnership;
use App\Customer;

use Carbon\Carbon;

class TransactionDeceasedController extends Controller
{
    public function add(Request $request){

        try{

            \DB::beginTransaction();

            $intRelationshipId = 0;

            $service        =   UnitService::join('tblService', 'tblService.intServiceId', '=', 'tblUnitService.intServiceIdFK')
                ->join('tblServicePrice', 'tblService.intServiceId', '=', 'tblServicePrice.intServiceIdFK')
                ->where('tblUnitService.intUnitTypeIdFK', '=', $request->intUnitTypeId)
                ->orderBy('tblServicePrice.created_at', 'desc')
                ->first();

            if ($service->deciPrice > $request->deciAmountPaid){

                return response()
                    ->json(
                            [
                                'message'       =>  'Amount to pay is greater than amount paid.'
                            ],
                            500
                        );

            }//end if

            $storageType        =   UnitTypeStorage::where('intUnitTypeIdFK', '=', $request->intUnitTypeId)
                                        ->where('intStorageTypeIdFK', '=', $request->intStorageTypeId)
                                        ->first();

            $storageTypeDetail  =   StorageType::where('intStorageTypeId', '=', $request->intStorageTypeId)
                ->first(['strStorageTypeName']);

            $deceased = Deceased::find($request->intDeceasedId);
            
            $deceased->dateInterment            =   $request->dateInterment;
            $deceased->save();

            if ($deceased == null){

                \DB::rollback();
                return response()
                    ->json(
                            [
                                'message'       =>  'Deceased does not exist.'
                            ],
                            500
                        );

            }//end if

            $unitDeceased       =   UnitDeceased::where('intUnitIdFK', '=', $request->intUnitId)
                                        ->first(['intStorageTypeIdFK']);

            $unit               =   Unit::find($request->intUnitId);

            if ($unitDeceased != null && $unitDeceased->intStorageTypeIdFK != $request->intStorageTypeId){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'error'     =>  'Storage type should be the same as the first ones.'
                        ],
                        500
                    );

            }//end if for storage type

            $unitDeceasedCount  =   UnitDeceased::where('intUnitIdFK', '=', $request->intUnitId)
                                        ->count();

            if ($unitDeceasedCount >= $storageType->intQuantity){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'error'     =>  'Unit is already full.'
                        ],
                        500
                    );

            }//end if for deceased count

            $deceasedUnit   =   UnitDeceased::create([
                'intUnitIdFK'           =>  $request->intUnitId,
                'intDeceasedIdFK'       =>  $deceased->intDeceasedId,
                'intStorageTypeIdFK'    =>  $request->intStorageTypeId
            ]);

            $transactionDeceased        =   TransactionDeceased::create([
                'intPaymentType'        =>  $request->intPaymentType,
                'deciAmountPaid'        =>  $request->deciAmountPaid,
                'intTransactionType'    =>  1
            ]);

            $transactionDeceasedDetail  =   TransactionDeceasedDetail::create([
                'intServiceIdFK'        =>  $service->intServiceIdFK,
                'intServicePriceIdFK'   =>  $service->intServicePriceId,
                'intTDeceasedIdFK'      =>  $transactionDeceased->intTransactionDeceasedId,
                'intUDeceasedIdFK'      =>  $deceasedUnit->intUnitDeceasedId
            ]);

            $transactionDeceased        =   TransactionDeceased::select(
                'tblTransactionDeceased.intTransactionDeceasedId',
                'tblTransactionDeceased.created_at',
                'tblService.strServiceName',
                'tblServicePrice.deciPrice',
                'tblTransactionDeceased.deciAmountPaid',
                'tblDeceased.strFirstName',
                'tblDeceased.strMiddleName',
                'tblDeceased.strLastName'
                )
                ->join('tblTDeceasedDetail', 'tblTransactionDeceased.intTransactionDeceasedId', '=', 'tblTDeceasedDetail.intTDeceasedIdFK')
                ->join('tblService', 'tblService.intServiceId', '=', 'tblTDeceasedDetail.intServiceIdFK')
                ->join('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblTDeceasedDetail.intServicePriceIdFK')
                ->join('tblUnitDeceased', 'tblUnitDeceased.intUnitDeceasedId', '=', 'tblTDeceasedDetail.intUDeceasedIdFK')
                ->join('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
                ->where('tblTransactionDeceased.intTransactionDeceasedId', '=', $transactionDeceased->intTransactionDeceasedId)
                ->first();

            \DB::commit();

            return response()
                ->json(
                        [
                            'message'                   =>  'Transaction is successfully processed.',
                            'transactionDeceased'       =>  $transactionDeceased,
                            'strStorageTypeName'        =>  $storageTypeDetail->strStorageTypeName
                        ],
                        201
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

    public function getReports(Request $request){        

        return response()
            ->json(
                [
                    'transactionDeceasedList'       =>  $this->getTabularReport($request->dateFrom, $request->dateTo)
                ],
                200
            );

    }//end function

    public function generatePdf($dateFrom, $dateTo){

        $transactionReportList              =   $this->getTabularReport($dateFrom, $dateTo);

        $transactionTypeList                =   array(
            '',
            'Add',
            'Transfer',
            'Pull/Borrow',
            'Return',
            'Retrieve From Safebox'
        );

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'landscape');
        $pdf->loadView('pdf.manage-unit-report', [
            'dateFrom'                  =>  Carbon::parse($dateFrom)
                ->toFormattedDateString(),
            'dateTo'                    =>  Carbon::parse($dateTo)
                ->toFormattedDateString(),
            'transactionReportList'     =>  $transactionReportList,
            'transactionTypeList'       =>  $transactionTypeList
            ]);
        return $pdf->stream('manage-unit-report.pdf');

    }//end function

    public function getTabularReport($dateFrom, $dateTo){

        $transactionDeceasedList            =   $this->queryTransactionDeceased(null)
            ->whereBetween('tblTransactionDeceased.created_at', [
                Carbon::parse($dateFrom)->startOfDay()->toDateTimeString(),
                Carbon::parse($dateTo)->endOfDay()->toDateTimeString()
                ])
            ->get();

        return $transactionDeceasedList;

    }//end function

    public function queryTransactionDeceased($id){

        $transactionDeceasedList            =   TransactionDeceased::select(
            'tblTransactionDeceased.intTransactionDeceasedId',
            'tblTransactionDeceased.created_at',
            'tblCustomer.strFirstName AS strCustomerFirst',
            'tblCustomer.strMiddleName AS strCustomerMiddle',
            'tblCustomer.strLastName AS strCustomerLast',
            'tblDeceased.strFirstName AS strDeceasedFirst',
            'tblDeceased.strMiddleName AS strDeceasedMiddle',
            'tblDeceased.strLastName AS strDeceasedLast',
            'tblTransactionDeceased.intTransactionType',
            'tblUnit.intUnitId',
            'tblStorageType.strStorageTypeName',
            'tblService.strServiceName',
            'tblServicePrice.deciPrice'
            )
            ->leftJoin('tblTDeceasedDetail', 'tblTransactionDeceased.intTransactionDeceasedId', '=', 'tblTDeceasedDetail.intTDeceasedIdFK')
            ->leftJoin('tblUnitDeceased', 'tblUnitDeceased.intUnitDeceasedId', '=', 'tblTDeceasedDetail.intUDeceasedIdFK')
            ->leftJoin('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
            ->leftJoin('tblUnit', 'tblUnit.intUnitId', '=', 'tblUnitDeceased.intUnitIdFK')
            ->leftJoin('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblUnit.intCustomerIdFK')
            ->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblTDeceasedDetail.intServiceIdFK')
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblTDeceasedDetail.intServicePriceIdFK')
            ->leftJoin('tblStorageType', 'tblStorageType.intStorageTypeId', '=', 'tblUnitDeceased.intStorageTypeIdFK');

        if ($id){
            return $transactionDeceasedList->where('tblTransactionDeceased.intTransactionDeceasedId', '=', $id);
        }

        return $transactionDeceasedList;

    }//end function

    public function getWeeklyStatistics($dateFilter){

        $weekStart              =   Carbon::parse($dateFilter)->startOfWeek();

        $weekStatisticList      =   array();

        for($intCtr = 0; $intCtr < 7; $intCtr++){

            $weekStatistic          =   $this->queryTotalSalesPerDay($weekStart);
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

        $monthStart             =   Carbon::parse($dateFilter)->startOfMonth();
        $intNoOfDays            =   $monthStart->daysInMonth;
        $monthStatisticList     =   array();

        for($intCtr = 0; $intCtr < $intNoOfDays; $intCtr++){

            $monthStatistic     =   $this->queryTotalSalesPerDay($monthStart);
            array_push($monthStatisticList, $monthStatistic);
            $monthStart->addDay();

        }//end for

        return response()
            ->json(
                [
                    'monthStatisticList'        =>  $monthStatisticList,
                    'intNoOfDays'               =>  $intNoOfDays
                ],
                200
            );

    }//end function

    public function getQuarterlyStatistics($dateFilter){

        $dateFilter             =   Carbon::parse($dateFilter);
        $intQuarter             =   $dateFilter->quarter;
        $dateStart              =   Carbon::createFromDate($dateFilter->year, ($intQuarter-1)*3+1, 1);
        $quarterStatisticList   =   array();
        $quarterMonthList       =   array();

        for($intCtr = 0; $intCtr < 3; $intCtr++){

            $quarterStatistic       =   $this->queryTotalSalesPerMonth($dateStart);
            array_push($quarterStatisticList, $quarterStatistic);
            array_push($quarterMonthList, Carbon::parse($dateStart)->format('F'));
            $dateStart->addMonth();

        }//end for

        return response()
            ->json(
                [
                    'quarterStatisticList'          =>  $quarterStatisticList,
                    'quarterMonthList'              =>  $quarterMonthList
                ],
                200
            );

    }//end function

    public function getYearlyStatistics($dateFilter){

        $yearStart              =   Carbon::parse($dateFilter)->startOfYear();
        $yearStatisticList      =   array();

        for($intCtr = 0; $intCtr < 4; $intCtr++){

            $yearStatistic      =   $this->queryTotalSalesPerQuarter($yearStart);
            array_push($yearStatisticList, $yearStatistic);
            $yearStart->addMonths(3);

        }//end for

        return response()
            ->json(
                [
                    'yearStatisticList'         =>  $yearStatisticList
                ],
                200
            );

    }//end function

    public function queryTotalSalesPerDay($dateFilter){

        $totalSales             =   $this->queryTotalSales()
            ->whereBetween('tblTransactionDeceased.created_at', [
                Carbon::parse($dateFilter)->startOfDay()->toDateTimeString(),
                Carbon::parse($dateFilter)->endOfDay()->toDateTimeString()
                ])
            ->get();

        return $this->computeTotalSales($totalSales);

    }//end function

    public function queryTotalSalesPerMonth($dateFilter){

        $totalSales             =   $this->queryTotalSales()
            ->whereBetween('tblTransactionDeceased.created_at', [
                Carbon::parse($dateFilter)->startOfMonth()->startOfDay()->toDateTimeString(),
                Carbon::parse($dateFilter)->endOfMonth()->endOfDay()->toDateTimeString()
                ])
            ->get();

        return $this->computeTotalSales($totalSales);

    }//end function

    public function queryTotalSalesPerQuarter($dateFilter){

        $totalSales             =   $this->queryTotalSales()
            ->whereBetween('tblTransactionDeceased.created_at', [
                Carbon::parse($dateFilter)->startOfMonth()->startOfDay()->toDateTimeString(),
                Carbon::parse($dateFilter)->addMonths(2)->endOfMonth()->endOfDay()->toDateTimeString()
                ])
            ->get();

        return $this->computeTotalSales($totalSales);

    }//end function

    public function computeTotalSales($transactionDeceasedList){

        $totalSales             =   [
            'add'           =>  0,
            'transfer'      =>  0,
            'pull'          =>  0,
            'return'        =>  0
        ];

        $penalty            =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'penaltyForNotReturn')
            ->first(['deciBusinessDependencyValue']);

        foreach($transactionDeceasedList as $transactionDeceased){

            if ($transactionDeceased->intTransactionType == 1){
                $totalSales['add']          +=  $transactionDeceased->deciPrice;
            }else if ($transactionDeceased->intTransactionType == 2){
                $totalSales['transfer']     +=  $transactionDeceased->deciPrice;
            }else if ($transactionDeceased->intTransactionType == 3){
                $totalSales['pull']     +=  $transactionDeceased->deciPrice;
            }else if ($transactionDeceased->intTransactionType == 4){
                $totalSales['return']   +=  ($transactionDeceased->deciAmountPaid != 0)? $penalty->deciBusinessDependencyValue : 0;
            }//end else if

        }//end foreach

        return $totalSales;

    }//end function

    public function queryTotalSales(){

        $totalSales             =   TransactionDeceased::select(
            'tblTransactionDeceased.intTransactionType',
            'tblServicePrice.deciPrice',
            'tblTransactionDeceased.deciAmountPaid'
            )
            ->join('tblTDeceasedDetail', 'tblTransactionDeceased.intTransactionDeceasedId', '=', 'tblTDeceasedDetail.intTDeceasedIdFK')
            ->join('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblTDeceasedDetail.intServicePriceIdFK');

        return $totalSales;

    }//end function

    public function getTransferOwnershipReports(Request $request){

        $transactionOwnershipList             =   TransactionOwnership::select(
            'tblTransactionOwnership.created_at',
            'tblTransactionOwnership.intPrevOwnerIdFK',
            'tblTransactionOwnership.intNewOwnerIdFK',
            'tblTransactionOwnership.intUnitIdFK'
            )
            ->whereBetween('created_at', [
                Carbon::parse($request->dateFrom)->startOfDay()->toDateTimeString(),
                Carbon::parse($request->dateTo)->endOfDay()->toDateTimeString()
                ])
            ->get();

        $transferCharge                     =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'transferOwnerCharge')
            ->first(['deciBusinessDependencyValue']);

        foreach($transactionOwnershipList as $transactionOwnership){

            $prevOwner          =   Customer::where('intCustomerId', '=', $transactionOwnership->intPrevOwnerIdFK)
                ->first(['strFirstName', 'strMiddleName', 'strLastName']);
            $newOwner           =   Customer::where('intCustomerId', '=', $transactionOwnership->intNewOwnerIdFK)
                ->first(['strFirstName', 'strMiddleName', 'strLastName']);
            $transactionOwnership->prev_owner       =   $prevOwner->strLastName.', '.$prevOwner->strFirstName.' '.$prevOwner->strMiddleName;
            $transactionOwnership->new_owner        =   $newOwner->strLastName.', '.$newOwner->strFirstName.' '.$newOwner->strMiddleName;
            $transactionOwnership->amount           =   $transferCharge->deciBusinessDependencyValue;

        }//end foreach

        return response()
            ->json(
                [
                    'transactionOwnershipList'          =>  $transactionOwnershipList
                ],
                200
            );

    }//end function

    public function getWeeklyStatisticsTransferOwnership($dateFilter){

        $weekStart          =   Carbon::parse($dateFilter)->startOfWeek();
        $weekStatisticList  =   array();

        for($intCtr = 0; $intCtr < 7; $intCtr++){

            $weekStatistic      =   $this->querySalesTransferOwnershipPerDay($weekStart);
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

    public function getMonthlyStatisticsTransferOwnership($dateFilter){

        $monthStart             =   Carbon::parse($dateFilter)->startOfMonth();
        $intNoOfDays            =   $monthStart->daysInMonth;
        $monthStatisticList     =   array();

        for($intCtr = 0; $intCtr < $intNoOfDays; $intCtr++){

            $monthStatistic         =   $this->querySalesTransferOwnershipPerDay($monthStart);
            array_push($monthStatisticList, $monthStatistic);
            $monthStart->addDay();

        }//end for

        return response()
            ->json(
                [
                    'monthStatisticList'        =>  $monthStatisticList,
                    'intNoOfDays'               =>  $intNoOfDays
                ],
                200
            );

    }//end function

    public function getQuarterlyStatisticsTransferOwnership($dateFilter){

        $dateFilter             =   Carbon::parse($dateFilter);
        $intQuarter             =   $dateFilter->quarter;
        $quarterStart           =   Carbon::createFromDate($dateFilter->year, ($intQuarter-1)*3+1, 1);
        $quarterStatisticList   =   array();
        $quarterMonthList       =   array();

        for($intCtr = 0; $intCtr < 3; $intCtr++){

            $quarterStatistic   =   $this->querySalesTransferOwnershipPerMonth($quarterStart);
            array_push($quarterStatisticList, $quarterStatistic);
            array_push($quarterMonthList, Carbon::parse($quarterStart)->format('F'));
            $quarterStart->addMonth();

        }//end for

        return response()
            ->json(
                [
                    'quarterStatisticList'          =>  $quarterStatisticList,
                    'quarterMonthList'              =>  $quarterMonthList
                ],
                200
            );

    }//end function

    public function getYearlyStatisticsTransferOwnership($dateFilter){

        $yearStart          =   Carbon::parse($dateFilter)->startOfYear();
        $yearStatisticList  =   array();

        for($intCtr = 0; $intCtr < 4; $intCtr++){

            $yearStatistic      =   $this->querySalesTransferOwnershipPerQuarter($yearStart);
            array_push($yearStatisticList, $yearStatistic);
            $yearStart->addMonths(3);

        }//end for

        return response()
            ->json(
                [
                    'yearStatisticList'     =>  $yearStatisticList
                ],
                200
            );

    }//end function

    public function querySalesTransferOwnershipPerDay($dateFilter){

        $intTransactionCount            =   TransactionOwnership::whereBetween('created_at', [
            Carbon::parse($dateFilter)->startOfDay()->toDateTimeString(),
            Carbon::parse($dateFilter)->endOfDay()->toDateTimeString()
            ])
            ->count();

        return $this->computeSalesTransferOwnership($intTransactionCount);

    }//end function

    public function querySalesTransferOwnershipPerMonth($dateFilter){

        $intTransactionCount            =   TransactionOwnership::whereBetween('created_at', [
            Carbon::parse($dateFilter)->startOfMonth()->startOfDay()->toDateTimeString(),
            Carbon::parse($dateFilter)->endOfMonth()->endOfDay()->toDateTimeString()
            ])
            ->count();

        return $this->computeSalesTransferOwnership($intTransactionCount);

    }//end function

    public function querySalesTransferOwnershipPerQuarter($dateFilter){

        $intTransactionCount            =   TransactionOwnership::whereBetween('created_at', [
            Carbon::parse($dateFilter)->startOfMonth()->startOfDay()->toDateTimeString(),
            Carbon::parse($dateFilter)->addMonths(2)->endOfMonth()->endOfDay()->toDateTimeString()
            ])
            ->count();

        return $this->computeSalesTransferOwnership($intTransactionCount);

    }//end function

    public function computeSalesTransferOwnership($intCount){

        $transferCharge             =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'transferOwnerCharge')
            ->first(['deciBusinessDependencyValue']);

        return $transferCharge->deciBusinessDependencyValue*$intCount;

    }//end function

}
