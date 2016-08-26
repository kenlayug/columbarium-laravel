<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblBlock', function(Blueprint $table){
            $table->engine      =   'InnoDB';
            $table->increments('intBlockId');
            $table->integer('intFloorIdFK')
                ->unsigned();
            $table->string('strBlockName', 50);
            $table->integer('intUnitType');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('intFloorIdFK')
                ->references('intFloorId')
                ->on('tblFloor');

            $table->unique(['strBlockName', 'intFloorIdFK']);
        });

        Schema::create('tblUnitCategory', function(Blueprint $table){
            $table->engine      =   'InnoDB';
            $table->increments('intUnitCategoryId');
            $table->integer('intBlockIdFK')
                ->unsigned();
            $table->integer('intLevelNo');
            $table->timestamps();

            $table->foreign('intBlockIdFK')
                ->references('intBlockId')
                ->on('tblBlock');
        });

        Schema::create('tblUnitCategoryPrice', function($table){
            $table->engine      =   'InnoDB';
            $table->increments('intUnitCategoryPriceId');
            $table->integer('intUnitCategoryIdFK')
                ->unsigned();
            $table->decimal('deciPrice', 8, 2);
            $table->timestamps();

            $table->foreign('intUnitCategoryIdFK')
                ->references('intUnitCategoryId')
                ->on('tblUnitCategory');
        });

        Schema::create('tblUnit', function(Blueprint $table){
            $table->engine      =   'InnoDB';
            $table->increments('intUnitId');
            $table->integer('intBlockIdFK')
                ->unsigned();
            $table->integer('intUnitCategoryIdFK')
                ->unsigned();
            $table->integer('intColumnNo');
            $table->timestamps();
            $table->integer('intUnitStatus');

            $table->foreign('intBlockIdFK')
                ->references('intBlockId')
                ->on('tblBlock');

            $table->foreign('intUnitCategoryIdFK')
                ->references('intUnitCategoryId')
                ->on('tblUnitCategory');
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
