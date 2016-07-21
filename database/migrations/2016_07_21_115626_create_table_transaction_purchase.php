<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactionPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTransactionPurchase', function(Blueprint $table){

            $table->increments('intTransactionPurchaseId');
            $table->integer('intCustomerIdFK')
                ->unsigned();
            $table->integer('intPaymentType');
            $table->decimal('deciAmountPaid');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intCustomerIdFK')
                ->references('intCustomerId')
                ->on('tblCustomer');

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
