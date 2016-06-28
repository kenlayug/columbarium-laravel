<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BuyUnit;
use App\ApiModel\v2\BuyUnitDetail;
use App\Customer;
use App\Unit;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BuyUnitController extends Controller
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

            if ($customer == null){

                return response()
                    ->json(
                        [
                            'message'       =>  'Oops.',
                            'error'         =>  'Customer does not exist.'
                        ],
                        500
                    );

            }

            $buyUnit = BuyUnit::create([
                'intCustomerIdFK'       =>  $customer->intCustomerId,
                'intPaymentType'        =>  $request->intPaymentType,
                'deciAmountPaid'        =>  $request->deciAmountPaid
            ]);

            foreach ($request->unitList as $unit){

                $unitPrice      =   $unit['unitPrice'];

                $buyUnitDetail = BuyUnitDetail::create([
                    'intBuyUnitIdFK'    =>  $buyUnit->intBuyUnitId,
                    'intUnitIdFK'       =>  $unit['intUnitId'],
                    'intUnitCategoryPriceIdFK'  =>  $unitPrice['intUnitCategoryPriceId']
                ]);

                $unitData = Unit::find($unit['intUnitId']);
                $unitData->intUnitStatus = 3;
                $unitData->intCustomerIdFK = $customer->intCustomerId;
                $unitData->save();

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>  'Transaction is successfully processed.',
                        'buy-unit'      =>  $buyUnit
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
