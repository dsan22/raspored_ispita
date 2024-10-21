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
        Schema::create('examination_periods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date("start_date");
            $table->date("end_date");
            $table->foreignId('examination_period_name_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination_periods');
    }
};
