<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactionDeceased extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTransactionDeceased', function(Blueprint $table){

            $table->increments('intTransactionDeceasedId');

            $table->integer('intPaymentType')
                ->nullable();
            $table->integer('intTransactionType');
            $table->decimal('deciAmountPaid')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intServiceIdFK')
                ->references('intServiceId')
                ->on('tblService');

            $table->foreign('intServicePriceIdFK')
                ->references('intServicePriceId')
                ->on('tblServicePrice');

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
