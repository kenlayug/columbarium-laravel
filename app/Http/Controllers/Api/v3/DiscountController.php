<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v3\Discount;
use App\ApiModel\v3\DiscountRate;

use DB;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(
                [
                    'discountList'      =>  Discount::queryDiscount(null)
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
        try{

            $discount           =   Discount::create([
                'strDiscountName'       =>  $request->strDiscountName
                ]);

            $discountRate       =   DiscountRate::create([
                'intDiscountIdFK'       =>  $discount->intDiscountId,
                'intDiscountType'       =>  $request->intDiscountType,
                'deciDiscountRate'      =>  $request->deciDiscountRate
                ]);

            $discount->discount_rate    =   $discountRate->deciDiscountRate;
            $discount->intDiscountType  =   $discountRate->intDiscountType;

            DB::commit();
            return response()
                ->json(
                    [
                        'message'       =>  'Discount is successfully created.',
                        'discount'      =>  $discount
                    ],
                    201
                );

        }catch(QueryException $e){

            DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  'Discount already exist.'
                    ],
                    500
                );

        }//end catch
        catch(Exception $e){

            DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  $e->getMessage()
                    ],
                    500
                );

        }//end try catch
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()
            ->json(
                [
                    'discount'      =>  Discount::queryDiscount($id)
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

            $discount       =   Discount::find($id);

            $discount->strDiscountName      =   $request->strDiscountName;
            $discount->save();

            $discountRate       =   DiscountRate::where('intDiscountIdFK', '=', $id)
                ->orderBy('created_at', 'desc')
                ->first();
            if ($discountRate->deciDiscountRate != $request->deciDiscountRate || $discountRate->intDiscountType != $request->intDiscountType){

                $discountRate       =   DiscountRate::create([
                    'intDiscountIdFK'       =>  $discount->intDiscountId,
                    'intDiscountType'       =>  $request->intDiscountType,
                    'deciDiscountRate'      =>  $request->deciDiscountRate
                    ]);

            }//end foreach

            $discount->discount_rate        =   $discountRate->deciDiscountRate;
            $discount->intDiscountType      =   $discountRate->intDiscountType;
            DB::commit();

            return response()
                ->json(
                    [
                        'message'           =>  'Discount is successfully updated.',
                        'discount'          =>  $discount
                    ],
                    201
                );

        }//end try
        catch(QueryException $e){

            DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  'Discount already exists.'
                    ],
                    500
                );

        }//end catch
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount       =   Discount::find($id);

        $discount->delete();

        return response()
            ->json(
                [
                    'message'       =>  'Discount is succesfully deactivated.',
                    'discount'      =>  $discount
                ],
                201
            );
    }

    public function archive(){

        return response()
            ->json(
                [
                    'discountList'      =>  Discount::select(
                        'intDiscountId',
                        'strDiscountName'
                        )
                        ->onlyTrashed()
                        ->get()
                ],
                200
            );

    }//end function

    public function reactivate($id){

        $discount       =   Discount::onlyTrashed()
            ->where('intDiscountId', '=', $id)
            ->first();

        $discount->restore();

        return response()
            ->json(
                [
                    'message'       =>  'Discount is successfully reactivated.',
                    'discount'      =>  Discount::queryDiscount($id)
                ],
                201
            );

    }//end function
}
