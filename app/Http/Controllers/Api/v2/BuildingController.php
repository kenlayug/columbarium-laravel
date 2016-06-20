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
                   'floorList'          =>      $floorList
               ],
               200
           );

   }
}
