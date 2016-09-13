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
            $table->string('strReceiver');
            $table->string('strChequeNo');
            $table->date('dateCheque');
            $table->string('strAccountHolderName');
            $table->string('strAccountNo');

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
