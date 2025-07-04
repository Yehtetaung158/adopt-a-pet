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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('breed')->nullable();
            $table->date('birth_date')->nullable();
            // $table->text('Image')->nullable();
            // $table->string('image')->nullable();
            $table->json('images'); // For multiple images
            $table->string('description')->nullable();
            $table->enum('status', ['available', 'adopted'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
