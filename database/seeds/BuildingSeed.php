<?php

use Illuminate\Database\Seeder;

class BuildingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tblBuilding')
        	->insert([
        		'strBuildingName' => 'Building A',
        		'strBuildingCode' => 'BA',
        		'strBuildingLocation' => 'North Blue',
        		'created_at' => \DB::raw('now()')
        		]);
       	$result = \DB::table('tblBuilding')
       		->select('intBuildingId')
       		->where('strBuildingName', 'LIKE', 'Building A')
       		->first();
        \DB::table('tblFloor')
        	->insert([
        		'intBuildingIdFK' => $result->intBuildingId,
        		'intFloorNo' => 1,
        		'created_at' => \DB::raw('now()')
        		]);
        \DB::table('tblFloor')
        	->insert([
        		'intBuildingIdFK' => $result->intBuildingId,
        		'intFloorNo' => 2,
        		'created_at' => \DB::raw('now()')
        		]);
        \DB::table('tblFloor')
        	->insert([
        		'intBuildingIdFK' => $result->intBuildingId,
        		'intFloorNo' => 3,
        		'created_at' => \DB::raw('now()')
        		]);
        
    }
}
