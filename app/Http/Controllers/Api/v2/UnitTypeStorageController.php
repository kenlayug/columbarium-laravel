<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\UnitTypeStorage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UnitTypeStorageController extends Controller
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

            \DB::beginTransaction();

            foreach($request->storageTypeList as $storageType){

                $unitStorageType    =   UnitTypeStorage::where('intStorageTypeIdFK', '=', $storageType['intStorageTypeId'])
                                            ->where('intUnitTypeIdFK', '=', $id)
                                            ->first();

                if ($unitStorageType == null){

                    $unitStorageType    =   UnitTypeStorage::onlyTrashed()
                                                ->where('intStorageTypeIdFK', '=', $storageType['intStorageTypeId'])
                                                ->where('intUnitTypeIdFK', '=', $id)
                                                ->first();

                    if ($unitStorageType == null) {

                        $unitStorageType = UnitTypeStorage::create([
                            'intStorageTypeIdFK' => $storageType['intStorageTypeId'],
                            'intUnitTypeIdFK' => $id,
                            'intQuantity' => $storageType['intQuantity']
                        ]);

                    }else{

                        $unitStorageType->restore();
                        $unitStorageType->intQuantity   =   $storageType['intQuantity'];
                        $unitStorageType->save();

                    }

                }else{

                    $unitStorageType->intQuantity   =   $storageType['intQuantity'];
                    $unitStorageType->save();

                }

            }

            $savedUnitStorageList   =   UnitTypeStorage::where('intUnitTypeIdFK', '=', $id)
                                            ->get();

            foreach ($savedUnitStorageList as $savedUnitStorage){

                $boolNotExist  =   true;

                foreach($request->storageTypeList as $storageType){

                    if ($savedUnitStorage->intStorageTypeIdFK == $storageType['intStorageTypeId']){

                        $boolNotExist   =   false;

                    }

                }

                if ($boolNotExist){

                    $savedUnitStorage->delete();

                }

            }

            \DB::commit();
            return response()
                ->json(
                    [
                        'message'       =>  'Storage Types are successfully updated.'
                    ],
                    201
                );

        }catch(\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'   =>  'Oops.',
                        'error'     =>  $e->getMessage()
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
