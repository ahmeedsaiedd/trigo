<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade'); // Explicitly reference 'users'
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('sku')->nullable()->unique(); // Already nullable as desired
            $table->decimal('price', 8, 2);
            $table->decimal('after_sale_price', 8, 2)->nullable();
            $table->integer('stock');
            $table->text('description');
            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();
            $table->string('image');
            $table->json('gallery')->nullable();
            $table->integer('warranty')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['pending', 'active', 'rejected']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}