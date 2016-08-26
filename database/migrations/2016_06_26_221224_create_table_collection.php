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
                ->unsigned();
            $table->integer('intUnitCategoryPriceIdFK')
                ->unsigned();
            $table->integer('intInterestRateIdFK')
                ->unsigned();
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
