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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Transaction Details
            $table->decimal('amount', 15, 2); // Supports large values safely
            $table->enum('type', ['income', 'expense']);
            $table->text('description')->nullable();
            $table->date('date');

            $table->timestamps();

            // Indexes for performance
        
            $table->index('category_id');
            $table->index(['user_id', 'date']);
           
            

            // Optional composite index (VERY useful for filtering dashboards)
            // $table->index(['user_id', 'type']);
            // $table->index(['user_id', 'date']);
            $table->index(['user_id', 'type', 'date', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};