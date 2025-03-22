<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the incorrect foreign key (if it exists)
            try {
                $table->dropForeign('products_vendor_id_foreign');
            } catch (\Exception $e) {
                // Ignore if foreign key doesn’t exist
            }

            // Add the correct foreign key constraint
            $table->foreign('vendor_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the new foreign key
            $table->dropForeign(['vendor_id']);

            // Optionally restore the original (if it referenced vendors)
            $table->foreign('vendor_id')
                  ->references('id')
                  ->on('vendors')
                  ->onDelete('cascade');
        });
    }
};