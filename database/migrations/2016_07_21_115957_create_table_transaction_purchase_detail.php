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
            $table->timestamps();

            $table->foreign('intTPurchaseIdFK')
                ->references('intTransactionPurchaseId')
                ->on('tblTransactionPurchase');

            $table->foreign('intAdditionalIdFK')
                ->references('intAdditionalId')
                ->on('tblAdditional');

            $table->foreign('intAdditionalPriceIdFK')
                ->references('intAdditionalPriceId')
                ->on('tblAdditionalPrice');

            $table->foreign('intServiceIdFK')
                ->references('intServiceId')
                ->on('tblService');

            $table->foreign('intServicePriceIdFK')
                ->references('intServicePriceId')
                ->on('tblServicePrice');

            $table->foreign('intPackageIdFK')
                ->references('intPackageId')
                ->on('tblPackage');

            $table->foreign('intPackagePriceIdFK')
                ->references('intPackagePriceId')
                ->on('tblPackagePrice');

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
