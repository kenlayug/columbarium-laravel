<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableServiceV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblService', function($table){

            $table->integer('intServiceCategoryIdFK')
                ->unsigned();

            $table->foreign('intServiceCategoryIdFK')
                ->references('intServiceCategoryId')
                ->on('tblServiceCategory');

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
