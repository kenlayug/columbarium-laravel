<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\CollectionPayment;
use App\ApiModel\v2\UnitDeceased;
use App\ApiModel\v3\CollectionPaymentDetail;
use App\Business\v1\CollectionBusiness;
use App\Business\v1\PenaltyBusiness;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Business\v1\SmsGateway;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
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
        try {

            \DB::beginTransaction();

            $collectionPayment = CollectionPayment::create([
                'intCollectionIdFK' =>  $id,
                'intPaymentType'    =>  $request->intPaymentType,
                'deciAmountPaid'    =>  $request->deciAmountPaid
            ]);

            foreach($request->collectionListToPay as $collectionToPay){

                $collectionPaymentDetail        =   CollectionPaymentDetail::create([
                    'intCollectionPaymentIdFK'      =>  $collectionPayment->intCollectionPaymentId,
                    'dateDue'                       =>  $collectionToPay['dateCollectionDay']
                ]);

            }//end foreach

            $unit               =   null;

            $datePayment = Carbon::parse($collectionPayment->created_at)->format('Y-m-d');

            $count = CollectionPayment::join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                ->where('tblCollectionPayment.intCollectionIdFK', '=', $id)
                ->count();

            $collection = Collection::leftJoin('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
                ->leftJoin('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
                ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblCollection.intServicePriceIdFK')
                ->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblServicePrice.intServiceIdFK')
                ->leftJoin('tblPackagePrice', 'tblPackagePrice.intPackagePriceId', '=', 'tblCollection.intPackagePriceIdFK')
                ->leftJoin('tblPackage', 'tblPackage.intPackageId', '=', 'tblPackagePrice.intPackageIdFK')
                ->where('tblCollection.intCollectionId', '=', $id)
                ->first([
                    'tblCollection.intCollectionId',
                    'tblInterest.intNoOfYear',
                    'tblService.strServiceName',
                    'tblServicePrice.deciPrice as deciServicePrice',
                    'tblPackage.strPackageName',
                    'tblPackagePrice.deciPrice as deciPackagePrice'
                ]);

            $boolPreNeed                =   null;

            if ($collection->intNoOfYear){

                $intNoOfYearToPay           =   $collection->intNoOfYear;
                $unit           =   Collection::join('tblUnit', 'tblUnit.intUnitId', '=', 'tblCollection.intUnitIdFK')
                    ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
                    ->where('tblCollection.intCollectionId', '=', $id)
                    ->orderBy('tblUnitCategoryPrice.created_at', 'desc')
                    ->first([
                        'tblUnit.intUnitId',
                        'tblUnitCategoryPrice.deciPrice'
                    ]);

                $unitToPay          =   Unit::find($unit->intUnitId);

                $partiallyOwned     =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'partiallyOwned')
                    ->first(['deciBusinessDependencyValue']);

                $collectionToUpdate       =   Collection::join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
                    ->where('tblCollection.intCollectionId', '=', $collection->intCollectionId)
                    ->first([
                        'tblInterestRate.intAtNeed'
                        ]);

                if ($collectionToUpdate->intAtNeed == 0){

                    if($count >= $partiallyOwned->deciBusinessDependencyValue){

                        if ($unitToPay->intUnitStatus == 5){

                            $unitToPay->intUnitStatus   =   6;
                            $unitToPay->save();

                        }//end if

                    }//end if

                }//end if

            }//end if
            else{

                $intNoOfYearToPay           =   1;
                $boolPreNeed                =   true;

            }//end else            

            if (($intNoOfYearToPay) * 12 == $count) {

                $collection->boolFinish = true;
                $collection->save();
                if ($collection->intNoOfYear){

                    $unitToPay          =   Unit::find($unit->intUnitId);
                    $unitToPay->intUnitStatus = 3;
                    $unitToPay->save();

                }//end if

            }//end if

            if ($boolPreNeed){

                if (($intNoOfYearToPay * 12)-1 == $count){

                    $collection->boolFinish             =   true;
                    $collection->save();

                }//end if

            }//end if

            $deciTotalAmountToPay               =   0;
            foreach($request->collectionListToPay as $collectionToPay){

                $deciTotalAmountToPay           +=  ($collectionToPay['deciMonthlyAmortization'] + $collectionToPay['penalty']);

            }//end foreach

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'               =>  'Payment is successfully processed.',
                        'datePayment'           =>  $datePayment,
                        'collectionPayment'     =>  $collectionPayment,
                        'monthsPaid'            =>  sizeof($request->collectionListToPay),
                        'collectionListToPay'   =>  $request->collectionListToPay,
                        'unit'                  =>  $unit? $unit : null,
                        'deciTotalAmountToPay'  =>  $deciTotalAmountToPay,
                        'boolPreNeed'           =>  $boolPreNeed,
                        'strServiceName'        =>  $collection->strServiceName? $collection->strServiceName : null,
                        'deciServicePrice'      =>  $collection->deciServicePrice? $collection->deciServicePrice : null,
                        'strPackageName'        =>  $collection->strPackageName? $collection->strPackageName : null,
                        'deciPackagePrice'      =>  $collection->deciPackagePrice? $collection->deciPackagePrice : null
                    ],
                    201
                );
        }catch(\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'   =>  'Something occurred.',
                        'error'     =>  $e->getMessage()
                    ],
                    500
                );
        }
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

    public function getAllPayments($id){

        $collection = Collection::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=',
                        'tblCollection.intUnitCategoryPriceIdFK')
                        ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
                        ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
                        ->where('tblCollection.intCollectionId', '=', $id)
                        ->first([
                            'tblUnitCategoryPrice.deciPrice',
                            'tblInterest.intNoOfYear',
                            'tblInterestRate.deciInterestRate',
                            'tblCollection.dateCollectionStart'
                        ]);

        $collectionDetail = CollectionPayment::where('intCollectionIdFK', '=', $id)
            ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
            ->get();

        $gracePeriod        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
                                    ->first();

        $monthlyAmortization = (new CollectionBusiness())->getMonthlyAmortization($collection->deciPrice,
                                    $collection->deciInterestRate,
                                    $collection->intNoOfYear);

        $intMonthPaid       =   $collectionDetail == null? 0 : $collectionDetail->count(); 

        $paymentList = [];
        $currentDate = Carbon::now();
        for ($intCtr = 0; $intCtr < ($collection->intNoOfYear)*12; $intCtr++){

            $collectionDay = Carbon::parse($collection->dateCollectionStart)->addMonth($intCtr);
            $dayWithPenalty = Carbon::parse($collection->dateCollectionStart)->addMonth($intCtr)->addDays($gracePeriod->deciBusinessDependencyValue);

            $status = 0;//not paid
            $datePayment = null;
            $penalty = 0;
            $intMonthsOverDue   =   null;

            if ($intCtr < $collectionDetail->count()){
                $status = 1;//paid
                $datePayment = Carbon::parse($collectionDetail[$intCtr]->created_at)->format('Y-m-d');
            }else if ($currentDate >= $collectionDay){
                $status = 2; //over due
                if ($currentDate >= $dayWithPenalty) {

                    $intMonthsOverDue = $currentDate->diffInMonths($dayWithPenalty)+1;
                    $penalty = (new PenaltyBusiness())->getPenalty($monthlyAmortization, $intMonthsOverDue);

                }
            }
            $payment = [
                'dateCollectionDay'         =>  $collectionDay->format('Y-m-d'),
                'deciMonthlyAmortization'   =>  $monthlyAmortization,
                'boolPaid'                  =>  $status,
                'intCollectionId'           =>  $id,
                'datePayment'               =>  $datePayment,
                'intMonthsOverDue'          =>  $intMonthsOverDue,
                'penalty'                   =>  $penalty
            ];
            array_push($paymentList, $payment);

        }

        return response()
            ->json(
                [
                    'paymentList'   =>  $paymentList
                ],
                200
            );
    }

    public function deleteOverDueCollections(){

        
    }//end function
}
