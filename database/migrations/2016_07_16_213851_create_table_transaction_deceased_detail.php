<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactionDeceasedDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTDeceasedDetail', function(Blueprint $table){

            $table->increments('intTDeceasedDetailId');

            $table->integer('intTDeceasedIdFK')
                ->unsigned();
            $table->integer('intUDeceasedIdFK')
                ->unsigned();

            $table->date('dateReturn')
                ->nullable();

            $table->timestamps();

            $table->foreign('intTDeceasedIdFK')
                ->references('intTransactionDeceasedId')
                ->on('tblTransactionDeceased');

            $table->foreign('intUDeceasedIdFK')
                ->references('intUnitDeceasedId')
                ->on('tblUnitDeceased');

            $table->unique(['intTDeceasedIdFK', 'intUDeceasedIdFK']);

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
