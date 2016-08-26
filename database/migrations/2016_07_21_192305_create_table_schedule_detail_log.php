<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScheduleDetailLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblSDLog', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intSDLogId');
            $table->integer('intSDIdFK')
                ->unsigned();
            $table->integer('intScheduleStatus');
            $table->timestamps();

            $table->foreign('intSDIdFK')
                ->references('intScheduleDetailId')
                ->on('tblScheduleDetail');

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
