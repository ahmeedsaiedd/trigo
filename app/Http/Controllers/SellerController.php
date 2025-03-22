<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function register(Request $request)
    {
        
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'shop_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user with all seller fields
        $user = User::create([
            'name' => $request->name,
            'shop_name' => $request->shop_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // Assign the 'Editor' role (for vendors/sellers)
        $user->assignRole('Editor');

        // Redirect back with success message
        return redirect()->back()->with('success', 'Seller registration successful! Please log in.');
    }
}