<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBlockV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblBlock', function($table){

            $table->dropForeign('tblBlock_intFloorIdFK_foreign');
            $table->dropColumn('intFloorIdFK');
            $table->integer('intRoomIdFK')
                ->unsigned();

            $table->foreign('intRoomIdFK')
                ->references('intRoomId')
                ->on('tblRoom');

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
