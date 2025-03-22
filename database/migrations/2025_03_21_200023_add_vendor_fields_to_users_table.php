<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            Log::info('Starting migration to add vendor fields to users table');

            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'shop_name')) {
                    $table->string('shop_name')->nullable()->after('name');
                    Log::info('Added shop_name column to users table');
                }
                if (!Schema::hasColumn('users', 'phone')) {
                    $table->string('phone')->nullable()->after('email');
                    Log::info('Added phone column to users table');
                }
                if (!Schema::hasColumn('users', 'shop_address')) {
                    $table->string('shop_address')->nullable()->after('phone');
                    Log::info('Added shop_address column to users table');
                }
                if (!Schema::hasColumn('users', 'status')) {
                    $table->string('status')->default('pending')->after('password');
                    Log::info('Added status column to users table');
                }
                if (!Schema::hasColumn('users', 'shop_logo')) {
                    $table->string('shop_logo')->nullable()->after('status');
                    Log::info('Added shop_logo column to users table');
                }
            });

            Log::info('Vendor fields migration for users table completed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to add vendor fields to users table', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Log::info('Rolling back vendor fields from users table');

            Schema::table('users', function (Blueprint $table) {
                $columns = ['shop_name', 'phone', 'shop_address', 'status', 'shop_logo'];
                $existingColumns = array_filter($columns, fn($column) => Schema::hasColumn('users', $column));
                
                if (!empty($existingColumns)) {
                    $table->dropColumn($existingColumns);
                    Log::info('Dropped columns from users table', ['columns' => $existingColumns]);
                }
            });

            Log::info('Vendor fields rollback from users table completed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to rollback vendor fields from users table', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }
};