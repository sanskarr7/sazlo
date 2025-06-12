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
        Schema::create('live_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // Foreign key to teachers table
            $table->string('title');
            $table->string('link'); // The meeting URL
            $table->datetime('start_time');
            $table->datetime('end_time')->nullable(); // End time is optional
            $table->text('description')->nullable();
            $table->enum('status', ['scheduled', 'active', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_classes');
    }
};
