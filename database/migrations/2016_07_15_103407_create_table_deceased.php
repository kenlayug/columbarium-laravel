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
            $table->string('strFirstName', 50);
            $table->string('strMiddleName', 50)
                ->nullable();
            $table->string('strLastName', 50);
            $table->date('dateDeath');
            $table->date('dateInterment');
            $table->integer('intRelationshipIdFK')
                ->unsigned();
            $table->integer('intCustomerIdFK')
                ->unsigned();
            $table->timestamps();

            $table->unique(['strFirstName', 'strMiddleName', 'strLastName'], 'uqName');

            $table->foreign('intRelationshipIdFK')
                ->references('intRelationshipId')
                ->on('tblRelationship');

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
