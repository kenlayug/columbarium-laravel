<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBlockV3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblBlock', function($table){

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
