<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactionUnitDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTransactionUnitDiscount', function(Blueprint $table){

            $table->increments('intTransactionUnitDiscountId');
            $table->integer('intTransactionUnitIdFK')
                ->unsigned();
            $table->integer('intDiscountRateIdFK')
                ->unsigned();
            $table->timestamps();

            $table->foreign('intTransactionUnitIdFK')
                ->references('intTransactionUnitId')
                ->on('tblTransactionUnit');

            $table->foreign('intDiscountRateIdFK')
                ->references('intDiscountRateId')
                ->on('tblDiscountRate');

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
