<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;
use App\ReservationDetail;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DownpaymentController extends Controller
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
        try {

            \DB::beginTransaction();
            $payment = DownpaymentPayment::create([
                'intDownpaymentIdFK' => $request->intDownpaymentId,
                'intPaymentType' => $request->intPaymentType,
                'deciAmountPaid' => $request->deciAmountPaid
            ]);

            $downpayment = Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                            ->where('tblDownpayment.intDownpaymentId', '=', $request->intDownpaymentId)
                            ->first(['tblUnitCategoryPrice.deciPrice', 'tblDownpayment.intUnitIdFK']);

            $paymentPaid = DownpaymentPayment::where('intDownpaymentIdFK', '=', $request->intDownpaymentId)
                                ->sum('deciAmountPaid');

            $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                            ->first();

            $discountSpotdown       =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountSpotdown')
                                            ->first(['deciBusinessDependencyValue']);


            $downpaymentPrice   =   $downpayment->deciPrice*$downpaymentPercentage->deciBusinessDependencyValue;

            $dateNow                =   Carbon::today();
            $dateWithDiscount       =   Carbon::parse($downpayment->created_at)->addDays(7);

            if ($dateNow <= $dateWithDiscount){
                $downpaymentPrice   =   $downpaymentPrice-($downpaymentPrice*$discountSpotdown->deciBusinessDependencyValue);
            }

            $unitId             =   $downpayment->intUnitIdFK;

            $downpaymentFinished = false;
            if ($downpaymentPrice-$paymentPaid <= 0){
                $downpayment            =   Downpayment::find($request->intDownpaymentId);
                $downpayment->boolPaid  =   true;
                $downpayment->save();
                $downpaymentFinished    =   true;
            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'downpayment'       =>  $payment,
                        'message'           =>  'Payment is successfully processed.',
                        'paid'              =>  $downpaymentFinished,
                        'intUnitId'         =>  $unitId,
                        'downpaymentPrice'  =>  $downpaymentPrice
                    ],
                    201
                );

        }catch (\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  'Something occurred.',
                        'error'         =>  $e->getMessage()
                    ],
                    500
                );
        }
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
        //
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

    public function deleteDueDateDownpayment(){

        try {

            \DB::beginTransaction();

            $downpaymentList = Downpayment::leftJoin('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
                ->where('tblDownpayment.boolPaid', '=', false)
                ->whereNull('tblDownpaymentPayment.intDownpaymentPaymentId')
                ->groupBy('tblDownpayment.intDownpaymentId')
                ->get([
                    'tblDownpayment.intDownpaymentId',
                    'tblDownpayment.intCustomerIdFK',
                    'tblDownpayment.intUnitIdFK'
                ]);

            $voidDownpaymentNoPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
                ->first();

            $voidDownpaymentNotFullPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
                ->first();

            foreach ($downpaymentList as $downpayment) {

                $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNoPayment->deciBusinessDependencyValue);
                $current = Carbon::now();

                if ($current >= $date) {
                    $downpayment->delete();

                    $unit = Unit::find($downpayment->intUnitIdFK);
                    $unit->intUnitStatus = 1;
                    $unit->save();

                    $collection = Collection::where('intUnitIdFK', '=', $unit->intUnitId)
                        ->first();
                    $collection->delete();

                }

            }

            $downpaymentList = Downpayment::join('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
                                ->where('tblDownpayment.boolPaid', '=', false)
                                ->get([
                                    'tblDownpayment.intDownpaymentId',
                                    'tblDownpayment.created_at',
                                    'tblDownpayment.intUnitIdFK'
                                ]);

            foreach ($downpaymentList as $downpayment) {

                $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNotFullPayment->deciBusinessDependencyValue);
                $current = Carbon::now();

                if ($current >= $date) {
                    $downpayment->delete();

                    $unit = Unit::find($downpayment->intUnitIdFK);
                    $unit->intUnitStatus = 1;
                    $unit->save();

                    $collection = Collection::where('intUnitIdFK', '=', $unit->intUnitId)
                                    ->first();
                    $collection->delete();
                }

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>      'Deleted downpayment due dates...'
                    ],
                    200
                );

        }catch (\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'     =>  $e->getMessage()
                    ],
                    500
                );

        }

    }

    public function getAllPayments($id){

        $paymentList            =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $id)
                                        ->get();
        $totalAmountPaid        =   0;
        foreach ($paymentList as $payment){

            $totalAmountPaid += $payment->deciAmountPaid;

        }

        $downpayment            =   Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                                        ->where('tblDownpayment.intDownpaymentId', '=', $id)
                                        ->first([
                                            'tblUnitCategoryPrice.deciPrice'
                                        ]);

        $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                        ->first();

        $balance        =   ($downpayment->deciPrice * $downpaymentPercentage->deciBusinessDependencyValue) - $totalAmountPaid;

        return response()
            ->json(
                [
                    'paymentList'   =>  $paymentList,
                    'balance'       =>  $balance
                ],
                200
            );

    }//end function

}
