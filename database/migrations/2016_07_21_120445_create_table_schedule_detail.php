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

            $table->engine      =   'InnoDB';
            $table->increments('intScheduleDetailId');
            $table->integer('intSchedServiceIdFK')
                ->unsigned();
            $table->integer('intScheduleDayIdFK')
                ->unsigned();
            $table->integer('intTPDetailIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intCollectionIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intDeceasedIdFK')
                ->unsigned();
            $table->text('strRemarks');
            $table->integer('intMinuteDelayCaused');
            $table->timestamps();

            $table->foreign('intSchedServiceIdFK')
                ->references('intSchedServiceId')
                ->on('tblSchedService');

            $table->foreign('intScheduleDayIdFK')
                ->references('intScheduleDayId')
                ->on('tblScheduleDay');

            $table->foreign('intTPDetailIdFK')
                ->references('intTPurchaseDetailId')
                ->on('tblTPurchaseDetail');

            $table->foreign('intDeceasedIdFK')
                ->references('intDeceasedId')
                ->on('tblDeceased');

            $table->foreign('intCollectionIdFK')
                ->references('intCollectionId')
                ->on('tblCollection');

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
