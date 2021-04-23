<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddsOrderToCourseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_types', function (Blueprint $table) {
            $table->integer('order')->unsigned()->nullable()->after('course_type_group_id');
        });
    }
}
