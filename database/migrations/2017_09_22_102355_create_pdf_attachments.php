<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdfAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('body');
            $table->integer('user_type')->default(\App\Student::ALL_STUDENTS);
            $table->integer('email_id');
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
        Schema::dropIfExists('pdf_attachments');
    }
}
