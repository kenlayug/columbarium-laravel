<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCollectionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCollectionPayment', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intCollectionPaymentId');
            $table->integer('intCollectionIdFK')
                ->unsigned();
            $table->integer('intPaymentType');
            $table->decimal('deciAmountPaid');
            $table->integer('intChequeIdFK')
                ->unsigned()
                ->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intCollectionIdFK')
                ->references('intCollectionId')
                ->on('tblCollection');

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
