<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->integer('punter_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->text('PO')->nullable()->default(null);
            $table->text('invoice')->nullable()->default(null);
            $table->boolean('confirmetion_sent')->nullable()->default(false);
            $table->boolean('confirmed')->nullable()->default(false);
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->integer('payment_id')->unsigned()->nullable()->default(null);
            $table->text('actually_paid')->nullable()->default(null);
            $table->text('comments')->nullable()->default(null);
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
        Schema::dropIfExists('bookings');
    }
}
