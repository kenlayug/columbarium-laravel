<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblPackage', function(Blueprint $table){
            $table->increments('intPackageId');
            $table->string('strPackageName', 50);
            $table->text('strPackageDesc')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('strPackageName');
        });

        Schema::create('tblPackagePrice', function(Blueprint $table){
            $table->increments('intPackagePriceId');
            $table->integer('intPackageIdFK')
                ->unsigned();
            $table->decimal('deciPrice', 8, 2);
            $table->timestamps();

            $table->foreign('intPackageIdFK')
                ->references('intPackageId')
                ->on('tblPackage');
        });

        Schema::create('tblPackageAdditional', function(Blueprint $table){
            $table->increments('intPackageAdditionalId');
            $table->integer('intPackageIdFK')
                ->unsigned();
            $table->integer('intAdditionalIdFK')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intPackageIdFK')
                ->references('intPackageId')
                ->on('tblPackage');

            $table->foreign('intAdditionalIdFK')
                ->references('intAdditionalId')
                ->on('tblAdditional');
        });

        Schema::create('tblPackageService', function(Blueprint $table){
            $table->increments('intPackageServiceId');
            $table->integer('intPackageIdFK')
                ->unsigned();
            $table->integer('intServiceIdFK')
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intPackageIdFK')
                ->references('intPackageId')
                ->on('tblPackage');

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
