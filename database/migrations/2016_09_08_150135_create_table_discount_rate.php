<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDiscountRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDiscountRate', function(Blueprint $table){

            $table->engine          =   "InnoDB";

            $table->increments('intDiscountRateId');
            $table->integer('intDiscountIdFK')
                ->unsigned();
            $table->integer('intDiscountType');
            $table->decimal('deciDiscountRate');
            $table->timestamps();

            $table->foreign('intDiscountIdFK')
                ->references('intDiscountId')
                ->on('tblDiscount');

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
