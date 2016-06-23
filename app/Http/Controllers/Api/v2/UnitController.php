<?php

namespace App\Http\Controllers\Api\v2;

use App\Unit;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UnitController extends Controller
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
        $unit   =   Unit::join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
                        ->leftJoin('tblUnitCategoryPrice', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnitCategoryPrice.intUnitCategoryIdFK')
                        ->where('tblUnit.intUnitId', '=', $id)
                        ->groupBy('tblUnit.intUnitId')
                        ->first([
                            'tblUnit.intUnitId',
                            'tblUnit.intUnitStatus',
                            'tblUnitCategoryPrice.deciPrice',
                            'tblUnit.intUnitCategoryIdFK'
                        ]);

        return response()
            ->json(
                [
                    'unit'      => $unit
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
        $unit   =   Unit::find($id);

        $unit->intUnitStatus = 1;

        $unit->save();

        return response()
            ->json(
                [
                    'unit'      =>      $unit,
                    'message'   =>      'Unit is successfully activated.'
                ],
                200
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
                    ->where('tblUnit.intUnitId', '=', $id)
                    ->first();

        $unit->intUnitStatus = 0;

        $unit->save();

        return response()
            ->json(
                [
                    'unit'      =>  $unit,
                    'message'   =>  'Unit is successfully deactivated.'
                ],
                200
            );
    }

    public function getUnitInfo($id){

        $unit   =   Unit::join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
                        ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
                        ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
                        ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
                        ->where('tblUnit.intUnitId', '=', $id)
                        ->first([
                            'tblUnit.intUnitId',
                            'tblUnit.intUnitStatus',
                            'tblBlock.strBlockName',
                            'tblRoom.intRoomNo',
                            'tblFloor.intFloorNo',
                            'tblBuilding.strBuildingName'
                        ]);

        return response()
            ->json(
                [
                    'unit'              =>          $unit
                ],
                200
            );

    }
}
