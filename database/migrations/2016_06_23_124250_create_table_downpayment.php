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
            $table->integer('intCustomerIdFK')
                ->unsigned();
            $table->integer('intUnitIdFK')
                ->unsigned();
            $table->integer('intUnitCategoryPriceIdFK')
                ->unsigned();
            $table->boolean('boolPaid')
                ->default(false);
            $table->integer('intInterestRateIdFK')
                ->unsigned();
            $table->boolean('boolNoPaymentWarning');
            $table->boolean('boolNotFullWarning');
            $table->timestamps();

            $table->foreign('intCustomerIdFK')
                ->references('intCustomerId')
                ->on('tblCustomer');

            $table->foreign('intUnitIdFK')
                ->references('intUnitId')
                ->on('tblUnit');

            $table->foreign('intUnitCategoryPriceIdFK')
                ->references('intUnitCategoryPriceId')
                ->on('tblUnitCategoryPrice');

            $table->foreign('intInterestRateIdFK')
                ->references('intInterestRateId')
                ->on('tblInterestRate');

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
