<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDownpaymentDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDownpaymentDiscount', function(Blueprint $table){

            $table->engine          =   'InnoDB';
            $table->increments('intDownpaymentDiscountId');
            $table->integer('intDownpaymentIdFK')
                ->unsigned();
            $table->integer('intDiscountRateIdFK')
                ->unsigned();
            $table->timestamps();

            $table->foreign('intDownpaymentIdFK')
                ->references('intDownpaymentId')
                ->on('tblDownpayment');

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
