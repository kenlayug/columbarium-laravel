<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactionUnitDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTransactionUnitDetail', function(Blueprint $table){

            $table->increments('intTransactionUnitDetailId');
            $table->integer('intTransactionUnitIdFK')
                ->unsigned();
            $table->integer('intUnitIdFK')
                ->unsigned();
            $table->integer('intUnitCategoryPriceIdFK')
                ->unsigned();
            $table->timestamps();

            $table->foreign('intTransactionUnitIdFK')
                ->references('intTransactionUnitId')
                ->on('tblTransactionUnit');

            $table->foreign('intUnitIdFK')
                ->references('intUnitId')
                ->on('tblUnit');

            $table->foreign('intUnitCategoryPriceIdFK')
                ->references('intUnitCategoryPriceId')
                ->on('tblUnitCategoryPrice');

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
