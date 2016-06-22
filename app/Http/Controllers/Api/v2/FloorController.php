<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Floor;
use App\ApiModel\v2\Room;
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
                            ->where('tblRoomType.strRoomTypeName', 'LIKE', 'Unit Type')
                            ->get(['tblRoom.intRoomId', 'tblRoom.intFloorIdFK', 'tblRoom.intRoomNo']);

        return response()
            ->json(
                [
                    'roomList'          =>          $roomList
                ],
                200
            );

    }
}
