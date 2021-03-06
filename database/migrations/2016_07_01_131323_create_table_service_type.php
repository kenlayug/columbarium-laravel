<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServiceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblServiceCategory', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intServiceCategoryId');
            $table->string('strServiceCategoryName');
            $table->integer('intServiceType');
            $table->integer('intServiceSchedulePerDay');
            $table->integer('intServiceDayInterval');
            $table->timestamps();

            $table->unique('strServiceCategoryName');

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
