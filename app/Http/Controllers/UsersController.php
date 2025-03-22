<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|exists:roles,id',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        // Assign the selected role
        $role = Role::find($request->role);
        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    // Add other methods (show, edit, update, destroy) as needed
}
