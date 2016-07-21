<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScheduleTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblScheduleTime', function(Blueprint $table){

            $table->increments('intScheduleTimeId');
            $table->time('timeStart');
            $table->time('timeEnd');
            $table->timestamps();

            $table->unique(['timeStart', 'timeEnd']);

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
