<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Fashion'],
            ['name' => 'Food'],
            ['name' => 'Accessories'],
            ['name' => 'Handmade Crafts'],
            ['name' => 'Home Decor'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}