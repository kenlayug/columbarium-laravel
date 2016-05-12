<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblRequirement', function(Blueprint $table){
            $table->increments('intRequirementId');
            $table->string('strRequirementName', 50);
            $table->text('strRequirementDesc');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('strRequirementName');
        });

        Schema::create('tblService', function(Blueprint $table){
            $table->increments('intServiceId');
            $table->string('strServiceName', 50);
            $table->text('strServiceDesc');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('strServiceName');
        });

        Schema::create('tblServiceRequirement', function(Blueprint $table){
            $table->increments('intServiceRequirementId');
            $table->integer('intServiceIdFK')
                ->unsigned();
            $table->integer('intRequirementIdFK')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intServiceIdFK')
                ->references('intServiceId')
                ->on('tblService');
            $table->foreign('intRequirementIdFK')
                ->references('intRequirementId')
                ->on('tblRequirement');
        });

        Schema::create('tblServicePrice', function(Blueprint $table){
            $table->increments('intServicePriceId');
            $table->integer('intServiceIdFK')
                ->unsigned();
            $table->decimal('deciPrice', 8, 2);
            $table->timestamps();

            $table->foreign('intServiceIdFK')
                ->references('intServiceId')
                ->on('tblService');
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
