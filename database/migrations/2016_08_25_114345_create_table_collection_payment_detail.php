<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCollectionPaymentDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCollectionPaymentDetail', function(Blueprint $table){

            $table->increments('intCollectionPaymentDetailId');
            $table->integer('intCollectionPaymentIdFK')
                ->unsigned();

            $table->date('dateDue');

            $table->foreign('intCollectionPaymentIdFK')
                ->references('intCollectionPaymentId')
                ->on('tblCollectionPayment');

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
