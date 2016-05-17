<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Database\QueryException;
use App\Block;
use App\UnitCategory;
use App\Unit;
use App\UnitCategoryPrice;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blockList = Block::select('tblBlock.intBlockId', 'tblBlock.strBlockName', 'tblBuilding.strBuildingName', 'tblFloor.intFloorNo', 'tblBlock.intUnitType', 'tblBuilding.strBuildingCode')
                        ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblBlock.intFloorIdFK')
                        ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
                        ->get();
        return response()->json($blockList);
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
            $block = new Block();
            $block->strBlockName = $request->strBlockName;
            $block->intFloorIdFK = $request->intFloorId;
            $block->intUnitType = $request->intUnitType;
            $block->save();
            for($intLevelCtr = 0; $intLevelCtr < $request->intLevelNo; $intLevelCtr++){
                $unitCategory = new UnitCategory();
                $unitCategory->intBlockIdFK = $block->intBlockId;
                $unitCategory->intLevelNo = $intLevelCtr+1;
                $unitCategory->save();
                for($intColumnCtr = 0; $intColumnCtr < $request->intColumnNo; $intColumnCtr++){
                    $unit = new Unit();
                    $unit->intBlockIdFK = $block->intBlockId;
                    $unit->intUnitCategoryIdFK = $unitCategory->intUnitCategoryId;
                    $unit->intUnitStatus = 1;
                    $unit->intColumnNo = $intColumnCtr+1;
                    $unit->save();
                }
            }
            \DB::commit();
            return response()->json($block);

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
        $block = Block::select('intBlockId', 'strBlockName')
                    ->where('intBlockId', '=', $id)
                    ->first();
        return response()->json($block);
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
            $block = Block::find($id);
            $block->strBlockName = $request->strBlockName;
            $block->save();
            return response()->json($block);
        }catch(QueryException $e){
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
        $block = Block::find($id);
        $block->delete();
        return response()->json($block);
    }

    public function getDeactivated(){
        $blockList = Block::onlyTrashed()
                        ->select('tblBlock.intBlockId', 'tblBlock.strBlockName', 'tblFloor.intFloorNo', 'tblBlock.intUnitType', 'tblBuilding.strBuildingCode')
                        ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblBlock.intFloorIdFK')
                        ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
                        ->get();
        return response()->json($blockList);
    }

    public function reactivate($id){
        $block = Block::onlyTrashed()
                    ->where('intBlockId', '=', $id)
                    ->first();
        $block->restore();
        return response()->json($block);
    }

    public function getBlockUnits($id){
        $units = Unit::select('intUnitId', 'intUnitStatus', 'intUnitCategoryIdFK')
                    ->where('intBlockIdFK', '=', $id)
                    ->get();

        return response()->json($units);
    }

    public function getBlockUnitCategory($id){
        $unitCategory = UnitCategory::where('intBlockIdFK', '=', $id)
                            ->count();
        return response()->json($unitCategory);
    }

    public function getBlockUnitCategoryDetail($id){
        $unitCategory = UnitCategory::select('intUnitCategoryId', 'intLevelNo', 'intBlockIdFK')
                            ->where('intBlockIdFK', '=', $id)
                            ->get();
        return $unitCategory;
    }

}
