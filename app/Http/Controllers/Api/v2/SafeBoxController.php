<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\UnitDeceased;
use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\TransactionDeceased;
use App\ApiModel\v2\TransactionDeceasedDetail;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class SafeBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitDeceasedList       =   UnitDeceased::join('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDeceased.intCustomerIdFK')
            ->whereNull('tblUnitDeceased.intUnitIdFK')
            ->get([
                'tblDeceased.intDeceasedId',
                'tblDeceased.strFirstName as strDeceasedFirst',
                'tblDeceased.strMiddleName as strDeceasedMiddle',
                'tblDeceased.strLastName as strDeceasedLast',
                'tblCustomer.strFirstName as strCustomerFirst',
                'tblCustomer.strMiddleName as strCustomerMiddle',
                'tblCustomer.strLastName as strCustomerLast'
            ]);


        return response()
            ->json(
                [
                    'unitDeceasedList'      =>  $unitDeceasedList
                ],
                200
            );
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
        //
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
        try{

            DB::beginTransaction();
            $deceased           =   Deceased::join('tblUnitDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
                ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDeceased.intCustomerIdFK')
                ->where('tblDeceased.intDeceasedId', '=', $id)
                ->first([
                    'tblCustomer.intCustomerId',
                    'tblDeceased.intDeceasedId',
                    'tblUnitDeceased.intUnitDeceasedId'
                ]);

            $paymentUrn            =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'paymentUrn')
                ->first(['deciBusinessDependencyValue']);

            if ($paymentUrn->deciBusinessDependencyValue > $request->deciAmountPaid){

                DB::rollBack();
                return response()
                    ->json(
                        [
                            'message'           =>  'Amount to pay is greater than amount paid.'
                        ],
                        500
                    );

            }//end if

            if (!$request->intPaymentType){

                DB::rollBack();
                return response()
                    ->json(
                        [
                            'message'           =>  'Payment type cannot be blank.'
                        ],
                        500
                    );

            }//end if

            $transactionDeceased            =   TransactionDeceased::create([
                'intPaymentType'            =>  $request->intPaymentType,
                'intTransactionType'        =>  5,
                'deciAmountPaid'            =>  $request->deciAmountPaid
            ]);

            $transactionDeceasedDetail      =   TransactionDeceasedDetail::create([
                'intTDeceasedIdFK'            =>  $transactionDeceased->intTransactionDeceasedId,
                'intUDeceasedIdFK'            =>  $deceased->intUnitDeceasedId
            ]);

            $unitDeceased                   =   UnitDeceased::find($deceased->intUnitDeceasedId)
                ->delete();

            DB::commit();
            return response()
                ->json(
                    [
                        'message'           =>  'Success!'
                    ],
                    200
                );

        }catch(Exception $e){
            DB::rollBack();
            return response()
                ->json(
                    [
                        'message'           =>  $e->getMessage()
                    ],
                    500
                );
        }//end try catch
    }//end function

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }//end function
}
