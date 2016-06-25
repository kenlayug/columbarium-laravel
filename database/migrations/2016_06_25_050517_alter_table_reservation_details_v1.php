<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableReservationDetailsV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblReservationDetail', function($table){

            $table->integer('intInterestRateIdFK')
                ->unsigned();

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
