<?php

namespace App\Http\Controllers\Api\v2;

use App\Customer;
use App\Reservation;
use App\ReservationDetail;
use App\Unit;
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

            $customer = Customer::whereRaw("CONCAT(strLastName, ', ',strFirstName, ' ', strMiddleName) = '".$request->strCustomerName."'")
                ->first(['intCustomerId']);

            $reservation = Reservation::create([
                'intCustomerIdFK'       =>      $customer->intCustomerId,
                'deciAmountPaid'        =>      $request->deciAmountPaid
            ]);

            foreach ($request->unitList as $unit){

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

                $unitData = Unit::find($unit['intUnitId']);
                $unitData->intUnitStatus = 2;
                $unitData->save();

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'           =>  'Reservation is successfully processed.'
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
}
