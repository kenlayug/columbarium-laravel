<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\ApiModel\v2\CollectionPayment;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\BusinessDependency;

use App\Business\v1\CollectionBusiness;
use App\Business\v1\PenaltyBusiness;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function getCollectionPayment($id){

        $collectionPaymentList          =   CollectionPayment::join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
            ->where('intCollectionIdFK', '=', $id)
            ->get();

        $collection                     =   Collection::find($id);

        $intNoOfYearToPay               =   0;

        if ($collection->intUnitIdFK){

            $monthlyAmortization            =   $collection->deci_monthly_amortization;

            $intNoOfYearToPay               =   $collection->interestRate->interest->intNoOfYear;

        }//end if
        else{

            $monthlyAmortization            =   $collection->servicePrice? round($collection->servicePrice->deciPrice/12, 2) : round($collection->packagePrice->deciPrice/12, 2);

            $intNoOfYearToPay               =   1;

        }//end else

        $paymentList          =   [];

        for ($intCtr = 0; $intCtr < ($intNoOfYearToPay * 12); $intCtr++){

            $collectionDay          =   Carbon::parse($collection->dateCollectionStart)->addMonth($intCtr);

            $payment = [
                'dateCollectionDay'         =>  $collectionDay->format('Y-m-d'),
                'deciMonthlyAmortization'   =>  $monthlyAmortization,
                'boolPaid'                  =>  0,
                'intCollectionId'           =>  $id,
                'datePayment'               =>  null,
                'intMonthsOverDue'          =>  0,
                'penalty'                   =>  0
            ];
            array_push($paymentList, $payment);

        }

        $intSubCtr = 0;

        $gracePeriod        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
            ->first();

        foreach($collectionPaymentList as $collectionPayment){

            $dateOfPayment          =   Carbon::parse($collectionPayment->created_at);

            $dateOfPenalty          =   Carbon::parse($paymentList[$intSubCtr]['dateCollectionDay'])->addDay($gracePeriod->deciBusinessDependencyValue);
            if ($dateOfPayment >= $dateOfPenalty) {

                $intMonthsOverDue = $dateOfPayment->diffInMonths($dateOfPenalty)+1;
                $penalty = round((new PenaltyBusiness())->getPenalty($monthlyAmortization, $intMonthsOverDue), 2);
                $paymentList[$intSubCtr]['penalty']     =   $penalty;

            }
            $paymentList[$intSubCtr]['datePayment']     =   Carbon::parse($collectionPayment->created_at)->toDateTimeString();
            $paymentList[$intSubCtr]['boolPaid']        =   1;
            $intSubCtr++;


        }//end foreach

        for ( ; $intSubCtr < ($intNoOfYearToPay * 12); $intSubCtr++){

            $currentDate            =   Carbon::today();
            $dateOfPenalty          =   Carbon::parse($paymentList[$intSubCtr]['dateCollectionDay'])->addDay($gracePeriod->deciBusinessDependencyValue);
            $dateDue                =   Carbon::parse($paymentList[$intSubCtr]['dateCollectionDay']);
            $intStatus              =   0;

            if ($currentDate >= $dateDue){

                $intStatus          =   2;

            }//end if

            if ($currentDate >= $dateOfPenalty) {

                $intMonthsOverDue = $currentDate->diffInMonths($dateOfPenalty)+1;
                $penalty = $collection->deci_penalty;
                $paymentList[$intSubCtr]['penalty']     =   $penalty;

            }//end if
            $paymentList[$intSubCtr]['boolPaid']        =   $intStatus;

        }//end for

        if ($collection->deciPrice == null){

            unset($paymentList[sizeof($paymentList)-1]);

        }//end if

        return response()
            ->json(
                    [
                        'paymentList'       =>  $paymentList
                    ],
                    200
                );

    }

    public function getReports(Request $request){

        $collectionList             =   $this->queryCollection(null)
            ->whereBetween('tblCollectionPayment.created_at', [
                Carbon::parse($request->dateFrom)->startOfDay()->toDateTimeString(),
                Carbon::parse($request->dateTo)->endOfDay()->toDateTimeString()
                ])
            ->get();

        foreach($collectionList as $collection){

            $collection->payment_paid           =   (new CollectionBusiness())->getMonthlyAmortization(
                $collection->deciPrice, $collection->intInterestRateId, $collection->intNoOfYear
                ) * $collection->intMonthPaid;

        }//end foreach

        return response()
            ->json(
                [
                    'collectionList'            =>  $collectionList
                ],
                200
            );

    }//end function

    public function queryCollection($id){
        $collectionList             =   Collection::select(
            'tblCollectionPayment.intCollectionPaymentId',
            'tblCollectionPayment.created_at',
            'tblCollectionPayment.intMonthPaid',
            'tblCollectionPayment.intPaymentType',
            'tblCollection.dateCollectionStart',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName', 
            'tblCustomer.strLastName',
            'tblCollection.intUnitIdFK',
            'tblUnitCategoryPrice.deciPrice',
            'tblInterest.intNoOfYear',
            'tblInterestRate.deciInterestRate'
            )
            ->join('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
            ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK');
        
        if ($id){
            return $collectionList->where('tblCollection.intCollectionId', '=', $id);
        }

        return $collectionList;

    }//end function
}
