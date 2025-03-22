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
            Log::info('Starting migration for vendors table');

            if (!Schema::hasTable('vendors')) {
                Log::info('Creating vendors table');
                Schema::create('vendors', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                    $table->string('name');
                    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                    $table->timestamps();
                });
            } else {
                Log::info('Vendors table already exists, checking structure');
                Schema::table('vendors', function (Blueprint $table) {
                    // Add missing columns if they don’t exist
                    if (!Schema::hasColumn('vendors', 'user_id')) {
                        $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('id');
                    }
                    if (!Schema::hasColumn('vendors', 'name')) {
                        $table->string('name')->after('user_id');
                    }
                    if (!Schema::hasColumn('vendors', 'status')) {
                        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('name');
                    }
                    if (!Schema::hasColumn('vendors', 'created_at')) {
                        $table->timestamps();
                    }
                });
            }

            Log::info('Vendors table migration completed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create or update vendors table', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
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
            Log::info('Dropping vendors table');
            Schema::dropIfExists('vendors');
            Log::info('Vendors table dropped successfully');
        } catch (\Exception $e) {
            Log::error('Failed to drop vendors table', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }
};