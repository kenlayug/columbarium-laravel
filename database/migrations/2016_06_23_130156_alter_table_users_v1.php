<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsersV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){

            $table->dropColumn('name');
            $table->string('strFirstName');
            $table->string('strMiddleName')
                ->nullable();
            $table->string('strLastName');
            $table->text('strAddress');
            $table->date('dateBirthday');
            $table->softDeletes();
            $table->integer('intPositionIdFK')
                ->unsigned();
            $table->string('strPhotoDirectory')
                ->nullable();

            $table->foreign('intPositionIdFK')
                ->references('intPositionId')
                ->on('tblPosition');

            $table->unique(['strFirstName', 'strMiddleName', 'strLastName']);
            $table->unique('strPhotoDirectory');

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
