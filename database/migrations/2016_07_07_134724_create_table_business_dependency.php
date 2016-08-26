<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBusinessDependency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblBusinessDependency', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intBusinessDependencyId');
            $table->string('strBusinessDependencyName');
            $table->decimal('deciBusinessDependencyValue');
            $table->timestamps();

            $table->unique('strBusinessDependencyName');

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
