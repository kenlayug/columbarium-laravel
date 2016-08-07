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

        $collectionPaymentList          =   CollectionPayment::where('intCollectionIdFK', '=', $id)
            ->get();

        $collection                     =   Collection::join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
            ->where('tblCollection.intCollectionId', '=', $id)
            ->first([
                    'tblUnitCategoryPrice.deciPrice',
                    'tblInterest.intNoOfYear',
                    'tblInterestRate.deciInterestRate',
                    'tblCollection.dateCollectionStart'
                ]);

        $monthlyAmortization            =   (new CollectionBusiness())->getMonthlyAmortization(
                $collection->deciPrice,
                $collection->deciInterestRate,
                $collection->intNoOfYear
            );

        $paymentList          =   [];

        for ($intCtr = 0; $intCtr < ($collection->intNoOfYear * 12); $intCtr++){

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

            for ($intCtr = 0; $intCtr < $collectionPayment->intMonthPaid; $intCtr++){

                $dateOfPenalty          =   Carbon::parse($paymentList[$intSubCtr]['dateCollectionDay'])->addDay($gracePeriod->deciBusinessDependencyValue);
                if ($dateOfPayment >= $dateOfPenalty) {

                    $intMonthsOverDue = $dateOfPayment->diffInMonths($dateOfPenalty)+1;
                    $penalty = (new PenaltyBusiness())->getPenalty($monthlyAmortization, $intMonthsOverDue);
                    $paymentList[$intSubCtr]['penalty']     =   $penalty;

                }
                $paymentList[$intSubCtr]['datePayment']     =   Carbon::parse($collectionPayment->created_at)->toDateTimeString();
                $paymentList[$intSubCtr]['boolPaid']        =   1;
                $intSubCtr++;

            }

        }

        for ( ; $intSubCtr < ($collection->intNoOfYear * 12); $intSubCtr++){

            $currentDate            =   Carbon::today();
            $dateOfPenalty          =   Carbon::parse($paymentList[$intSubCtr]['dateCollectionDay'])->addDay($gracePeriod->deciBusinessDependencyValue);
            $intStatus              =   0;

            if ($currentDate >= $dateOfPenalty) {

                $intMonthsOverDue = $currentDate->diffInMonths($dateOfPenalty)+1;
                $penalty = (new PenaltyBusiness())->getPenalty($monthlyAmortization, $intMonthsOverDue);
                $paymentList[$intSubCtr]['penalty']     =   $penalty;
                $intStatus          =   2;

            }
            $paymentList[$intSubCtr]['boolPaid']        =   $intStatus;

        }

        return response()
            ->json(
                    [
                        'paymentList'       =>  $paymentList
                    ],
                    200
                );

    }
}
