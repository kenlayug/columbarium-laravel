<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblRoom', function(Blueprint $table){

            $table->increments('intRoomId');
            $table->integer('intRoomNo');
            $table->integer('intFloorIdFK')
                ->unsigned();
            $table->integer('intMaxBlock');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intFloorIdFK')
                ->references('intFloorId')
                ->on('tblFloor');

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
