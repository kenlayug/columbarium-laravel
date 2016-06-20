<?php

use Illuminate\Database\Seeder;

class RoomTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tblRoomType')
            ->insert([
                'strRoomTypeName' => 'Unit Type',
                'boolUnit' => true
            ]);
    }
}
