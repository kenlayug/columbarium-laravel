<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Floor;
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

        $floorList      =   Floor::join('tblRoom', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
                                ->join('tblBlock', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
                                ->where('tblFloor.intBuildingIdFK', '=', $id)
                                ->groupBy('tblFloor.intFloorId')
                                ->get([
                                    'tblFloor.intFloorId',
                                    'tblFloor.intFloorNo'
                                ]);

        foreach ($floorList as $floor){

            $floor->unit_type = Floor::join('tblRoom', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
                                    ->join('tblBlock', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
                                    ->where('tblFloor.intFloorId', '=', $floor->intFloorId)
                                    ->groupBy('tblBlock.intUnitType')
                                    ->get([
                                        'tblBlock.intUnitType'
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
}
