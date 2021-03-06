<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblAdditionalCategory', function(Blueprint $table){
            $table->engine      =   'InnoDB';
            $table->increments('intAdditionalCategoryId');
            $table->string('strAdditionalCategoryName', 50);
            $table->timestamps();

            $table->unique('strAdditionalCategoryName');
        });

        Schema::create('tblAdditional', function(Blueprint $table){
            $table->engine      =   'InnoDB';
            $table->increments('intAdditionalId');
            $table->string('strAdditionalName', 50);
            $table->text('strAdditionalDesc')
                ->nullable();
            $table->integer('intAdditionalCategoryIdFK')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('strAdditionalName');
            $table->foreign('intAdditionalCategoryIdFK')
                ->references('intAdditionalCategoryId')
                ->on('tblAdditionalCategory');
        });

        Schema::create('tblAdditionalPrice', function(Blueprint $table){
            $table->engine      =   'InnoDB';
            $table->increments('intAdditionalPriceId');
            $table->integer('intAdditionalIdFK')
                ->unsigned();
            $table->decimal('deciPrice', 8, 2);
            $table->timestamps();

            $table->foreign('intAdditionalIdFK')
                ->references('intAdditionalId')
                ->on('tblAdditional');
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
