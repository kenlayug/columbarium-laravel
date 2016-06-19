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
            $table->integer('intRoomTypeIdFK')
                ->unsigned()
                ->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intFloorIdFK')
                ->references('intFloorId')
                ->on('tblFloor');

            $table->foreign('intRoomTypeIdFK')
                ->references('intFloorTypeId')
                ->on('tblFloorType');

            $table->unique(['intFloorIdFK', 'intRoomNo']);

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
