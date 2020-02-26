<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('address')->nullable()->default(null);
            $table->text('tax')->nullable()->default(null);
            $table->text('phone')->nullable()->default(null);
            $table->text('email')->nullable()->default(null);
            $table->text('payment_method')->nullable()->default(null);
            $table->integer('payment_terms')->unsigned()->nullable()->default(30);
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
        Schema::dropIfExists('companies');
    }
}
