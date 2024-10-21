<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('classrooms', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('examination_period_names', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('examination_periods', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('subjects', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('exams', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('exam_change_requests', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('examination_period_names', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('examination_periods', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('exams', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('exam_change_requests', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
