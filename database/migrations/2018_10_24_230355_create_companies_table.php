<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->text('phone')->nullable()->default(null);
            $table->text('email')->nullable()->default(null);
            $table->integer('payment_method_id')->unsigned()->nullable()->default(null);
            $table->text('PO')->nullable()->default(null);
            $table->boolean('confirmed')->nullable()->default(false);


            $table->text('email')->nullable()->default(null);


            $table->integer('company_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('payment_id')->nullable()->default(null);
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
