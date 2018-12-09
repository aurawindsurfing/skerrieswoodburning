<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('address_line_1')->nullable()->default(null);
            // $table->text('address_line_2')->nullable()->default(null);
            $table->text('city')->nullable()->default(null);
            // $table->text('county')->nullable()->default(null);
            $table->text('postal_code')->nullable()->default(null);
            $table->text('country')->nullable()->default(null);
            $table->text('phone')->nullable()->default(null);
            $table->text('photo')->nullable()->default(null);
            $table->text('geo')->nullable()->default(null);
            $table->text('google_maps')->nullable()->default(null);
            $table->text('directions')->nullable()->default(null);
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
        Schema::dropIfExists('venues');
    }
}
