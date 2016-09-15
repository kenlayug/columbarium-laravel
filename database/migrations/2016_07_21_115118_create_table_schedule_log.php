<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScheduleLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblScheduleLog', function(Blueprint $table){

            $table->engine          =   "InnoDB";

            $table->increments('intScheduleLogId');
            $table->integer('intScheduleLogNo');
            $table->integer('intServiceCategoryIdFK')
                ->unsigned();
            $table->integer('intRoomIdFK')
                ->unsigned()
                ->nullable();
            $table->timestamps();

            $table->foreign('intServiceCategoryIdFK')
                ->references('intServiceCategoryId')
                ->on('tblServiceCategory');

            $table->foreign('intRoomIdFK')
                ->references('intRoomId')
                ->on('tblRoom');

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
