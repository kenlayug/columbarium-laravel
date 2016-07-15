<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAddDeceased extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblAddDeceased', function(Blueprint $table){

            $table->increments('intAddDeceased');
            $table->integer('intUnitDeceasedIdFK')
                ->unsigned();
            $table->integer('intServiceIdFK')
                ->unsigned();
            $table->integer('intServicePriceIdFK')
                ->unsigned();
            $table->integer('intPaymentType');
            $table->decimal('deciAmountPaid');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intUnitDeceasedIdFK')
                ->references('intUnitDeceasedId')
                ->on('tblUnitDeceased');

            $table->foreign('intServiceIdFK')
                ->references('intServiceId')
                ->on('tblService');

            $table->foreign('intServicePriceIdFK')
                ->references('intServicePriceId')
                ->on('tblServicePrice');

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
