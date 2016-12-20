<?php

namespace App\Http\Controllers\Pdf;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App;
use Carbon\Carbon;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;
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
            'tblCollection.intCollectionId',
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

        $deciMonthlyAmortization            =   Collection::find($collection->intCollectionId)
            ->deci_monthly_amortization;

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

        $service                =   null;
        $package                =   null;
        $price                  =   $collection->deciPrice;
        if (Collection::find($collection->intCollectionId)->intServicePriceIdFK){

            $service                =   Collection::find($collection->intCollectionId)
                ->servicePrice
                ->service;

            $price          =   $service->deciPrice;

        }else if (Collection::find($collection->intCollectionId)->intPackagePriceIdFK){

            $package               =   Collection::find($collection->intCollectionId)
                ->packagePrice
                ->package;

            $price          =   $package->deciPrice;

        }//end else

        $transaction                =   array(
            'strCustomerName'       =>  $collection->strLastName.", ".$collection->strFirstName." ".$collection->strMiddleName,
            'intTransactionId'      =>  $collection->intCollectionPaymentId,
            'intUnitId'             =>  $collection->unit? $collection->unit->unit_display : null,
            'deciPrice'             =>  $price,
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
        $downpaymentPayment     =   DownpaymentPayment::find($id);

        $downpayment            =   $downpaymentPayment->downpayment;

        $downpaymentDetails             =   array(
            'intTransactionId'          =>  $downpaymentPayment->intDownpaymentPaymentId,
            'dateTransaction'           =>  Carbon::parse($downpaymentPayment->created_at)->toDayDateTimeString(),
            'strBuildingName'           =>  $downpayment->unit->block->room->floor->building->strBuildingName,
            'intFloorNo'                =>  $downpayment->unit->block->room->floor->intFloorNo,
            'strRoomName'               =>  $downpayment->unit->block->room->strRoomName,
            'intBlockNo'                =>  $downpayment->unit->block->intBlockNo,
            'intUnitId'                 =>  $downpayment->unit->unit_display,
            'deciDownpaymentBalance'    =>  $downpayment->deci_balance+$downpaymentPayment->deciAmountPaid,
            'deciAmountPaid'            =>  $downpaymentPayment->deciAmountPaid,
            'strCustomerName'           =>  $downpayment->customer->str_full_name,
            'boolDiscounted'            =>  $downpayment->bool_discounted
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
