<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('fiscal_code')->nullable();
            $table->string('vat')->nullable();
            $table->string('personal_code')->nullable();
            $table->string('university_code')->nullable();
            $table->string('born_in')->nullable();
            $table->integer('city')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->integer('nation')->nullable();
            $table->string('resident_in')->nullable();
            $table->string('address')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('postal_code')->nullable();
            $table->integer('province')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('university')->nullable();
            $table->integer('school')->nullable();
            $table->boolean('confirmed')->nullable();
            $table->string('enrolment_exam')->nullable();
            $table->integer('exam_id')->nullable();
            $table->integer('exam_already_taken')->nullable();
            $table->string('eat_city')->nullable();
            $table->string('eat_school')->nullable();
            $table->string('eat_date')->nullable();
            $table->integer('know_us')->nullable();
            $table->string('exam_date_from')->nullable();
            $table->integer('exam_date_to')->nullable();
            $table->string('tan')->nullable();
            $table->string('tat')->nullable();
            $table->string('tas')->nullable();
            $table->string('fts')->nullable();
            $table->integer('mail_pre_entry')->nullable();
            $table->integer('mail_confirmed')->nullable();
            $table->integer('mail_expired')->nullable();
            $table->integer('mail_call')->nullable();
            $table->string('mail_score')->nullable();
            $table->integer('mail_withdrawal')->nullable();
            $table->text('note')->nullable();
            $table->string('sum')->nullable();
            $table->string('total')->nullable();
            $table->string('description')->nullable();
            $table->string('memo_1')->nullable();
            $table->string('memo_2')->nullable();
            $table->string('invoice_number_1')->nullable();
            $table->string('invoice_number_2')->nullable();
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
        Schema::dropIfExists('students');
    }
}
