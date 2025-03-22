<?php

namespace App\Http\Controllers;

use App\Models\Setting; // Assuming you have a Setting model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the shop settings form.
     */
    public function index()
    {
        return view('vendor.settings');
    }

    /**
     * Update the shop settings in the database.
     */
    public function update(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'primary_color' => 'required|string|max:7', // e.g., #4f46e5
        ]);

        // Update business name
        Setting::updateOrCreate(
            ['key' => 'business_name'],
            ['value' => $request->business_name]
        );

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            Setting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $logoPath]
            );
        }

        // Update primary color
        Setting::updateOrCreate(
            ['key' => 'primary_color'],
            ['value' => $request->primary_color]
        );

        return redirect()->route('vendor.settings')->with('success', 'Settings updated successfully!');
    }
}