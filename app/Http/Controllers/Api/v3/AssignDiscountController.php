<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v3\AssignDiscount;

use DB;

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

            DB::beginTransaction();
            foreach($request->discountList as $discount){

                $assignDiscount             =   AssignDiscount::where('intDiscountIdFK', '=', $discount)
                    ->where('intTransactionId', '=', $request->intTransactionId)
                    ->first();

                if (!$assignDiscount){

                    $assignDiscount             =   AssignDiscount::create([
                        'intServiceIdFK'        =>  $request->intServiceId,
                        'intTransactionId'      =>  $request->intTransactionId,
                        'intDiscountIdFK'       =>  $discount
                        ]);

                }//end if

            }//end foreach

            $assignDiscountList             =   null;
            if ($request->intServiceId){

                $assignDiscountList         =   AssignDiscount::where('intServiceIdFK', '=', $request->intServiceId);

            }//end if
            else{

                $assignDiscountList         =   AssignDiscount::where('intTransactionId', '=', $request->intTransactionId);

            }//end else
            $assignDiscountList            =   $assignDiscountList->get();

            if ($assignDiscountList){

                foreach($assignDiscountList as $assignDiscount){

                    $boolExist          =   false;
                    foreach($request->discountList as $discount){

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
        $assignDiscountList             =   AssignDiscount::where('intTransactionId', '=', $id)
            ->get();
        return response()
            ->json(
                [
                    'assignDiscountList'        =>  $assignDiscountList
                ],
                200
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assignDiscountList             =   AssignDiscount::where('intServiceIdFK', '=', $id)
            ->get();
        return response()
            ->json(
                [
                    'assignDiscountList'        =>  $assignDiscountList
                ],
                200
            );
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
