<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::updateOrCreate(['key' => 'business_name'], ['value' => 'Trigo']);
        Setting::updateOrCreate(['key' => 'logo'], ['value' => null]);
        Setting::updateOrCreate(['key' => 'primary_color'], ['value' => '#4f46e5']);
        Setting::updateOrCreate(['key' => 'secondary_color'], ['value' => '#10b981']);
    }
}