<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBuyUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblBuyUnit', function(Blueprint $table){

            $table->increments('intBuyUnitId');
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
