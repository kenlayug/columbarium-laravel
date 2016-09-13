<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactionUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTransactionUnit', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intTransactionUnitId');
            $table->integer('intCustomerIdFK')
                ->unsigned();
            $table->decimal('deciAmountPaid');
            $table->integer('intPaymentType');
            $table->integer('intChequeIdFK')
                ->unsigned()
                ->nullable();
            $table->timestamps();

            $table->foreign('intCustomerIdFK')
                ->references('intCustomerId')
                ->on('tblCustomer');

            $table->foreign('intChequeIdFK')
                ->references('intChequeId')
                ->on('tblCheque');

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
