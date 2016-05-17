<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\UnitCategory;
use App\UnitCategoryPrice;

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
        $unitCategory = UnitCategory::find($id);
        $unitCategory->price = $unitCategory->unitCategoryPrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
        return response()->json($unitCategory);
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
        $unitCategory = UnitCategory::find($id);
        $unitCategory->price = $unitCategory->unitCategoryPrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
        if ($unitCategory->price == null){
            $deciPrice = 0;
        }else{
            $deciPrice = $unitCategory->price->deciPrice;
        }
        if($deciPrice != $request->deciPrice){
            $unitCategoryPrice = new UnitCategoryPrice();
            $unitCategoryPrice->intUnitCategoryIdFK = $unitCategory->intUnitCategoryId;
            $unitCategoryPrice->deciPrice = $request->deciPrice;
            $unitCategoryPrice->save();
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
