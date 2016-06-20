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
}
