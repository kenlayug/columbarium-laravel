<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuilding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblBuilding', function(Blueprint $table){
            $table->increments('intBuildingId');
            $table->string('strBuildingName', 50);
            $table->text('strBuildingLocation');
            $table->string('strBuildingCode', 5);
            $table->timestamps();
            $table->softDeletes();

            $table->unique('strBuildingName');
            $table->unique('strBuildingCode');
        });

        Schema::create('tblFloor', function(Blueprint $table){
            $table->increments('intFloorId');
            $table->integer('intFloorNo');
            $table->integer('intBuildingIdFK')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intBuildingIdFK')
                ->references('intBuildingId')
                ->on('tblBuilding');
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
