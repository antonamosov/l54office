<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CtreateSemesters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('type')->nullable();
            $table->string('where')->nullable();
            $table->integer('max')->nullable();
            $table->timestamps();
            $table->integer('session_type_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semesters');
    }
}
