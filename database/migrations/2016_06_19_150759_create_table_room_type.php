<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoomType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblRoomType', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intRoomTypeId');
            $table->string('strRoomTypeName');
            $table->boolean('boolUnit');
            $table->timestamps();

            $table->unique('strRoomTypeName');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
