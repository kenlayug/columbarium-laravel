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
            $table->string('strFirstName', 50);
            $table->string('strMiddleName', 50)
                ->nullable();
            $table->string('strLastName', 50);
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

            $table->unique(['strFirstName', 'strMiddleName', 'strLastName'], 'uqName');
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
