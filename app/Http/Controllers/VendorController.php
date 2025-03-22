<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User; // Assuming User model is needed for registration

class VendorController extends Controller
{
    public function showRegisterForm()
    {
        return view('home.vendor-register');
    }

    public function register(Request $request)
    {
        \Log::debug('Entering register method');
        \Log::info('Vendor Registration Request Started:', $request->all());

        $rules = [
            'shop_name' => 'required|string|max:255',
            'shop_address' => 'required|string|max:500',
            'shop_logo' => 'nullable|image|max:2048',
            'terms' => 'required|accepted',
        ];

        if (!Auth::check()) {
            $rules = array_merge($rules, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:15',
                'password' => 'required|string|min:8|confirmed',
            ]);
        }

        try {
            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Validation Failed:', ['errors' => $e->errors()]);
            throw $e;
        }

        $logoPath = null;
        if ($request->hasFile('shop_logo')) {
            $logoPath = $request->file('shop_logo')->store('shop_logos', 'public');
            \Log::info('Shop Logo Uploaded Successfully:', ['path' => $logoPath]);
        }

        try {
            if (Auth::check()) {
                $user = Auth::user();
                \Log::info('Using existing user:', ['user_id' => $user->id]);
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ]);
                \Log::info('User created:', ['user_id' => $user->id]);
                Auth::login($user);
                \Log::info('User logged in:', ['user_id' => $user->id]);
            }

            $userId = $user->id;

            $vendor = \App\Models\Vendor::create([
                'name' => $request->shop_name,
                'user_id' => $userId,
                'status' => 'pending',
                'image' => $logoPath,
            ]);
            \Log::info('Vendor created:', ['vendor_id' => $vendor->id]);

            if (!$user->hasRole('Vendor')) {
                $role = Role::findByName('Vendor') ?? Role::create(['name' => 'Vendor']);
                $user->assignRole($role);
                \Log::info('Vendor role assigned:', ['user_id' => $userId]);
            }

            \Log::info('Vendor Registration Successful:', [
                'vendor_id' => $vendor->id,
                'user_id' => $userId,
                'shop_name' => $request->shop_name,
                'logo_path' => $logoPath,
            ]);

            if ($vendor->status === 'approved') {
                return redirect()->route('vendor.dashboard')->with('success', 'Registration successful. Welcome aboard!');
            }
            return redirect()->route('home.index')->with('success', 'Registration successful. Awaiting approval.');
        } catch (\Exception $e) {
            \Log::error('Vendor Registration Failed:', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            // return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function vendorDashboard()
{
    $user = Auth::user();
    $vendor = $user->vendor;

    if (!$vendor) {
        \Log::error('No vendor record found for user', ['user_id' => $user->id]);
    }

    return view('vendor.dashboard', [
        'vendor' => $vendor,
        'createdAt' => $user->created_at,
    ]);
}
public function index()
{
    return view('vendor.dashboard'); // Ensure 'vendor.index' view exists
}
}