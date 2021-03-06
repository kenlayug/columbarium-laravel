<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblReservation', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intReservationId');
            $table->integer('intCustomerIdFK')
                ->unsigned();
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
