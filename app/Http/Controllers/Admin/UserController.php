<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.customers', compact('users'));
    }
    public function pendingUsers()
    {
        // Assuming 'status' column exists in users table where 'pending' means users who need approval
        $pendingUsers = User::where('status', 'pending')->get();
        return view('admin.users.pending-users', compact('pendingUsers'));
    }
}
