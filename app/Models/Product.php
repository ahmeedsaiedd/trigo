<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'vendor_id', 'category_id', 'name', 'sku', 'price', 'after_sale_price', 'stock',
        'description', 'colors', 'sizes', 'image', 'gallery', 'warranty', 'is_featured', 'status'
    ];

    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
{
    return $this->belongsTo(Brand::class);
}

}