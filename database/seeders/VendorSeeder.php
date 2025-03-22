<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    public function run()
    {
        $vendors = [
            [
                'user_id' => 1,
                'name' => 'TechTrend Innovations',
                'image' => 'https://example.com/images/techtrend.jpg',
                'url' => 'https://techtrend.com',
                'status' => 'active',
                'full_texts' => 'TechTrend Innovations specializes in cutting-edge gadgets.',
            ],
            [
                'user_id' => 2,
                'name' => 'GreenLeaf Supplies',
                'image' => 'https://example.com/images/greenleaf.jpg',
                'url' => 'https://greenleafsupplies.com',
                'status' => 'active',
                'full_texts' => 'GreenLeaf Supplies offers eco-friendly products.',
            ],
            [
                'user_id' => 3,
                'name' => 'UrbanCraft Co.',
                'image' => 'https://example.com/images/urbancraft.jpg',
                'url' => 'https://urbancraftco.com',
                'status' => 'inactive',
                'full_texts' => 'UrbanCraft Co. provides handmade urban goods.',
            ],
        ];

        foreach ($vendors as $vendor) {
            DB::table('vendors')->insert($vendor);
        }
    }
}