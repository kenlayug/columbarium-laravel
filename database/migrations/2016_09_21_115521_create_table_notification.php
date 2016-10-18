<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblNotification', function(Blueprint $table){

            $table->engine      =   'InnoDB';
            $table->increments('intNotificationId');
            $table->integer('intNotificationType');
            $table->integer('intCollectionIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intDownpaymentIdFK')
                ->unsigned()
                ->nullable();
            $table->integer('intScheduleDetailIdFK')
                ->unsigned()
                ->nullable();
            $table->boolean('boolRead')
                ->default(false);

            $table->timestamps();

            $table->foreign('intCollectionIdFK')
                ->references('intCollectionId')
                ->on('tblCollection');

            $table->foreign('intDownpaymentIdFK')
                ->references('intDownpaymentId')
                ->on('tblDownpayment');

            $table->foreign('intScheduleDetailIdFK')
                ->references('intScheduleDetailId')
                ->on('tblScheduleDetail');

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
