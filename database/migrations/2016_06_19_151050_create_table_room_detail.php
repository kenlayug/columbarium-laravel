<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoomDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblRoomDetail', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intRoomDetailId');
            $table->integer('intRoomIdFK')
                ->unsigned();
            $table->integer('intRoomTypeIdFK')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intRoomIdFK')
                ->references('intRoomId')
                ->on('tblRoom');

            $table->foreign('intRoomTypeIdFK')
                ->references('intRoomTypeId')
                ->on('tblRoomType');

            $table->unique(['intRoomIdFK', 'intRoomTypeIdFK']);

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
