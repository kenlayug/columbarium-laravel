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

            $table->dropColumn('intUnitType');
            $table->integer('intUnitTypeIdFK')
                ->unsigned();

            $table->foreign('intUnitTypeIdFK')
                ->references('intRoomTypeId')
                ->on('tblRoomType');

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
