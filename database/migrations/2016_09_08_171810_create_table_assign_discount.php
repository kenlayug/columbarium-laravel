<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAssignDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblAssignDiscount', function(Blueprint $table){

            $table->engine          =   "InnoDB";

            $table->increments('intAssignDiscountId');
            $table->integer('intServiceIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intTransactionId')
                ->nullable();
            $table->integer('intDiscountIdFK')
                ->unsigned();

            $table->timestamps();

            $table->foreign('intServiceIdFK')
                ->references('intServiceId')
                ->on('tblService');

            $table->foreign('intDiscountIdFK')
                ->references('intDiscountId')
                ->on('tblDiscount');

            $table->unique(['intServiceIdFK', 'intDiscountIdFK']);
            $table->unique(['intTransactionId', 'intDiscountIdFK']);

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
