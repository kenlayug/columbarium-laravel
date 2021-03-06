<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\AtNeed;
use App\ApiModel\v2\AtNeedDetail;
use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\Downpayment;
use App\Customer;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AtNeedController extends Controller
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

            $customer   = Customer::whereRaw("CONCAT(strLastName, ', ',strFirstName, ' ', strMiddleName) = '".$request->strCustomerName."'")
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

            $pcf        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
                                ->first();

            if ($pcf == null){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'message'       =>  'Oops.',
                            'error'         =>  'Perpetual Care Fund Percentage is not yet configured. Please configure it first at Business Dependency Utility.'
                        ],
                        500
                    );

            }

            $atNeed     =   AtNeed::create([
                'intCustomerIdFK'       =>  $customer->intCustomerId,
                'intPaymentType'        =>  $request->intPaymentType,
                'deciAmountPaid'        =>  $request->deciAmountPaid
            ]);

            $deciTotalAmountToPay       =   0;

            foreach ($request->unitList as $unit){

                if (!array_key_exists('interest', $unit)){

                    \DB::rollBack();
                    return response()
                        ->json(
                            [
                                'message'       =>  'Oops.',
                                'error'         =>  'Year/s to pay cannot be blank.'
                            ],
                            500
                        );

                }

                $unitPrice      =   $unit['unitPrice'];

                $deciTotalAmountToPay   +=  ($unitPrice['deciPrice'] * $pcf->deciBusinessDependencyValue);

                $interest       =   $unit['interest'];
                $interestRate   =   $interest['interestRate'];

                $atNeedDetail = AtNeedDetail::create([
                    'intAtNeedIdFK'                 =>  $atNeed->intAtNeedId,
                    'intUnitIdFK'                   =>  $unit['intUnitId'],
                    'intUnitCategoryPriceIdFK'      =>  $unitPrice['intUnitCategoryPriceId'],
                    'intInterestIdFK'               =>  $interest['intInterestId'],
                    'intInterestRateIdFK'           =>  $interestRate['intInterestRateId']
                ]);

                $downpayment    =   Downpayment::create([
                    'intCustomerIdFK'           =>  $customer->intCustomerId,
                    'intUnitIdFK'               =>  $unit['intUnitId'],
                    'intUnitCategoryPriceIdFK'  =>  $unitPrice['intUnitCategoryPriceId'],
                    'intInterestRateIdFK'       =>  $interestRate['intInterestRateId']
                ]);

                $unitData = Unit::find($unit['intUnitId']);
                $unitData->intUnitStatus = 4;
                $unitData->intCustomerIdFK = $customer->intCustomerId;
                $unitData->save();

            }

            if ($deciTotalAmountToPay > $request->deciAmountPaid){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'message'   =>  'Oops.',
                            'error'     =>  'Amount to pay is greater than amount paid.'
                        ],
                        500
                    );

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'   =>  'Transaction is successfully processed.',
                        'atNeed'    =>  $atNeed
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
