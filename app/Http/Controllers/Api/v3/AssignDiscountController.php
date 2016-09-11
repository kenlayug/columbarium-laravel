<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v3\AssignDiscount;

class AssignDiscountController extends Controller
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

            foreach($request->discountList as $discount){

                try{

                    $assignDiscount             =   AssignDiscount::create([
                        'intServiceIdFK'        =>  $request->intServiceId,
                        'intTransactionId'      =>  $request->intTransactionId,
                        'intDiscountIdFK'       =>  $discount
                        ]);

                }//end try
                catch(QueryException $e){

                }//end catch

            }//end foreach

            $assignDiscountList             =   null;
            if ($request->intServiceId){

                $assignDiscountList         =   AssignDiscount::where('intServiceIdFK', '=', $request->intServiceId);

            }//end if
            else{

                $assignDiscountList         =   AssignDiscount::where('intTransactionId', '=', $request->intTransactionId);

            }//end else
            $asssignDiscountList            =   $assignDiscountList->get();

            if ($assignDiscountList){

                foreach($assignDiscountList as $assignDiscount){

                    $boolExist          =   false;
                    foreach($discountList as $discount){

                        if ($discount == $assignDiscount->intDiscountIdFK){

                            $boolExist          =   true;

                        }//end if

                    }//end foreach

                    if (!$boolExist){

                        $assignDiscount->delete();

                    }//end if

                }//end foreach

            }//end if

            DB::commit();
            return response()
                ->json(
                    [
                        'message'       =>  'Discounts are successfully updated.'
                    ],
                    200
                );

        }//end try
        catch(Exception $e){

            DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  $e->getMessage()
                    ],
                    500
                );

        }//end catch
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
