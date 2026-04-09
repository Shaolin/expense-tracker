<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // STEP 1: Add nullable columns
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('organization_id')->nullable()->after('id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('organization_id')->nullable()->after('id');
        });

        Schema::table('budgets', function (Blueprint $table) {
            $table->foreignId('organization_id')->nullable()->after('id');
        });

        // STEP 2: Backfill existing data
        // Since you're the only user, just use org_id = 1
        $orgId = 1;

        DB::table('transactions')->update(['organization_id' => $orgId]);
        DB::table('categories')->update(['organization_id' => $orgId]);
        DB::table('budgets')->update(['organization_id' => $orgId]);

        // STEP 3: Add foreign keys
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('organization_id')
                  ->references('id')
                  ->on('organizations')
                  ->cascadeOnDelete();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('organization_id')
                  ->references('id')
                  ->on('organizations')
                  ->cascadeOnDelete();
        });

        Schema::table('budgets', function (Blueprint $table) {
            $table->foreign('organization_id')
                  ->references('id')
                  ->on('organizations')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
        });

        Schema::table('budgets', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
        });
    }
};