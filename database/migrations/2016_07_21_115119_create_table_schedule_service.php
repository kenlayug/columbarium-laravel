<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScheduleService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblSchedService', function(Blueprint $table){
            
            $table->engine      =   'InnoDB';
            $table->increments('intSchedServiceId');
            $table->integer('intSLogIdFK')
                ->unsigned();
            $table->integer('intScheduleTimeIdFK')
                ->unsigned();
            $table->timestamps();
            
            $table->foreign('intSLogIdFK')
                ->references('intScheduleLogId')
                ->on('tblScheduleLog');

            $table->foreign('intScheduleTimeIdFK')
                ->references('intScheduleTimeId')
                ->on('tblScheduleTime');

            $table->unique(['intSLogIdFK', 'intScheduleTimeIdFK']);
            
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
