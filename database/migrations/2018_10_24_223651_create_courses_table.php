<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id')->unsigned()->nullable();
            $table->integer('venue_id')->unsigned();
            $table->date('date');
            $table->time('time');
            $table->integer('price')->unsigned();
            $table->boolean('inhouse')->nullable()->default(false);
            $table->boolean('multiday')->nullable()->default(false);
            $table->boolean('cancelled')->nullable()->default(false);
            $table->integer('capacity')->unsigned()->nullable()->default(20);
            $table->text('notes')->nullable()->default(null);
            $table->integer('course_type_id')->unsigned()->nullable();
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
        Schema::dropIfExists('courses');
    }
}
