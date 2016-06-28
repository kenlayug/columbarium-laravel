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

            $table->increments('intCollectionPaymentId');
            $table->integer('intCollectionIdFK')
                ->unsigned();
            $table->integer('intPaymentType');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intCollectionIdFK')
                ->references('intCollectionId')
                ->on('tblCollection');

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
