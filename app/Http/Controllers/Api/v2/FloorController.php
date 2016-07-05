<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Floor;
use App\ApiModel\v2\Room;
use App\ApiModel\v2\UnitCategory;
use App\UnitCategoryPrice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FloorController extends Controller
{
    public function getAllRooms($id){

        $roomList   =   Room::where('intFloorIdFK', '=', $id)
                            ->get();

        return response()
            ->json(
                [
                    'roomList'     =>  $roomList
                ],
                200
            );

    }

    public function getAllRoomsWithUnitType($id){

        $roomList   =   Room::join('tblRoomDetail', 'tblRoomDetail.intRoomIdFK', '=', 'tblRoom.intRoomId')
                            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblRoomDetail.intRoomTypeIdFK')
                            ->where('tblRoom.intFloorIdFK', '=', $id)
                            ->where('tblRoomType.boolUnit', '=', true)
                            ->groupBy('tblRoom.intRoomId')
                            ->get(['tblRoom.intRoomId', 'tblRoom.intFloorIdFK', 'tblRoom.strRoomName']);

        return response()
            ->json(
                [
                    'roomList'          =>          $roomList
                ],
                200
            );

    }

    public function getAllUnitCategories($id){

        $unitCategoryList   =   UnitCategory::join('tblFloor', 'tblFloor.intFloorId', '=', 'tblUnitCategory.intFloorIdFK')
                                    ->where('tblUnitCategory.intFloorIdFK', '=', $id)
                                    ->get([
                                        'tblUnitCategory.intUnitCategoryId',
                                        'tblUnitCategory.intLevelNo',
                                        'tblFloor.intFloorNo'
                                    ]);

        return response()
            ->json(
                [
                    'unitCategoryList'      =>      $unitCategoryList
                ],
                200
            );

    }

    public function getAllRoomsWithBlocks($id){

        $roomList   =   Room::join('tblBlock', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
                            ->where('tblRoom.intFloorIdFK', '=', $id)
                            ->groupBy('tblRoom.intRoomId')
                            ->get([
                                'tblRoom.intRoomId',
                                'tblRoom.intRoomNo'
                            ]);

        return response()
            ->json(
                [
                    'roomList'      =>  $roomList
                ],
                200
            );

    }

    public function getAllUnitCategoriesWithUnitType($floorId, $unitTypeId){

        $unitCategories         =   UnitCategory::where('intFloorIdFK', '=', $floorId)
                                        ->where('intUnitTypeIdFK', '=', $unitTypeId)
                                        ->groupBy('intUnitCategoryId')
                                        ->get([
                                            'intUnitCategoryId',
                                            'intUnitTypeIdFK',
                                            'intLevelNo'
                                        ]);

        foreach ($unitCategories as $unitCategory){

            $unitCategory->price    =   UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $unitCategory->intUnitCategoryId)
                                            ->orderBy('created_at', 'desc')
                                            ->first([
                                                'deciPrice'
                                            ]);

        }

        return response()
            ->json(
                [
                    'unitCategoryList'    =>  $unitCategories
                ],
                200
            );

    }

}
