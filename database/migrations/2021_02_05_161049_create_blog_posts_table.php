<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('header')->nullable();
            $table->text('title');
            $table->text('description_above_image');
            $table->text('image')->nullable();
            $table->text('description_below_image')->nullable();
            $table->text('slug');
            $table->timestamps();
        });
    }
}
