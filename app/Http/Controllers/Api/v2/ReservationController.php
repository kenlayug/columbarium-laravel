<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\Downpayment;
use App\Customer;
use App\Reservation;
use App\ReservationDetail;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
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
        try{

            \DB::beginTransaction();

            $reservationFee    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
                                    ->first();

            if ($reservationFee == null){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'error'         =>  'Reservation fee is not yet configured. Please configure it first at Business Dependency Utility.',
                            'message'       =>  'Oops.'
                        ]
                    );

            }

            $deciTotalAmountToPay       =   ($reservationFee->deciBusinessDependencyValue * sizeof($request->unitList));

            if (sizeof($request->unitList) == 0){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'message'   =>  'Oops.',
                            'error'     =>  'Please pick one or more units first.'
                        ],
                        500
                    );

            }


            if ($deciTotalAmountToPay > $request->deciAmountPaid){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'error'     =>  'Amount to pay is greater than amount paid.',
                            'message'   =>  'Oops.'
                        ],
                        500
                    );

            }

            $reservation = Reservation::create([
                'intCustomerIdFK'       =>      $request->intCustomerId,
                'deciAmountPaid'        =>      $request->deciAmountPaid
            ]);

            foreach ($request->unitList as $unit){

                if (!array_key_exists('interest', $unit)){

                    \DB::rollBack();
                    return response()
                        ->json(
                            [
                                'message'           =>  'Oops.',
                                'error'             =>  'Year/s to pay cannot be blank.'
                            ],
                            500
                        );

                }

                $unitPrice      =   $unit['unitPrice'];
                $interest       =   $unit['interest'];
                $interestRate   =   $interest['interestRate'];

                $reservationDetail = ReservationDetail::create([
                    'intReservationIdFK'            =>  $reservation->intReservationId,
                    'intUnitIdFK'                   =>  $unit['intUnitId'],
                    'intUnitCategoryPriceIdFK'      =>  $unitPrice['intUnitCategoryPriceId'],
                    'intInterestIdFK'               =>  $interest['intInterestId'],
                    'intInterestRateIdFK'           =>  $interestRate['intInterestRateId']
                ]);

                $downpayment        =   Downpayment::create([
                    'intCustomerIdFK'           =>  $request->intCustomerId,
                    'intUnitIdFK'               =>  $unit['intUnitId'],
                    'intUnitCategoryPriceIdFK'  =>  $unitPrice['intUnitCategoryPriceId'],
                    'intInterestRateIdFK'       =>  $interestRate['intInterestRateId']
                ]);

                $unitData = Unit::find($unit['intUnitId']);
                $unitData->intUnitStatus = 2;
                $unitData->intCustomerIdFK = $request->intCustomerId;
                $unitData->save();

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'           =>  'Reservation is successfully processed.',
                        'reservation'       =>  $reservation
                    ],
                    201
                );

        }catch(\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'           =>  'Something occured.',
                        'error'             =>  $e->getMessage()
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

    public function deleteDueDateReservations(){

        $reservationList  =   ReservationDetail::leftJoin('tblDownpayment', 'tblDownpayment.intReservationDetailIdFK', '=', 'tblReservationDetail.intReservationDetailId')
                                ->whereNull('tblDownpayment.intDownpaymentId')
                                ->get([
                                    'tblReservationDetail.intReservationDetailId',
                                    'tblReservationDetail.intUnitIdFK',
                                    'tblReservationDetail.created_at'
                                ]);

        $voidReservationNoPayment       =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
                                            ->first();

        $voidReservationNotFullPayment =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
                                                ->first();

        foreach ($reservationList as $reservation){

            $date = Carbon::parse($reservation->created_at)->addDays($voidReservationNoPayment->deciBusinessDependencyValue);
            $current = Carbon::now();

            if ($current >= $date ){
                $reservation->delete();
                
                $unit                   =   Unit::find($reservation->intUnitIdFK);
                $unit->intUnitStatus    =   1;
                $unit->save();

                $collection             =   Collection::where('intUnitIdFK', '=', $unit->intUnitId)
                    ->first();
                $collection->delete();
            }

        }

        $reservationList    =   ReservationDetail::leftJoin('tblDownpayment', 'tblDownpayment.intReservationDetailIdFK', '=', 'tblReservationDetail.intReservationDetailId')
                                    ->get([
                                        'tblReservationDetail.intReservationDetailId',
                                        'tblReservationDetail.created_at'
                                    ]);

        foreach ($reservationList as $reservation){
            
            $date = Carbon::parse($reservation->created_at)->addDays($voidReservationNotFullPayment->deciBusinessDependencyValue);
            $current = Carbon::now();

            if ($current >= $date ){
                $reservation->delete();

                $unit                   =   Unit::find($reservation->intUnitIdFK);
                $unit->intUnitStatus    =   1;
                $unit->save();

                $collection             =   Collection::where('intUnitIdFK', '=', $unit->intUnitId)
                                                ->first();
                $collection->delete();
            }

        }

    }

    public function getAllDownpayments($id){

        $downpayment        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                    ->first();

        $downpaymentList    =   Downpayment::where('intReservationDetailIdFK', '=', $id)
                                    ->get();

        $reservationDetail  =   ReservationDetail::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblReservationDetail.intUnitCategoryPriceIdFK')
                                    ->where('tblReservationDetail.intReservationDetailId', '=', $id)
                                    ->first(['tblUnitCategoryPrice.deciPrice']);

        $downpaymentAmount = 0;
        foreach ($downpaymentList as $downpayment){

            $downpaymentAmount += $downpayment->deciAmount;

        }

        $balance = ($reservationDetail->deciPrice*$downpayment->deciBusinessDependencyValue)-$downpaymentAmount;

        return response()
            ->json(
                [
                    'downpaymentList'       =>  $downpaymentList,
                    'balance'               =>  $balance
                ],
                200
            );

    }
}
