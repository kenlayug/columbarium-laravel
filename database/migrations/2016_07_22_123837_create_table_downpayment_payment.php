<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDownpaymentPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDownpaymentPayment', function(Blueprint $table){

            $table->increments('intDownpaymentPaymentId');
            $table->integer('intDownpaymentIdFK')
                ->unsigned();
            $table->decimal('deciAmountPaid');
            $table->integer('intPaymentType');
            $table->timestamps();

            $table->foreign('intDownpaymentIdFK')
                ->references('intDownpaymentId')
                ->on('tblDownpayment');

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
