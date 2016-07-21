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
            
            $table->increments('intSchedServiceId');
            $table->integer('intSCatIdFK')
                ->unsigned();
            $table->integer('intScheduleTimeIdFK')
                ->unsigned();
            $table->timestamps();
            
            $table->foreign('intSCatIdFK')
                ->references('intServiceCategoryId')
                ->on('tblServiceCategory');

            $table->foreign('intScheduleTimeIdFK')
                ->references('intScheduleTimeId')
                ->on('tblScheduleTime');

            $table->unique(['intSCatIdFK', 'intScheduleTimeIdFK']);
            
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
