<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'Apple', 'image' => 'brands/apple.png', 'url' => 'https://www.apple.com'],
            ['name' => 'Samsung', 'image' => 'brands/samsung.png', 'url' => 'https://www.samsung.com'],
            ['name' => 'Sony', 'image' => 'brands/sony.png', 'url' => 'https://www.sony.com'],
            ['name' => 'Nike', 'image' => 'brands/nike.png', 'url' => 'https://www.nike.com'],
            ['name' => 'Adidas', 'image' => 'brands/adidas.png', 'url' => 'https://www.adidas.com'],
            ['name' => 'Logitech', 'image' => 'brands/logitech.png', 'url' => 'https://www.logitech.com'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}