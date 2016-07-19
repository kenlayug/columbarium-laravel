<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeceased extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDeceased', function(Blueprint $table){

            $table->increments('intDeceasedId');
            $table->string('strFirstName');
            $table->string('strMiddleName')
                ->nullable();
            $table->string('strLastName');
            $table->date('dateDeath');
            $table->integer('intRelationshipIdFK')
                ->unsigned();
            $table->timestamps();

            $table->unique(['strFirstName', 'strMiddleName', 'strLastName']);

            $table->foreign('intRelationshipIdFK')
                ->references('intRelationshipId')
                ->on('tblRelationship');

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