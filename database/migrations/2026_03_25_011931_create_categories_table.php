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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
        
            // Nullable for shared/default categories
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
        
            $table->string('name');
        
            // Enum for category type
            $table->enum('type', ['income', 'expense']);
        
            // NEW: description (used in your cards)
            $table->string('description')->nullable();
        
            // NEW: budget per category
            $table->decimal('budget', 10, 2)->nullable();
        
            // NEW: color for UI cards
            $table->string('color')->default('green');
        
            $table->timestamps();
        
            // Indexes for performance
            $table->index(['user_id']);
            $table->index(['type']);
        
            // Prevent duplicate category names per user + type
            $table->unique(['user_id', 'name', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};