<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\UnitCategory;
use App\UnitCategoryPrice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UnitCategoryController extends Controller
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
        $unitCategoryPrice   =   UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $id)
                                ->orderBy('created_at', 'desc')
                                ->first();

        return response()
            ->json(
                [
                    'unitCategoryPrice'      =>  $unitCategoryPrice
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

            \DB::beginTransaction():
            foreach($request->unitCategoryPriceList as $unitCategoryPrice){

                $unitCategoryPrice  =   UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $id)
                                        ->orderBy('created_at', 'desc')
                                        ->first([
                                            'deciPrice'
                                        ]);

                 if ($unitCategoryPrice == null || $unitCategoryPrice->deciPrice   !=  $request->deciPrice){

                    $unitCategoryPrice = UnitCategoryPrice::create([
                        'intUnitCategoryIdFK'       =>  $id,
                        'deciPrice'                 =>  $request->deciPrice
                    ]);

                }


            }

            DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>  'Unit price is successfully updated.'
                    ],
                    201
                );

        }catch(Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                        [
                            'message'   =>  $e->getMessage()
                        ],
                        500
                    );

        }
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
