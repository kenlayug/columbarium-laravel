<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Floor;
use App\ApiModel\v2\Room;
use App\ApiModel\v2\UnitCategory;
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

        $unitCategories         =   UnitCategory::leftJoin('tblUnitCategoryPrice',
                                                            'tblUnitCategoryPrice.intUnitCategoryIdFK',
                                                            '=',
                                                            'tblUnitCategory.intUnitCategoryId')
                                        ->where('intFloorIdFK', '=', $floorId)
                                        ->where('intUnitType', '=', $unitTypeId)
                                        ->groupBy('intUnitCategoryId')
                                        ->get([
                                            'intUnitCategoryId',
                                            'intUnitType',
                                            'intLevelNo',
                                            'tblUnitCategoryPrice.deciPrice'
                                        ]);

        return response()
            ->json(
                [
                    'unitCategoryList'    =>  $unitCategories
                ],
                200
            );

    }

}
