<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeExamDateFromInStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('exam_date_from');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->string('exam_date_from');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('exam_date_to');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->string('exam_date_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
