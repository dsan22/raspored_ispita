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
        Schema::create('exam_change_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date("new_date")->nullable();
            $table->time("new_time")->nullable();
            $table->foreignId("new_classroom")->constrained("classrooms")->nullable();
            $table->boolean("change_approved")->nullable();
            $table->foreignId("exam_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_change_requests');
    }
};
