<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScheduleDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblScheduleDetail', function(Blueprint $table){

            $table->increments('intScheduleDetailId');
            $table->integer('intSchedServiceIdFK')
                ->unsigned();
            $table->integer('intScheduleDayIdFK')
                ->unsigned();
            $table->integer('intTPDetailIdFK')
                ->unsigned();
            $table->text('strRemarks');
            $table->integer('intMinuteDelayCaused');

            $table->foreign('intSchedServiceIdFK')
                ->references('intSchedServiceId')
                ->on('tblSchedService');

            $table->foreign('intScheduleDayIdFK')
                ->references('intScheduleDayId')
                ->on('tblScheduleDay');

            $table->foreign('intTPDetailIdFK')
                ->references('intTPurchaseDetailId')
                ->on('tblTPurchaseDetail');

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
