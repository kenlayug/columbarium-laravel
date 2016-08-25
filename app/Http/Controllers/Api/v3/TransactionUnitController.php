<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v2\BusinessDependency;
use App\Unit;
use App\ApiModel\v3\TransactionUnit;
use App\ApiModel\v3\TransactionUnitDetail;
use App\ApiModel\v2\Downpayment;
use App\Customer;

use Carbon\Carbon;

class TransactionUnitController extends Controller
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

            $deciAmountToPay            =   0;

            $customerCount              =   Customer::where('intCustomerId', '=', $request->intCustomerId)
                ->count();

            if ($customerCount == 0){

                return response()
                    ->json(
                            [
                                'message'       =>      'Customer does not exist.'
                            ],
                            500
                        );

            }//end if

            if ($request->intPaymentType == null){

                return response()
                    ->json(
                            [
                                'message'       =>  'Payment type cannot be blank.'
                            ],
                            500
                        );

            }//end if

            if ($request->intPaymentType == 2){

                if ($request->cheque == null){

                    return response()
                        ->json(
                                [
                                    'message'       =>  'Cheque details cannot be blank.'
                                ],
                                500
                            );

                }//end if

            }//end if

            if ($request->intTransactionType == 3){

                $discountPayOnce        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountPayOnce')
                    ->first([
                        'deciBusinessDependencyValue'
                        ]);

                $pcf                    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
                    ->first([
                    'deciBusinessDependencyValue'
                    ]);

                foreach($request->unitList as $unit){

                    $deciUnitPrice      =      ($unit['unitPrice']['deciPrice']*$discountPayOnce->deciBusinessDependencyValue);
                    $deciPcf            =      ($unit['unitPrice']['deciPrice']*$pcf->deciBusinessDependencyValue);

                    $deciAmountToPay    +=      ($deciUnitPrice+$deciPcf);

                }//end foreach

            }//end if
            else if ($request->intTransactionType == 2){

                $reservationFee         =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
                    ->first([
                        'deciBusinessDependencyValue'
                        ]);
                $deciAmountToPay        +=  ($reservationFee->deciBusinessDependencyValue*sizeof($request->unitList));

            }//end else if
            else if ($request->intTransactionType == 4){

                $pcf                    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
                    ->first([
                        'deciBusinessDependencyValue'
                        ]);

                foreach($request->unitList as $unit){

                    $deciAmountToPay        +=  ($unit['unitPrice']['deciPrice']*$pcf->deciBusinessDependencyValue);

                }//end foreach

            }//end else if

            if ($deciAmountToPay > $request->deciAmountPaid){

                \DB::rollBack();
                return response()
                    ->json(
                            [
                                'message'       =>  'Amount to pay is greater than amount paid.'
                            ],
                            500
                        );

            }//end if

            $transactionUnit                =   TransactionUnit::create([
                'intCustomerIdFK'           =>  $request->intCustomerId,
                'intPaymentType'            =>  $request->intPaymentType,
                'intTransactionType'        =>  $request->intTransactionType,
                'deciAmountPaid'            =>  $request->deciAmountPaid
                ]);

            $downpaymentDueDate             =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
                ->first([
                    'deciBusinessDependencyValue'
                    ]);

            foreach($request->unitList as $unit){

                $transactionUnitDetail          =   TransactionUnitDetail::create([
                    'intUnitIdFK'                       =>  $unit['intUnitId'],
                    'intUnitCategoryPriceIdFK'          =>  $unit['unitPrice']['intUnitCategoryPriceId'],
                    'intTransactionUnitIdFK'            =>  $transactionUnit->intTransactionUnitId
                    ]);

                $unitData                       =   Unit::find($unit['intUnitId']);
                $unitData->intUnitStatus        =   $request->intTransactionType;
                $unitData->intCustomerIdFK      =   $request->intCustomerId;
                $unitData->save();

                if ($request->intTransactionType != 3){

                    $downpayment                    =   Downpayment::create([
                        'intCustomerIdFK'               =>  $request->intCustomerId,
                        'intUnitIdFK'                   =>  $unit['intUnitId'],
                        'intUnitCategoryPriceIdFK'      =>  $unit['unitPrice']['intUnitCategoryPriceId'],
                        'boolPaid'                      =>  false,
                        'intInterestIdFK'               =>  $unit['interest']['intInterestId'],
                        'intInterestRateIdFK'           =>  $unit['interest']['interestRate']['intInterestRateId'],
                        'dateDueDate'                   =>  Carbon::parse($transactionUnit->created_at)->addDays($downpaymentDueDate->deciBusinessDependencyValue)
                        ]);

                }//end if

            }//end foreach

            \DB::commit();

            return response()
                ->json(
                        [
                            'message'       =>  'Success!'
                        ],
                        200
                    );


        }catch(Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                        [
                            'message'       =>  $e->getMessage()
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
