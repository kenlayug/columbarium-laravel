<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Downpayment;
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
            $downpayment = Downpayment::create([
                'intReservationDetailIdFK' => $request->intReservationDetailId,
                'intPaymentType' => $request->intPaymentType,
                'deciAmount' => $request->deciAmount
            ]);

            $reservation = ReservationDetail::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblReservationDetail.intUnitCategoryPriceIdFK')
                            ->where('tblReservationDetail.intReservationDetailId', '=', $request->intReservationDetailId)
                            ->first(['tblUnitCategoryPrice.deciPrice', 'tblReservationDetail.intUnitIdFK']);

            $downpaymentPaid = Downpayment::where('intReservationDetailIdFK', '=', $request->intReservationDetailId)
                                ->sum('deciAmount');

            $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                            ->first();

            $discountSpotdown       =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountSpotdown')
                ->first(['deciBusinessDependencyValue']);


            $downpaymentPrice   =   $reservation->deciPrice*$downpaymentPercentage->deciBusinessDependencyValue;

            $dateNow                =   Carbon::today();
            $dateWithDiscount       =   Carbon::parse($reservation->created_at)->addDays(7);

            if ($dateNow <= $dateWithDiscount){
                $downpaymentPrice   =   $downpaymentPrice-($downpaymentPrice*$discountSpotdown->deciBusinessDependencyValue);
            }

            $unitId             =   $reservation->intUnitIdFK;

            $downpaymentFinished = false;
            if ($downpaymentPrice-$downpaymentPaid <= 0){
                $reservationPaid = ReservationDetail::find($request->intReservationDetailId);
                $reservationPaid->boolDownpayment = true;
                $reservationPaid->save();
                $downpaymentFinished = true;
                
                $unit   =   Unit::find($reservation->intUnitIdFK);
                $unit->intUnitStatus = 4;
                $unit->save();
            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'downpayment'       =>  $downpayment,
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
}
