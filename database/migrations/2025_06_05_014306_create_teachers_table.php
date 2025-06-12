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
          Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('course');
            $table->decimal('price', 8, 2);
            $table->integer('total_seats')->default(0); // Added total_seats column with a default of 0
            $table->integer('booked_seats')->default(0); // Added booked_seats column with a default of 0 to track current bookings
            $table->text('description')->nullable();
            $table->text('more_info')->nullable();
            $table->string('live_link')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
