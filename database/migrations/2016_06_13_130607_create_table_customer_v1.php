<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomerV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCustomer', function(Blueprint $table){
           $table->increments('intCustomerId');
            $table->string('strFirstName', 50);
            $table->string('strMiddleName', 50)
                ->nullable();
            $table->string('strLastName', 50);
            $table->text('strAddress');
            $table->string('strContactNo', 15);
            $table->date('dateBirthday');
            $table->integer('intGender');
            $table->integer('intCivilStatus');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['strFirstName', 'strMiddleName', 'strLastName']);
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
