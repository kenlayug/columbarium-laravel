<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScheduleDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblScheduleDay', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intScheduleDayId');
            $table->date('dateSchedule');
            $table->timestamps();

            $table->unique('dateSchedule');

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
