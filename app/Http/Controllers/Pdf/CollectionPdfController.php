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
            'tblCollectionPayment.deciAmountPaid'
            )
            ->join('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
            ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->where('tblCollectionPayment.intCollectionPaymentId', '=', $id)
            ->first();

        $deciMonthlyAmortization            =   (new CollectionBusiness())
            ->getMonthlyAmortization($collection->deciPrice, $collection->deciInterestRate, $collection->intNoOfYear);

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
                ->toDayDateTimeString()
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
            'tblDownpaymentPayment.intDownpaymentPaymentId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblDownpaymentPayment.created_at',
            'tblDownpayment.intUnitIdFK',
            'tblDownpaymentPayment.deciAmountPaid',
            'tblUnitCategoryPrice.deciPrice',
            'tblDownpayment.created_at as dateDownpayment'
            )
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->join('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->where('tblDownpaymentPayment.intDownpaymentPaymentId', '=', $id)
            ->first();

        // dd($downpayment);
        $deciTotalDownpaymentPaid       =   Downpayment::join('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->where('tblDownpaymentPayment.created_at', '<=', $downpayment->created_at)
            ->sum('tblDownpaymentPayment.deciAmountPaid');

        $downpaymentBD                  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        $discountSpotdown               =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountSpotdown')
            ->first(['deciBusinessDependencyValue']);

        $dateWithDiscount       =   Carbon::parse($downpayment->dateDownpayment)->addDays(7);

        $downpaymentPrice       =   $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue;

        if (Carbon::today() <= $dateWithDiscount){
            $downpaymentPrice   =   ($downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue) - (($downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue) * $discountSpotdown->deciBusinessDependencyValue);
            $boolDiscounted     =   true;
        }//end if

        $downpaymentDetails             =   array(
            'intTransactionId'          =>  $downpayment->intDownpaymentPaymentId,
            'dateTransaction'           =>  Carbon::parse($downpayment->created_at)->toDayDateTimeString(),
            'intUnitId'                 =>  $downpayment->intUnitIdFK,
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
