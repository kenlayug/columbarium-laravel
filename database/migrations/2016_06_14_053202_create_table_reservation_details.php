<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblReservationDetail', function(Blueprint $table){

            $table->increments('intReservationDetailId');
            $table->integer('intReservationIdFK')
                ->unsigned();
            $table->integer('intUnitIdFK')
                ->unsigned();
            $table->integer('intInterestIdFK')
                ->unsigned();
            $table->integer('intUnitCategoryPriceIdFK')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intReservationIdFK')
                ->references('intReservationId')
                ->on('tblReservation');

            $table->foreign('intUnitIdFK')
                ->references('intUnitId')
                ->on('tblUnit');

            $table->foreign('intInterestIdFK')
                ->references('intInterestId')
                ->on('tblInterest');

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
