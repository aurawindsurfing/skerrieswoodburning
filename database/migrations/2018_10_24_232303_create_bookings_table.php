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
            
            $table->text('name')->nullable()->default(null);;
            $table->text('surname')->nullable()->default(null);
            $table->text('phone')->nullable()->default(null);
            $table->text('email')->nullable()->default(null);
            $table->boolean('pps')->default(false);
            $table->integer('rate')->unsigned();
            $table->text('payment_type')->nullable()->default(null);
            $table->integer('course_id')->unsigned();
            $table->integer('company_id')->unsigned()->nullable()->default(null);
            $table->integer('contact_id')->unsigned()->nullable()->default(null);
            $table->text('po')->nullable()->default(null);
            $table->text('invoice_id')->nullable()->default(null);
            $table->boolean('student_notified')->default(false);
            $table->boolean('company_contact_notified')->default(false);
            $table->dateTime('reminder_sent')->nullable()->default(null);
            $table->dateTime('pps_reminder_sent')->nullable()->default(null);
            $table->boolean('confirmed')->default(false);
            $table->boolean('no_show')->default(false);
            $table->integer('user_id')->unsigned()->nullable()->default(null);
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
