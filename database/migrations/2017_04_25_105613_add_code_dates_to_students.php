<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeDatesToStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dateTime('tan_date')->nullable();
            $table->dateTime('tat_date')->nullable();
            $table->dateTime('tas_date')->nullable();
            $table->dateTime('fts_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('tan_date');
            $table->dropColumn('tat_date');
            $table->dropColumn('tas_date');
            $table->dropColumn('fts_date');
        });
    }
}
