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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ← user_id foreign key
            $table->foreignId('pet_id')->constrained()->onDelete('cascade'); // ← pet_id foreign key
            $table->string('phone')->nullable(); // ← phone field
            $table->string('address')->nullable(); // ← address field
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending'); // ← status field with default value
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
