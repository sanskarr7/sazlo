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
        Schema::create('booking_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('live_class_id')->constrained('live_classes')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Optional: Link to logged-in user
            $table->string('student_name'); // Name provided in the form
            $table->string('student_email'); // Email provided in the form
            $table->timestamp('booking_date')->useCurrent(); // When the booking occurred
            $table->timestamps();

            // Ensure unique booking per email per class
            $table->unique(['live_class_id', 'student_email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_classes');
    }
};
