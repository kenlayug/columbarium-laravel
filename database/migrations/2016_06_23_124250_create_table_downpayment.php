<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDownpayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDownpayment', function(Blueprint $table){

            $table->increments('intDownpaymentId');
            $table->integer('intReservationDetailIdFK')
                ->unsigned();
            $table->decimal('deciAmount');
            $table->integer('intPaymentType');
            $table->timestamps();

            $table->foreign('intReservationDetailIdFK')
                ->references('intReservationDetailId')
                ->on('tblReservationDetail');

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
