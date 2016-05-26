<?php

use Illuminate\Database\Seeder;

use App\FloorType;

class FloorTypeCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tblFloorType')
        	->insert([
        		'strFloorTypeName' => 'Columbary Vault',
        		'boolUnit' => 1
        		]);

        \DB::table('tblFloorType')
        	->insert([
        		'strFloorTypeName' => 'Full Body Crypts',
        		'boolUnit' => 1
        		]);
    }
}
