<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesDefaultCourseRateRequirementsCourseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_types', function (Blueprint $table) {
            $table->integer('default_rate')->unsigned()->default(0)->change();
        });
    }
}
