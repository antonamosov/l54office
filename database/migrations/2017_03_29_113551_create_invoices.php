<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoices extends Migration
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
            $table->string('fiscal_code')->nullable();
            $table->string('email');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('sum')->nullable();
            $table->string('total')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('description')->nullable();
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
