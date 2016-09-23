<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactionOwnership extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTransactionOwnership', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intTransactionOwnershipId');

            $table->integer('intPrevOwnerIdFK')
                ->unsigned();
            $table->integer('intNewOwnerIdFK')
                ->unsigned();
            $table->integer('intUnitIdFK')
                ->unsigned();

            $table->decimal('deciAmountPaid');
            $table->integer('intPaymentType');
            $table->integer('intChequeIdFK')
                ->unsigned()
                ->nullable();

            $table->timestamps();

            $table->foreign('intPrevOwnerIdFK')
                ->references('intCustomerId')
                ->on('tblCustomer');

            $table->foreign('intNewOwnerIdFK')
                ->references('intCustomerId')
                ->on('tblCustomer');

            $table->foreign('intUnitIdFK')
                ->references('intUnitId')
                ->on('tblUnit');

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
