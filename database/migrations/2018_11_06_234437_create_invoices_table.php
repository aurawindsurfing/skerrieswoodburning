<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('prefix');
            $table->integer('number')->unsigned()->nullable()->default(null);
            $table->integer('company_id')->unsigned()->nullable()->default(null);
            $table->date('date');
            $table->integer('payment_terms')->unsigned()->nullable()->default(0);
            $table->double('total', 8, 2)->nullable();
            $table->text('status');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('invoices');
    }
}
