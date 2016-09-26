<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Unit;

class UnitController extends Controller
{
    public function getAllUnitStatus(){

        $unitStatus             =   [
            'underMaintenance',
            'available',
            'reserved',
            'owned',
            'atNeed',
            'reserved',
            'partiallyOwned',
            'atNeed'
        ];

        $unitStatusList         =   [
            'underMaintenance'      =>  0,
            'available'             =>  0,
            'reserved'              =>  0,
            'owned'                 =>  0,
            'atNeed'                =>  0,
            'partiallyOwned'        =>  0
        ];

        for($intCtr = 0; $intCtr < 7; $intCtr++){

            $unitStatusList[$unitStatus[$intCtr]]    +=  Unit::where('intUnitStatus', '=', $intCtr)
                ->count();

        }//end for

        return response()
            ->json(
                [
                    'unitStatusList'        =>  $unitStatusList
                ],
                200
            );

    }//end function

    public function countUnit(){

        $unit       =   Unit::count();

        return response()
            ->json(
                [
                    'intUnitCount'      =>  $unit
                ],
                200
            );

    }//end function
}
