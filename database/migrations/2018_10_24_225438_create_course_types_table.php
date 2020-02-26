<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('title')->nullable()->default(null);
            $table->text('tutor_title')->nullable()->default(null);
            $table->integer('default_rate')->unsigned()->default(100);
            $table->text('objectives')->nullable()->default(null);
            $table->text('who_should_attend')->nullable()->default(null);
            $table->text('delegates')->nullable()->default(null);
            $table->text('outline')->nullable()->default(null);
            $table->text('duration')->nullable()->default(null);
            $table->text('certification')->nullable()->default(null);
            $table->text('what_to_bring')->nullable()->default(null);
            $table->time('start_time')->nullable()->default(null);
            $table->text('plan_of_the_day')->nullable()->default(null);
            $table->integer('valid_for_years')->unsigned()->nullable()->default(4);
            $table->integer('capacity')->unsigned()->default(20);
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
        Schema::dropIfExists('course_types');
    }
}
