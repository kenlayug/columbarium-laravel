<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCollection', function (Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intCollectionId');
            $table->integer('intCustomerIdFK')
                ->unsigned();
            $table->integer('intUnitIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intUnitCategoryPriceIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intInterestRateIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intServicePriceIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intPackagePriceIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intTPurchaseDetailIdFK')
                ->unsigned()
                ->nullable();
            $table->date('dateCollectionStart');
            $table->boolean('boolFinish')
                ->default(false);
            $table->timestamps();
            $table->softDeletes();

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

            $table->foreign('intServicePriceIdFK')
                ->references('intServicePriceId')
                ->on('tblServicePrice');

            $table->foreign('intPackagePriceIdFK')
                ->references('intPackagePriceId')
                ->on('tblPackagePrice');

            $table->foreign('intTPurchaseDetailIdFK')
                ->references('intTPurchaseDetailId')
                ->on('tblTPurchaseDetail');

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
