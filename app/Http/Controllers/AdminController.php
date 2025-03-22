<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $totalUsers = User::count(); // Total number of users
        $totalVendors = User::role('Vendor')->count(); // Total vendors (assuming Spatie Laravel Permission)
        $allOrders = \App\Models\Order::count(); // Total number of orders
        $pendingVendors = User::role('Vendor')->where('status', 'pending')->count(); // Pending vendors
        $pendingOrders = \App\Models\Order::where('status', 'pending')->count(); // Pending orders (adjust 'status' column as per your schema)

        return view('admin.dashboard', compact('totalUsers', 'totalVendors', 'allOrders', 'pendingVendors', 'pendingOrders'));
    }

    public function vendors()
    {
        $vendors = \App\Models\User::role('Vendor')->paginate(10);
        return view('admin.vendors', compact('vendors'));
    }

    public function updateVendorStatus(Request $request, $id)
    {
        try {
            $vendor = User::findOrFail($id);
            $request->validate([
                'status' => 'required|in:pending,approved,rejected',
            ]);

            $vendor->update(['status' => $request->status]);

            return redirect()->route('admin.vendors')->with('success', 'Vendor status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.vendors')->with('error', 'Failed to update status: ' . $e->getMessage());
        }
    }

    public function orders()
    {
        $orders = \App\Models\Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function customers()
    {
        // Fetch all users with pagination
        $users = User::paginate(10); // Adjust pagination as needed

        // If using Spatie Laravel Permission
        // $users = User::with('roles')->paginate(10);
        $users = User::with('roles')->paginate(10);

        return view('admin.customers', compact('users'));
    }

    public function shipping()
    {
        return view('admin.shipping');
    }

    public function payments()
    {
        return view('admin.payments');
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function businessSettings()
    {
        return view('admin.business-settings');
    }

    public function updateBusinessSettings(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048', // Max 2MB
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            // Update config or database (example uses config for simplicity)
            config(['app.logo' => $logoPath]);
        }

        // Update settings (example stores in config; use a DB table in production)
        config(['app.name' => $request->business_name]);
        config(['app.primary_color' => $request->primary_color]);
        config(['app.secondary_color' => $request->secondary_color]);

        // Optionally save to a settings table or file
        // Example: \App\Models\Setting::updateOrCreate(['key' => 'business_name'], ['value' => $request->business_name]);

        return redirect()->route('admin.business-settings')->with('success', 'Business settings updated successfully.');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Uses Auth, but it's not correctly imported
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
