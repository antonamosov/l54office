<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStudentExamDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('enrolment_exam');
            $table->dropColumn('exam_date_from');
            $table->dropColumn('exam_date_to');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->timestamp('enrolment_exam')->nullable();
            $table->timestamp('exam_date_from')->nullable();
            $table->timestamp('exam_date_to')->nullable();
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
            //
        });
    }
}
