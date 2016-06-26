<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUnitV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblUnit', function($table){

            $table->integer('intCustomerIdFK')
                ->unsigned()
                ->nullable();

            $table->foreign('intCustomerIdFK')
                ->references('intCustomerId')
                ->on('tblCustomer');

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
