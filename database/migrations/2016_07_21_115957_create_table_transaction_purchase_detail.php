<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactionPurchaseDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTPurchaseDetail', function(Blueprint $table){

            $table->increments('intTPurchaseDetailId');
            $table->integer('intTPurchaseIdFK')
                ->unsigned();
            $table->integer('intTPurchaseDetailType');
            $table->integer('intAdditionalIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intAdditionalPriceIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intServiceIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intServicePriceIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intPackageIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intPackagePriceIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intQuantity');

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
