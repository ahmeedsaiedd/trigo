<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessSettingsController extends Controller
{
    public function index()
    {
        // Sample settings data (replace with real data from a model if needed)
        $settings = [
            'business_name' => 'Trigo',
            'shipping_carrier' => 'FedEx',
            'warehouse_location' => 'New York'
        ];
        return view('admin.business-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'shipping_carrier' => 'required|string|max:100',
            'warehouse_location' => 'required|string|max:255',
        ]);

        // Update logic (e.g., save to database or config file)
        // For demo, just redirect back with a success message
        return redirect()->route('admin.business-settings')->with('success', 'Settings updated successfully!');
    }
}