<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCheque', function(Blueprint $table){

            $table->engine          =   "InnoDB";
            $table->increments('intChequeId');
            $table->string('strBankName');
            $table->string('strAccountNo');
            $table->string('strDrawee');
            $table->date('dateCheque');

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
