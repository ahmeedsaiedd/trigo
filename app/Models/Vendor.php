<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'status', 'image', 'url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Automatically create a brand when a vendor is created
        static::created(function ($vendor) {
            
            \App\Models\Brand::create([
                'name' => $vendor->name,
                'image' => $vendor->image,
                'url' => $vendor->url,
                'url' => $vendor->url,
            ]);
        });
    }
}
