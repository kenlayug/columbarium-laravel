<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnitTypeStorage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblUnitTypeStorage', function(Blueprint $table){

            $table->increments('intUnitTypeStorageId');
            $table->integer('intUnitTypeIdFK')
                ->unsigned();
            $table->integer('intStorageTypeIdFK')
                ->unsigned();
            $table->integer('intQuantity');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intUnitTypeIdFK')
                ->references('intRoomTypeId')
                ->on('tblRoomType');

            $table->foreign('intStorageTypeIdFK')
                ->references('intStorageTypeId')
                ->on('tblStorageType');

            $table->unique(['intUnitTypeIdFK', 'intStorageTypeIdFK']);

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
