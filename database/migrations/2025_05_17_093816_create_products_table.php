<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('picture');
            $table->string('picture2');
            $table->text('description');
            $table->text('ex_description')->nullable();
            $table->float('price', 8, 2);
            $table->integer('quantity');
            $table->string('category');
            $table->string('type');
            $table->string('pdf')->nullable();
            $table->string('video')->nullable();
            $table->string('video2')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}; 