<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Floor;
use App\Building;
use App\ApiModel\v2\RoomType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
   public function getAllFloors($id){

       $floorList   =   Floor::where('intBuildingIdFK', '=', $id)
                            ->get();

       return response()
           ->json(
               [
                   'floorList'          =>      $floorList,
                   'code'               =>      200
               ],
               200
           );

   }

    public function getAllFloorsWithRooms($id){

        $floorList      =   Floor::join('tblRoom', 'tblRoom.intFloorIdFK', '=', 'tblFloor.intFloorId')
                                ->where('tblFloor.intBuildingIdFK', '=', $id)
                                ->groupBy('tblFloor.intFloorId')
                                ->get(['tblFloor.intFloorId', 'tblFloor.intFloorNo']);

        return response()
            ->json(
                [
                    'floorList'     =>          $floorList
                ],
                200
            );

    }

    public function getAllFloorsWithBlocks($id){

        $floorList  =   Floor::join('tblRoom', 'tblRoom.intFloorIdFK', '=', 'tblFloor.intFloorId')
                            ->join('tblBlock', 'tblBlock.intRoomIdFK', '=', 'tblRoom.intRoomId')
                            ->where('tblFloor.intBuildingIdFK', '=', $id)
                            ->groupBy('tblFloor.intFloorId')
                            ->get([
                                'tblFloor.intFloorId',
                                'tblFloor.intFloorNo'
                            ]);

        foreach($floorList as $floor){

            $floor->unit_type   =   RoomType::join('tblBlock', 'tblBlock.intUnitTypeIdFK', '=', 'tblRoomType.intRoomTypeId')
                                        ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
                                        ->where('tblRoom.intFloorIdFK', '=', $floor->intFloorId)
                                        ->groupBy('tblRoomType.intRoomTypeId')
                                        ->get([
                                            'tblRoomType.intRoomTypeId',
                                            'tblRoomType.strRoomTypeName',
                                            'tblRoomType.strUnitTypeName'
                                        ]);

        }

        return response()
            ->json(
                [
                    'floorList'         =>  $floorList
                ],
                200
            );

    }

    public function activateAll(){

        $buildingList     =   Building::onlyTrashed()
          ->restore();

        $buildingList     = Building::all();

        return response()
          ->json(
              [
                'message'       =>  'All buildings are activated.',
                'buildingList'  =>  $buildingList
              ],
              201
            );

    }

    public function deactivateAll(){

      $buildingList     =   Building::all();

      foreach ($buildingList as $building) {
        $building->delete();
      }

      return response()
        ->json(
            [
              'message'         =>  'All buildings are deactivated.',
              'buildingList'    =>  $buildingList
            ],
            201
          );

    }

}
