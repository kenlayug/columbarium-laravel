<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v2\Deceased;

class DeceasedController extends Controller
{
    public function getAllDeceasedInUnit(){

        $deceasedList       =   Deceased::select(
            'tblDeceased.intDeceasedId',
            'tblDeceased.strFirstName',
            'tblDeceased.strMiddleName',
            'tblDeceased.strLastName',
            'tblUnit.intColumnNo',
            'tblUnitCategory.intLevelNo',
            'tblBlock.intBlockNo',
            'tblRoom.strRoomName',
            'tblFloor.intFloorNo',
            'tblBuilding.strBuildingName'
            )
            ->join('tblUnitDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblUnitDeceased.intUnitIdFK')
            ->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->whereNull('tblUnitDeceased.deleted_at')
            ->get();

        return response()
            ->json(
                [
                    'deceasedList'      =>  $deceasedList
                ],
                200
            );

    }//end function
}
