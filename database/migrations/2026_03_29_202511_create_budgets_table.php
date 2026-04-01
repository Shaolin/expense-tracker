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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Budget amount (no calculated fields)
            $table->decimal('amount', 15, 2);

            // Budget period (e.g., 2026-03)
            $table->string('month');

            $table->timestamps();

            // Prevent duplicate budgets per user/category/month
            $table->unique(['user_id', 'category_id', 'month']);

            // Indexes for performance
            $table->index('user_id');
            $table->index('category_id');
            $table->index('month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};