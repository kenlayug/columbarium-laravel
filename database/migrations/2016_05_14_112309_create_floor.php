<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblFloorType', function(Blueprint $table){
            $table->engine      =   'InnoDB';
            $table->increments('intFloorTypeId');
            $table->string('strFloorTypeName', 50);
            $table->integer('boolUnit');
            $table->timestamps();

            $table->unique('strFloorTypeName');
        });

        Schema::create('tblFloorDetail', function(Blueprint $table){
            $table->engine      =   'InnoDB';
            $table->increments('intFloorDetailId');
            $table->integer('intFloorIdFK')
                ->unsigned();
            $table->integer('intFloorTypeIdFK')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['intFloorIdFK', 'intFloorTypeIdFK']);
            $table->foreign('intFloorIdFK')
                ->references('intFloorId')
                ->on('tblFloor');

            $table->foreign('intFloorTypeIdFK')
                ->references('intFloorTypeId')
                ->on('tblFloorType');
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
