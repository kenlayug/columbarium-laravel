<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Building;
use App\Floor;
use App\FloorDetail;
use DB;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildingList = Building::select('intBuildingId', 'strBuildingName', 'strBuildingCode', 'strBuildingLocation')
                            ->get();
        foreach ($buildingList as $building) {
            $building->floor_no = $building->floors()->count();
        }
        return response()->json($buildingList);
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
            $building = new Building();
            $building->strBuildingName = $request->strBuildingName;
            $building->strBuildingLocation = $request->strBuildingLocation;
            $building->strBuildingCode = $request->strBuildingCode;
            $building->save();
            for($intCtr = 0; $intCtr < $request->intFloorNo; $intCtr++){
                $floor = new Floor();
                $floor->intFloorNo = $intCtr+1;
                $floor->intBuildingIdFK = $building->intBuildingId;
                $floor->save();
            }
            \DB::commit();
            $building->floor_no = $building->floors()->count();
            return response()->json($building);

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
        $building = Building::select('intBuildingId', 'strBuildingName', 'strBuildingCode', 'strBuildingLocation')
                        ->where('intBuildingId', '=', $id)
                        ->first();
        $building->floor_no = $building->floors()->count();
        return response()->json($building);
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

            $building = Building::select('strBuildingName', 'intBuildingId', 'strBuildingLocation', 'strBuildingCode')
                            ->where('intBuildingId', '=', $id)
                            ->first();
            \DB::beginTransaction();
            $building->strBuildingName = $request->strBuildingName;
            $building->strBuildingCode = $request->strBuildingCode;
            $building->strBuildingLocation = $request->strBuildingLocation;
            $building->save();
            \DB::commit();
            $building->floor_no = $building->floors()->count();
            return response()->json($building);

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
        $building = Building::find($id);
        $building->delete();
        return response()->json($building);
    }

    public function getDeactivated(){
        $buildingList = Building::onlyTrashed()
                            ->select('intBuildingId', 'strBuildingName')
                            ->get();
        return response()->json($buildingList);
    }

    public function reactivate($id){
        $building = Building::onlyTrashed()
                        ->select('intBuildingId', 'strBuildingName', 'strBuildingCode', 'strBuildingLocation')
                        ->where('intBuildingId', '=', $id)
                        ->first();
        $building->restore();
        $building->floor_no = $building->floors()->count();
        return response()->json($building);
    }

    public function getAllBuildingFloor(){
        $buildingList = Building::select('intBuildingId', 'strBuildingName')
                            ->get();
        foreach ($buildingList as $building) {
            $building->floors = $building->floors()
                                    ->select('intFloorId', 'intFloorNo')
                                    ->get();
            $floorStatus = [];
            foreach ($building->floors as $floor) {
                $isConfigured = FloorDetail::where('intFloorIdFK', '=', $floor->intFloorId)
                                    ->count();
                if ($isConfigured == 0){
                    array_push($floorStatus, false);
                }else{
                    array_push($floorStatus, true);
                }
            }
            $building->floors_status = $floorStatus;
        }
        return response()->json($buildingList);
    }

}
