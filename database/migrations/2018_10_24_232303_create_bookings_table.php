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
            $table->integer('candidate_id')->unsigned()->nullable()->default(null);;
            $table->integer('course_id')->unsigned();
            $table->integer('company_id')->unsigned()->nullable()->default(null);
            $table->integer('contact_id')->unsigned()->nullable()->default(null);
            $table->text('po')->nullable()->default(null);
            $table->text('invoice')->nullable()->default(null);
            $table->dateTime('confirmation_sent')->nullable()->default(null);
            $table->dateTime('reminder_sent')->nullable()->default(null);
            $table->boolean('confirmed')->default(false);
            $table->boolean('no_show')->default(false);
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->integer('payment_id')->unsigned()->nullable()->default(null);
            $table->text('actually_paid')->nullable()->default(null);
            $table->text('comments')->nullable()->default(null);
            $table->softDeletes();
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
