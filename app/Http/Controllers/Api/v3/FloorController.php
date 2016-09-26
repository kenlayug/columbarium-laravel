<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Floor;

class FloorController extends Controller
{
    public function getFloorsWithNoRoom(){

        $intFloorCount          =   Floor::leftJoin('tblRoom', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->whereNull('tblRoom.intRoomId')
            ->groupBy('tblFloor.intFloorId')
            ->count();

        return response()
            ->json(
                [
                    'intFloorUnconfigured'      =>  $intFloorCount
                ],
                200
            );

    }//end function
}
