<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUnitCategoryV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblUnitCategory', function($table){

            $table->dropForeign('tblUnitCategory_intBlockIdFK_foreign');
            $table->dropColumn('intBlockIdFK');
            $table->integer('intFloorIdFK')
                ->unsigned();
            $table->integer('intUnitType');

            $table->foreign('intFloorIdFK')
                ->references('intFloorId')
                ->on('tblFloor');

            $table->unique(['intFloorIdFK', 'intLevelNo', 'intUnitType']);

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
