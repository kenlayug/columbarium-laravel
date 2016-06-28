<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Collection;
use App\ApiModel\v2\CollectionPayment;
use App\Business\v1\CollectionBusiness;
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
                'intCollectionIdFK' => $id,
                'intPaymentType' => $request->intPaymentType
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

            \DB::commit();

            return response()
                ->json(
                    [
                        'message' => 'Payment is successfully processed.',
                        'datePayment' => $datePayment
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

        $monthlyAmortization = (new CollectionBusiness())->getMonthlyAmortization($collection->deciPrice,
                                    $collection->deciInterestRate,
                                    $collection->intNoOfYear);

        $paymentList = [];
        $currentDate = Carbon::now();
        for ($intCtr = 0; $intCtr < ($collection->intNoOfYear)*12; $intCtr++){

            $collectionDay = Carbon::parse($collection->dateCollectionStart)->addMonth($intCtr);
            $status = 0;
            $datePayment = null;
            if ($intCtr < $collectionDetail->count()){
                $status = 1;
                $datePayment = Carbon::parse($collectionDetail[$intCtr]->created_at)->format('Y-m-d');
            }else if ($currentDate >= $collectionDay){
                $status = 2;
            }
            $payment = [
                'dateCollectionDay'         =>  $collectionDay->format('Y-m-d'),
                'deciMonthlyAmortization'   =>  $monthlyAmortization,
                'boolPaid'                  =>  $status,
                'intCollectionId'           =>  $id,
                'datePayment'               =>  $datePayment
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
}
