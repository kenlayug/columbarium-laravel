<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnitService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblUnitService', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intUnitServiceId');
            $table->integer('intUnitTypeIdFK')
                ->unsigned();
            $table->integer('intServiceTypeId');
            $table->integer('intServiceIdFK')
                ->unsigned();
            $table->timestamps();

            $table->foreign('intUnitTypeIdFK')
                ->references('intRoomTypeId')
                ->on('tblRoomType');

            $table->foreign('intServiceIdFK')
                ->references('intServiceId')
                ->on('tblService');

            $table->unique(['intUnitTypeIdFK', 'intServiceTypeId']);

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
