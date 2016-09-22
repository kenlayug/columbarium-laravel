<?php

namespace App\Http\Controllers\Pdf;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App;
use Carbon\Carbon;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\CollectionPayment;

use App\ApiModel\v3\AssignDiscount;
use App\ApiModel\v3\DiscountRate;

use App\Business\v1\CollectionBusiness;
use App\Business\v1\PenaltyBusiness;

class CollectionPdfController extends Controller
{
    public function generateCollection($id){

        $collection          =   Collection::select(
            'tblCollection.intUnitIdFK',
            'tblCustomer.strFirstName', 
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblUnitCategoryPrice.deciPrice',
            'tblInterest.intNoOfYear',
            'tblInterestRate.deciInterestRate',
            'tblCollectionPayment.intCollectionPaymentId',
            'tblCollectionPayment.created_at',
            'tblCollectionPayment.deciAmountPaid',
            'tblServicePrice.deciPrice as deciServicePrice',
            'tblPackagePrice.deciPrice as deciPackagePrice',
            'tblService.strServiceName',
            'tblPackage.strPackageName'
            )
            ->join('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->leftJoin('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
            ->leftJoin('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
            ->leftJoin('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblCollection.intServicePriceIdFK')
            ->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblServicePrice.intServiceIdFK')
            ->leftJoin('tblPackagePrice', 'tblPackagePrice.intPackagePriceId', '=', 'tblCollection.intPackagePriceIdFK')
            ->leftJoin('tblPackage', 'tblPackage.intPackageId', '=', 'tblPackagePrice.intPackageIdFK')
            ->where('tblCollectionPayment.intCollectionPaymentId', '=', $id)
            ->first();

        $deciMonthlyAmortization                =   0;

        if ($collection->deciPrice){

            $deciMonthlyAmortization            =   (new CollectionBusiness())
                ->getMonthlyAmortization($collection->deciPrice, $collection->deciInterestRate, $collection->intNoOfYear);

        }//end if
        else{

            $deciMonthlyAmortization            =   $collection->deciServicePrice? $collection->deciServicePrice/12 : $collection->deciPackagePrice/12;

        }//end else

        $collectionPaymentList  =   CollectionPayment::select(
            'tblCollectionPaymentDetail.dateDue'
            )
            ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
            ->where('tblCollectionPayment.intCollectionPaymentId', '=', $id)
            ->get();

        $datePayment            =   Carbon::parse($collection->created_at);

        $gracePeriod            =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
            ->first(['deciBusinessDependencyValue']);

        $collectionPaymentDetailList            =   array();
        $deciTotalAmountToPay                   =   0;

        foreach($collectionPaymentList as $collectionPayment){

            $dateDue            =   Carbon::parse($collectionPayment->dateDue);
            $dateDue->addDays($gracePeriod->deciBusinessDependencyValue);

            $deciPenalty        =   0;

            if ($dateDue < $datePayment){

                $intMonthsDue           =   $dateDue->diffInMonths($datePayment)+1;
                $deciPenalty            =   (new PenaltyBusiness())
                    ->getPenalty($deciMonthlyAmortization, $intMonthsDue);

            }//end if

            $collectionPaymentDetail        =   array(
                'dateDue'                   =>  Carbon::parse($collectionPayment->dateDue)
                    ->toFormattedDateString(),
                'deciMonthlyAmortization'   =>  $deciMonthlyAmortization,
                'deciPenalty'               =>  $deciPenalty
            );
            array_push($collectionPaymentDetailList, $collectionPaymentDetail);
            $deciTotalAmountToPay           +=  ($deciPenalty + $deciMonthlyAmortization);

        }//end foreach

        $transaction                =   array(
            'strCustomerName'       =>  $collection->strLastName.", ".$collection->strFirstName." ".$collection->strMiddleName,
            'intTransactionId'      =>  $collection->intCollectionPaymentId,
            'intUnitId'             =>  $collection->intUnitIdFK,
            'deciPrice'             =>  $collection->deciPrice,
            'deciAmountPaid'        =>  $collection->deciAmountPaid,
            'deciAmountToPay'       =>  $deciTotalAmountToPay,
            'dateTransaction'       =>  Carbon::parse($collection->created_at)
                ->toDayDateTimeString(),
            'strServiceName'        =>  $collection->strServiceName? $collection->strServiceName : null,
            'strPackageName'        =>  $collection->strPackageName? $collection->strPackageName : null,
            'deciServicePrice'      =>  $collection->deciServicePrice? $collection->deciServicePrice : null,
            'deciPackagePrice'      =>  $collection->deciPackagePrice? $collection->deciPackagePrice : null
        );

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.collections-success', [
            'collection'            =>  true,
            'downpayment'           =>  false,
            'collectionDetailList'  =>  $collectionPaymentDetailList,
            'transaction'           =>  $transaction
        ]);
        return $pdf->stream('collections-success.pdf');
    }//end function

    public function generateDownpayment($id){

        $boolDiscounted         =   false;
        $downpayment            =   Downpayment::select(
            'tblDownpayment.intDownpaymentId',
            'tblDownpaymentPayment.intDownpaymentPaymentId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblDownpaymentPayment.created_at',
            'tblDownpayment.intUnitIdFK',
            'tblDownpaymentPayment.deciAmountPaid',
            'tblUnitCategoryPrice.deciPrice',
            'tblDownpayment.created_at as dateDownpayment',
            'tblUnit.intColumnNo',
            'tblUnitCategory.intLevelNo',
            'tblBlock.intBlockNo',
            'tblRoom.strRoomName',
            'tblFloor.intFloorNo',
            'tblBuilding.strBuildingName'
            )
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblDownpayment.intUnitIdFK')
            ->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->join('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->where('tblDownpaymentPayment.intDownpaymentPaymentId', '=', $id)
            ->first();

        $deciTotalDownpaymentPaid       =   Downpayment::join('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->where('tblDownpayment.intDownpaymentId', '=', $downpayment->intDownpaymentId)
            ->where('tblDownpaymentPayment.created_at', '<=', $downpayment->created_at)
            ->sum('tblDownpaymentPayment.deciAmountPaid');

        $downpaymentBD                  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        $discountList                   =   AssignDiscount::select(
            'intDiscountIdFK'
            )
            ->where('intTransactionId', '=', 2)
            ->get();

        foreach($discountList as $discount){

            $discount->discountRate         =   DiscountRate::select(
                'intDiscountType',
                'deciDiscountRate'
                )
                ->where('intDiscountIdFK', '=', $discount->intDiscountIdFK)
                ->orderBy('created_at', 'desc')
                ->first();

        }//end foreach

        $dateWithDiscount       =   Carbon::parse($downpayment->dateDownpayment)->addDays(7);

        $downpaymentPrice       =   $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue;

        if (Carbon::today() <= $dateWithDiscount){

            $deciDiscount       =   0;
            foreach($discountList as $discount){

                if ($discount->discountRate->intDiscountType == 1){

                    $deciDiscount           +=  (($downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue) * $discount->discountRate->deciDiscountRate);

                }else{

                    $deciDiscount           +=  $discount->discountRate->deciDiscountRate;

                }//end else

            }//end foreach

            $downpaymentPrice   =   ($downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue) - $deciDiscount;
            $boolDiscounted     =   true;
        }//end if

        $downpaymentDetails             =   array(
            'intTransactionId'          =>  $downpayment->intDownpaymentPaymentId,
            'dateTransaction'           =>  Carbon::parse($downpayment->created_at)->toDayDateTimeString(),
            'strBuildingName'           =>  $downpayment->strBuildingName,
            'intFloorNo'                =>  $downpayment->intFloorNo,
            'strRoomName'               =>  $downpayment->strRoomName,
            'intBlockNo'                =>  $downpayment->intBlockNo,
            'intUnitId'                 =>  chr(64+$downpayment->intLevelNo).$downpayment->intColumnNo,
            'deciDownpaymentBalance'    =>  $downpaymentPrice - ($deciTotalDownpaymentPaid - $downpayment->deciAmountPaid),
            'deciAmountPaid'            =>  $downpayment->deciAmountPaid,
            'strCustomerName'           =>  $downpayment->strLastName.', '.$downpayment->strFirstName.' '.$downpayment->strMiddleName,
            'boolDiscounted'            =>  $boolDiscounted
        );

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.collections-success', [
            'collection'            =>  false,
            'downpayment'           =>  true,
            'downpaymentDetails'    =>  $downpaymentDetails
        ]);
        return $pdf->stream('collections-success.pdf');
    }//end function
}
