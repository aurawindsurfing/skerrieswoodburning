<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->text('objectives')->nullable()->default(null);
            $table->text('who_should_attend')->nullable()->default(null);
            $table->text('delegates')->nullable()->default(null);
            $table->text('outline')->nullable()->default(null);
            $table->text('duration')->nullable()->default(null);
            $table->text('certification')->nullable()->default(null);
            $table->text('what_to_bring')->nullable()->default(null);
            $table->text('plan_of_the_day')->nullable()->default(null);
            $table->integer('valid_for_years')->unsigned()->nullable()->default(4);
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
