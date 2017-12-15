<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('fiscal_code');
            $table->string('vat');
            $table->string('personal_code');
            $table->string('matricola')->nullable();
            $table->string('born_in')->nullable();
            $table->string('date_of_birth');
            $table->integer('nation');
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->integer('province');
            $table->string('phone');
            $table->string('email');
            $table->integer('university');
            $table->integer('school');
            $table->string('enrolment_exam')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
