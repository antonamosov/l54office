<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailDatesToStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('mail_pre_entry_date')->nullable();
            $table->string('mail_confirmed_date')->nullable();
            $table->string('mail_expired_date')->nullable();
            $table->string('mail_call_date')->nullable();
            $table->string('mail_score_date')->nullable();
            $table->string('mail_withdrawal_date')->nullable();
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
            $table->dropColumn('mail_pre_entry_date');
            $table->dropColumn('mail_confirmed_date');
            $table->dropColumn('mail_expired_date');
            $table->dropColumn('mail_call_date');
            $table->dropColumn('mail_score_date');
            $table->dropColumn('mail_withdrawal_date');
        });
    }
}
