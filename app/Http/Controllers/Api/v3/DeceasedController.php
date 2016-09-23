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
            ->leftJoin('tblUnit', 'tblUnit.intUnitId', '=', 'tblUnitDeceased.intUnitIdFK')
            ->leftJoin('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
            ->leftJoin('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->leftJoin('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->leftJoin('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->leftJoin('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
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
