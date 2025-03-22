<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'image', 'url'];

    // Define the relationship with Product model
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
