<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtNeedDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblAtNeedDetail', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intAtNeedDetailId');
            $table->integer('intAtNeedIdFK')
                ->unsigned();
            $table->integer('intInterestIdFK')
                ->unsigned();
            $table->integer('intUnitIdFK')
                ->unsigned();
            $table->integer('intUnitCategoryPriceIdFK')
                ->unsigned();
            $table->integer('intInterestRateIdFK')
                ->unsigned();
            $table->boolean('boolDownpayment');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intAtNeedIdFK')
                ->references('intAtNeedId')
                ->on('tblAtNeed');

            $table->foreign('intInterestIdFK')
                ->references('intInterestId')
                ->on('tblInterest');

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
