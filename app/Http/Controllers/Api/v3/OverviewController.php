<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Business\v1\CollectionBusiness;
use App\Business\v1\PenaltyBusiness;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;
use App\ApiModel\v2\TransactionDeceased;
use App\ApiModel\v2\TransactionPurchase;

use App\ApiModel\v3\DiscountRate;
use App\ApiModel\v3\DownpaymentDiscount;
use App\ApiModel\v3\TransactionUnit;
use App\ApiModel\v3\TransactionUnitDiscount;

class OverviewController extends Controller
{
    public function getReport($dateFilter){

        $dateFilter         =   Carbon::parse($dateFilter)
            ->startOfYear();

        $reportList         =   array();
        $reportMonth        =   array();

        for($intCtr = 0; $intCtr < 12; $intCtr++){

            $deciTotalUnitPurchase      =   $this->getMonthlyUnitPurchase($dateFilter);
            $deciTotalCollection        =   $this->getMonthlyCollection($dateFilter);
            $deciTotalManageUnit        =   $this->getMonthlyManageUnit($dateFilter);
            $deciTotalServicePurchase   =   $this->getMonthlyServicePurchase($dateFilter);

            $deciTotalSales             =   $deciTotalUnitPurchase+$deciTotalCollection+$deciTotalManageUnit+$deciTotalServicePurchase;

            $report         =   array(
                'month'                     =>  $dateFilter->format('F'),
                'deciTotalUnitPurchase'     =>  $deciTotalUnitPurchase,
                'deciTotalCollection'       =>  $deciTotalCollection,
                'deciTotalManageUnit'       =>  $deciTotalManageUnit,
                'deciTotalServicePurchase'  =>  $deciTotalServicePurchase,
                'deciTotalSales'            =>  $deciTotalSales
                );
            array_push($reportList, $report);
            array_push($reportMonth, $dateFilter->format('F'));
            $dateFilter->addMonth();

        }//end for

        return response()
            ->json(
                [
                    'reportList'        =>  $reportList,
                    'reportMonth'       =>  $reportMonth
                ],
                200
            );

    }//end function

    public function getMonthlyServicePurchase($dateFilter){

        $transactionPurchaseDetail      =   TransactionPurchase::select(
            'tblTransactionPurchase.intTransactionPurchaseId',
            'tblTransactionPurchase.created_at',
            'tblTransactionPurchase.deciAmountPaid',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblPackage.strPackageName',
            'tblPackagePrice.deciPrice as deciPackagePrice',
            'tblAdditional.strAdditionalName',
            'tblAdditionalPrice.deciPrice as deciAdditionalPrice',
            'tblService.strServiceName',
            'tblServicePrice.deciPrice as deciServicePrice',
            'tblTPurchaseDetail.intQuantity'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblTransactionPurchase.intCustomerIdFK')
            ->join('tblTPurchaseDetail', 'tblTransactionPurchase.intTransactionPurchaseId', '=', 'tblTPurchaseDetail.intTPurchaseIdFK')
            ->leftJoin('tblAdditional', 'tblAdditional.intAdditionalId', '=', 'tblTPurchaseDetail.intAdditionalIdFK')
            ->leftJoin('tblAdditionalPrice', 'tblAdditionalPrice.intAdditionalPriceId', '=', 'tblTPurchaseDetail.intAdditionalPriceIdFK')
            ->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblTPurchaseDetail.intServiceIdFK')
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblTPurchaseDetail.intServicePriceIdFK')
            ->leftJoin('tblPackage', 'tblPackage.intPackageId', '=', 'tblTPurchaseDetail.intPackageIdFK')
            ->leftJoin('tblPackagePrice', 'tblPackagePrice.intPackagePriceId', '=', 'tblTPurchaseDetail.intPackagePriceIdFK')
            ->whereBetween('tblTransactionPurchase.created_at', [
                Carbon::parse($dateFilter)->startOfMonth(),
                Carbon::parse($dateFilter)->endOfMonth()
                ])
            ->get();

        $deciTotalSales             =   0;

        foreach($transactionPurchaseDetail as $transactionPurchase){

            $deciPrice              =   0;

            if ($transactionPurchase->strAdditionalName != null){

                $deciPrice          =   $transactionPurchase->deciAdditionalPrice;

            }//end if
            else if ($transactionPurchase->strServiceName != null){

                $deciPrice          =   $transactionPurchase->deciServicePrice;

            }//end else if
            else if ($transactionPurchase->strPackageName != null){

                $deciPrice          =   $transactionPurchase->deciPackagePrice;

            }//end else if

            $deciTotalSales         +=  ($deciPrice * $transactionPurchase->intQuantity);

        }//end foreach

        return $deciTotalSales;

    }//end function

    public function getMonthlyUnitPurchase($dateFilter){

        $transactionUnit        =   TransactionUnit::select(
            'tblTransactionUnit.intTransactionUnitId',
            'tblTransactionUnit.created_at',
            'tblTransactionUnitDetail.intTransactionType',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblUnitCategoryPrice.deciPrice',
            'tblRoomType.strUnitTypeName',
            'tblUnit.intUnitId'
            )
            ->join('tblTransactionUnitDetail', 'tblTransactionUnit.intTransactionUnitId', '=', 'tblTransactionUnitDetail.intTransactionUnitIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblTransactionUnitDetail.intUnitCategoryPriceIdFK')
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblTransactionUnitDetail.intUnitIdFK')
            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblTransactionUnit.intCustomerIdFK')
            ->whereBetween('tblTransactionUnit.created_at', [
                Carbon::parse($dateFilter)->startOfMonth(),
                Carbon::parse($dateFilter)->endOfMonth()
                ])
            ->get();

        $pcf                    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
            ->first(['deciBusinessDependencyValue']);

        $deciTotalSales             =   0;

        foreach($transactionUnit as $transaction){

            if ($transaction->intTransactionType == 3){

                $deciTotalDiscount              =   0;

                $discountList           =   TransactionUnitDiscount::select(
                    'intDiscountRateIdFK'
                    )
                    ->where('intTransactionUnitIdFK', '=', $transaction->intTransactionUnitId)
                    ->get();

                foreach($discountList as $discount){

                    $discountRate       =   DiscountRate::select(
                        'intDiscountType',
                        'deciDiscountRate'
                        )
                        ->where('intDiscountRateId', '=', $discount->intDiscountRateIdFK)
                        ->first();

                    $discount->deciDiscountRate         =   $discountRate->deciDiscountRate;
                    $discount->intDiscountType          =   $discountRate->intDiscountType;

                }//end foreach

                foreach($discountList as $discount){

                    if ($discount->intDiscountType == 1){

                        $deciTotalDiscount          +=  ($transaction->deciPrice * $discount->deciDiscountRate);

                    }//end if
                    else{

                        $deciTotalDiscount          +=  $discount->deciDiscountRate;

                    }//end else

                }//end foreach

                $deciTotalSales              +=  ($transaction->deciPrice - $deciTotalDiscount + ($transaction->deciPrice * $pcf->deciBusinessDependencyValue));

            }//end else if
            else if ($transaction->intTransactionType == 4){

                $deciTotalSales               +=  ($transaction->deciPrice * $pcf->deciBusinessDependencyValue);

            }//end else if

        }//end foreach

        return $deciTotalSales;

    }//end function

    public function getMonthlyCollection($dateFilter){

        $collectionList             =   $this->queryCollectionTabularReport(
            Carbon::parse($dateFilter)->startOfMonth(),
            Carbon::parse($dateFilter)->endOfMonth()
            );

        $deciTotalSales             =   0;

        foreach($collectionList as $report){

            $deciTotalSales    +=  $report['deciAmountPaid'];

        }//end foreach

        return $deciTotalSales;

    }//end function

    public function getMonthlyManageUnit($dateFilter){

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
            ->leftJoin('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDeceased.intCustomerIdFK')
            ->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblTDeceasedDetail.intServiceIdFK')
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblTDeceasedDetail.intServicePriceIdFK')
            ->leftJoin('tblStorageType', 'tblStorageType.intStorageTypeId', '=', 'tblUnitDeceased.intStorageTypeIdFK')
            ->whereBetween('tblTransactionDeceased.created_at', [
                Carbon::parse($dateFilter)->startOfMonth(),
                Carbon::parse($dateFilter)->endOfMonth()
                ])
            ->get();

        $deciTotalSales             =   0;

        $penalty            =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'penaltyForNotReturn')
            ->first(['deciBusinessDependencyValue']);

        foreach($transactionDeceasedList as $transactionDeceased){

            if ($transactionDeceased->intTransactionType == 1){
                $deciTotalSales          +=  $transactionDeceased->deciPrice;
            }else if ($transactionDeceased->intTransactionType == 2){
                $deciTotalSales     +=  $transactionDeceased->deciPrice;
            }else if ($transactionDeceased->intTransactionType == 3){
                $deciTotalSales     +=  $transactionDeceased->deciPrice;
            }else if ($transactionDeceased->intTransactionType == 4){
                $deciTotalSales   +=  ($transactionDeceased->deciAmountPaid != 0)? $penalty->deciBusinessDependencyValue : 0;
            }//end else if

        }//end foreach

        return $deciTotalSales;

    }//end function

    public function queryCollectionTabularReport($dateFrom, $dateTo){

        $reportList                     =   array();

        $collectionList                 =   $this->getCollectionTabularReport($dateFrom, $dateTo);
        $downpaymentList                =   $this->getDownpaymentTabularReport($dateFrom, $dateTo);

        foreach($collectionList as $collection){

            $report                 =   array(
                'dateTransaction'       =>  Carbon::parse($collection->created_at)->toDateTimeString(),
                'strCustomerName'       =>  $collection->strLastName.', '.$collection->strFirstName.' '.$collection->strMiddleName,
                'intCategory'           =>  1,
                'strUnitType'           =>  $collection->strUnitTypeName,
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
                'strUnitType'           =>  $downpayment->strUnitTypeName,
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
            'tblRoomType.strUnitTypeName',
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
            'tblRoomType.strUnitTypeName',
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

    public function getDownpaymentTabularReport($dateFrom, $dateTo){

        $downpaymentList            =   $this->queryDownpayment()
            ->whereBetween('tblDownpaymentPayment.created_at', [
                Carbon::parse($dateFrom)->startOfDay(),
                Carbon::parse($dateTo)->endOfDay()
                ])
            ->get();

        $downpaymentBD              =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        foreach($downpaymentList as $downpayment){

            $discountList                   =   DownpaymentDiscount::select(
                'tblDiscountRate.intDiscountType',
                'tblDiscountRate.deciDiscountRate'
                )
                ->join('tblDiscountRate', 'tblDiscountRate.intDiscountRateId', '=', 'tblDownpaymentDiscount.intDiscountRateIdFK')
                ->where('tblDownpaymentDiscount.intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
                ->get();

            $deciDownpaymentToPay           =   $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue;

            if (Carbon::parse($downpayment->dateDownpaymentStart)->addDays(7) >= Carbon::parse($downpayment->created_at)){

                $deciDiscount               =   0;
                foreach($discountList as $discount){

                    if ($discount->intDiscountType == 1){

                        $deciDiscount           +=  ($deciDownpaymentToPay * $discount->deciDiscountRate);

                    }//end if
                    else{

                        $deciDiscount           +=  $discount->deciDiscountRate;

                    }//end else

                }//end foreach

                $deciDownpaymentToPay       -=   $deciDiscount;

            }//end if

            $deciAmountPaid                 =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
                ->where('created_at', '<=', $downpayment->created_at)
                ->sum('deciAmountPaid');

            if ($deciAmountPaid > $deciDownpaymentToPay){

                $downpayment->deciAmountPaid        =   $downpayment->deciAmountPaid - ($deciAmountPaid - $deciDownpaymentToPay);

            }//end if

        }//end foreach

        return $downpaymentList;

    }//end function

}
