<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_log', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('booking_id')->nullable()->default(null);
            $table->bigInteger('invoice_id')->nullable()->default(null);
            $table->text('subject');
            $table->text('type');
            $table->text('message');
            $table->dateTime('confirmation_sent')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_log');
    }
}