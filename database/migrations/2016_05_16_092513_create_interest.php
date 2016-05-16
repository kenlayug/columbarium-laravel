<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblInterest', function(Blueprint $table){
            $table->increments('intInterestId');
            $table->integer('intNoOfYear');
            $table->integer('intAtNeed');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['intNoOfYear', 'intAtNeed']);
        });

        Schema::create('tblInterestRate', function(Blueprint $table){
            $table->increments('intInterestRateId');
            $table->integer('intInterestIdFK')
                ->unsigned();
            $table->decimal('deciInterestRate', 5, 2);
            $table->timestamps();

            $table->foreign('intInterestIdFK')
                ->references('intInterestId')
                ->on('tblInterest');
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
