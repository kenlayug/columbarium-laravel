<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Database\QueryException;

use DB;

use App\Additional;
use App\AdditionalPrice;
use App\AdditionalCategory;

class AdditionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additionalList = Additional::select('intAdditionalId', 'strAdditionalName', 'strAdditionalDesc', 'intAdditionalCategoryIdFK')
                            ->get();
        foreach ($additionalList as $additional) {
            $additional->price = $additional->additionalPrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
            $additional->category = AdditionalCategory::select('strAdditionalCategoryName')
                                        ->where('intAdditionalCategoryId', '=', $additional->intAdditionalCategoryIdFK)
                                        ->first();
        }
        return response()->json($additionalList);
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
            $additional = new Additional();
            $additional->strAdditionalName = $request->strAdditionalName;
            $additional->strAdditionalDesc = $request->strAdditionalDesc;
            $additional->intAdditionalCategoryIdFK = $request->intAdditionalCategoryId;
            $additional->save();

            $additionalPrice = new AdditionalPrice();
            $additionalPrice->intAdditionalIdFK = $additional->intAdditionalId;
            $additionalPrice->deciPrice = $request->deciPrice;
            $additionalPrice->save();
            \DB::commit();

            $additional->price = $additional->additionalPrices()
                                    ->select('deciPrice')
                                    ->orderBy('created_at', 'desc')
                                    ->first();
            $additional->category = AdditionalCategory::select('strAdditionalCategoryName')
                                        ->where('intAdditionalCategoryId', '=', $additional->intAdditionalCategoryIdFK)
                                        ->first();;
            return response()->json($additional);
        }catch(QueryException $e){
            \DB::rollback();
            return response()->json('error-existing');
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
        $additional = Additional::find($id);
        $additional->price = $additional->additionalPrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
        return response()->json($additional);
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
            \DB::beginTransaction();
            $additional = Additional::find($id);
            $additional->strAdditionalName = $request->strAdditionalName;
            $additional->strAdditionalDesc = $request->strAdditionalDesc;
            $additional->save();

            $additional->price = $additional->additionalPrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();

            if ($additional->price->deciPrice != $request->deciPrice){
                $additionalPrice = new AdditionalPrice();
                $additionalPrice->intAdditionalIdFK = $additional->intAdditionalId;
                $additionalPrice->deciPrice = $request->deciPrice;
                $additionalPrice->save();
                $additional->price  =   $additionalPrice;
            }
            $additional->additionalCategory;
            \DB::commit();
            return response()->json($additional);
        }catch(QueryException $e){
            \DB::rollback();
            return response()->json('error-existing');
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
        $additional = Additional::find($id);
        $additional->delete();
        return response()->json($additional);
    }

    public function getDeactivated(){

        $additionalList = Additional::onlyTrashed()
                            ->select('strAdditionalName', 'intAdditionalId')
                            ->get();
        return response()->json($additionalList);

    }

    public function reactivate($id){

        $additional = Additional::onlyTrashed()
                        ->where('intAdditionalId', '=', $id)
                        ->first();
        $additional->restore();
        $additional->price = $additional->additionalPrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
        $additional->additionalCategory;
        return response()->json($additional);

    }
        
}
