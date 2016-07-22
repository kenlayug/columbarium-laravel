<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\CollectionPayment;
use App\ApiModel\v2\UnitDeceased;
use App\Business\v1\CollectionBusiness;
use App\Business\v1\PenaltyBusiness;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            $datePayment = Carbon::parse($collectionPayment->created_at)->format('Y-m-d');

            $count = CollectionPayment::where('intCollectionIdFK', '=', $id)
                        ->count();

            $collection = Collection::join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
                ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
                ->where('tblCollection.intCollectionId', '=', $id)
                ->first([
                    'tblCollection.intCollectionId',
                    'tblInterest.intNoOfYear'
                ]);

            if (($collection->intNoOfYear) * 12 == $count) {
                $collection->boolFinish = true;
                $collection->save();
            }

            $unit           =   Collection::join('tblUnit', 'tblUnit.intUnitId', '=', 'tblCollection.intUnitIdFK')
                                    ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
                                    ->where('tblCollection.intCollectionId', '=', $id)
                                    ->orderBy('tblUnitCategoryPrice.created_at', 'desc')
                                    ->first([
                                        'tblUnit.intUnitId',
                                        'tblUnitCategoryPrice.deciPrice'
                                    ]);

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'           =>  'Payment is successfully processed.',
                        'datePayment'       =>  $datePayment,
                        'collectionPayment' =>  $collectionPayment,
                        'unit'              =>  $unit
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
                                ->get();

        $gracePeriod        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
                                    ->first();

        $monthlyAmortization = (new CollectionBusiness())->getMonthlyAmortization($collection->deciPrice,
                                    $collection->deciInterestRate,
                                    $collection->intNoOfYear);

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

        try{

            \DB::beginTransaction();
            $collectionList     =   Collection::all();
            $dateCurrent        =   Carbon::today();

            $gracePeriod                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
                                                ->first();

            $monthsCollectionOverDue    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidOwnershipOverDue')
                                                ->first();

            foreach ($collectionList as $collection){

                $intCountPayment            =   CollectionPayment::where('intCollectionIdFK', '=', $collection->intCollectionId)
                                                    ->orderBy('created_at', 'desc')
                                                    ->count();

                $dateLastCollectionOverDue  =   Carbon::parse($collection->dateCollectionStart)
                                                    ->addMonth($intCountPayment-1)
                                                    ->addDays($gracePeriod->deciBusinessDependencyValue);

                if ($dateLastCollectionOverDue->diffInMonths($dateCurrent) >= $monthsCollectionOverDue->deciBusinessDependencyValue){

                    $intCountDeceased       =   UnitDeceased::where('intUnitIdFK', '=', $collection->intUnitIdFK)
                                                    ->count();

                    if ($intCountDeceased != 0){

                        $unitDeceasedList   =   UnitDeceased::where('intUnitIdFK', '=', $collection->intUnitIdFK)
                                                    ->get();

                        foreach ($unitDeceasedList as $unitDeceased){

                            $unitDeceased->intUnitIdFK      =   null;
                            $unitDeceased->save();

                        }//end foreach

                    }//end if

                    $unit                   =   Unit::find($collection->intUnitIdFK);
                    $unit->intUnitStatus    =   1;
                    $unit->intCustomerIdFK  =   null;
                    $unit->save();

                    $collection->delete();

                }//end if

            }//end foreach

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>  'Deleted overdue collections...'
                    ],
                    200
                );

        }catch(\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'     =>  $e->getMessage()
                    ],
                    500
                );

        }//end catch

    }//end function
}
