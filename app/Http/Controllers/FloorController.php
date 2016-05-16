<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

use DB;
use App\FloorDetail;
use App\Floor;
use App\Block;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FloorController extends Controller
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
        $floor = Floor::select('intFloorId', 'intFloorNo')
                    ->where('intFloorId', '=', $id)
                    ->first();
        $floor->details = $floor->floorDetails()
                            ->select('intFloorTypeIdFK')
                            ->get();
        return response()->json($floor);
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
            $floorDetailList = FloorDetail::select('intFloorTypeIdFK')
                                ->where('intFloorIdFK', '=', $id)
                                ->get();
            //add floorType to floor
            foreach ($request->floorTypeList as $floorType) {
                $boolNotExist = true;
                foreach ($floorDetailList as $floorDetail) {
                    if ($floorDetail->intFloorTypeIdFK == $floorType){
                        $boolNotExist = false;
                    }
                }
                if ($boolNotExist){
                    $floorDetail = FloorDetail::onlyTrashed()
                                    ->where('intFloorIdFK', '=', $id)
                                    ->where('intFloorTypeIdFK', '=', $floorType)
                                    ->first();
                    if ($floorDetail == null){
                        $floorDetail = new FloorDetail();
                        $floorDetail->intFloorIdFK = $id;
                        $floorDetail->intFloorTypeIdFK = $floorType;
                        $floorDetail->save();
                    }else{
                        $floorDetail->restore();
                    }
                }
            }

            //remove floorType from floor
            foreach ($floorDetailList as $floorDetail) {
                $boolNotExist = true;
                foreach ($request->floorTypeList as $floorType) {
                    if ($floorDetail->intFloorTypeIdFK == $floorType){
                        $boolNotExist = false;
                    }
                }
                if ($boolNotExist){
                    $floorTypeToRemove = FloorDetail::where('intFloorIdFK', '=', $id)
                                            ->where('intFloorTypeIdFK', '=', $floorDetail->intFloorTypeIdFK)
                                            ->first();
                    $floorTypeToRemove->delete();
                }
            }

            \DB::commit();
            return response()->json('success');
        }catch(QueryException $e){
            \DB::rollback();
            return response()->json('error');
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

    public function showWithUnitType($id){
        $floor = Floor::select('tblFloor.intFloorId', 'tblFloorType.strFloorTypeName', 'tblFloorType.intFloorTypeId')
                    ->join('tblFloorDetail', 'tblFloorDetail.intFloorIdFK', '=', 'tblFloor.intFloorId')
                    ->join('tblFloorType', 'tblFloorType.intFloorTypeId', '=', 'tblFloorDetail.intFloorTypeIdFK')
                    ->where('tblFloorType.boolUnit', '=', '1')
                    ->where('tblFloor.intFloorId', '=', $id)
                    ->get();
        return response()->json($floor);
    }

    public function showBlocks($id){
        $blockList = Block::select('intBlockId', 'strBlockName', 'intUnitType')
                        ->where('intFloorIdFK', '=', $id)
                        ->get();
        return response()->json($blockList);
    }
}
