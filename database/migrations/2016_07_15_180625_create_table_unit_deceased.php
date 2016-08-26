<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnitDeceased extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblUnitDeceased', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intUnitDeceasedId');
            $table->integer('intDeceasedIdFK')
                ->unsigned();
            $table->integer('intUnitIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intStorageTypeIdFK')
                ->unsigned();
            $table->boolean('boolBorrowed')
                ->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intDeceasedIdFK')
                ->references('intDeceasedId')
                ->on('tblDeceased');

            $table->foreign('intUnitIdFK')
                ->references('intUnitId')
                ->on('tblUnit');

            $table->foreign('intStorageTypeIdFK')
                ->references('intStorageTypeId')
                ->on('tblStorageType');

            $table->unique(['intUnitIdFK', 'intDeceasedIdFK']);

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
