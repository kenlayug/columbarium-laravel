<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblPosition', function(Blueprint $table){

            $table->increments('intPositionId');
            $table->string('strPositionName');
            $table->integer('intUserAuth');
            $table->timestamps();

            $table->unique('strPositionName');

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
