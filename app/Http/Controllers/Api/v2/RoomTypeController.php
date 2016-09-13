<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\RoomType;
use App\ApiModel\v2\UnitTypeStorage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypeList   =   RoomType::all([
            'intRoomTypeId',
            'strRoomTypeName',
            'boolUnit'
        ]);

        return response()
            ->json(
                [
                    'roomTypeList'  =>  $roomTypeList
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
        if ($request->boolUnit == null){
            $request->boolUnit = 0;
        }
        $roomType   =   RoomType::create([
            'strRoomTypeName'       =>  $request->strRoomTypeName,
            'boolUnit'              =>  $request->boolUnit,
            'strUnitTypeName'       =>  $request->strUnitTypeName
        ]);

        return response()
            ->json(
                [
                    'roomType'      =>  $roomType,
                    'message'       =>  'Room type is successfully created.'
                ],
                201
            );
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

    public function getAllRoomTypeWithUnit(){

        $roomTypeList   =   RoomType::where('boolUnit', '=', true)
                                ->get([
                                    'intRoomTypeId',
                                    'strRoomTypeName',
                                    'strUnitTypeName'
                                ]);

        return response()
            ->json(
                [
                    'roomTypeList'  =>  $roomTypeList
                ],
                200
            );

    }

    public function getStorageType($id){

        $storageTypeList    =   UnitTypeStorage::where('intUnitTypeIdFK', '=', $id)
                                    ->get([
                                        'intStorageTypeIdFK',
                                        'intQuantity',
                                        'intUnitTypeIdFK'
                                    ]);

        return response()
            ->json(
                [
                    'storageTypeList'   =>  $storageTypeList
                ],
                200
            );

    }

    public function getStorageTypeWithInfo($id){

        $storageTypeList    =   UnitTypeStorage::join('tblStorageType', 'tblStorageType.intStorageTypeId', '=', 'tblUnitTypeStorage.intStorageTypeIdFK')
                                    ->where('tblUnitTypeStorage.intUnitTypeIdFK', '=', $id)
                                    ->get([
                                        'tblStorageType.strStorageTypeName',
                                        'tblUnitTypeStorage.intQuantity',
                                        'tblStorageType.intStorageTypeId'
                                    ]);

        return response()
            ->json(
                [
                    'storageTypeList'   =>  $storageTypeList
                ],
                200
            );

    }
}
