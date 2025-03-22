<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    // Show the form to assign roles to a user
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.roles.edit', compact('user', 'roles'));
    }

    // Assign roles to a user
    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('success', 'Roles assigned successfully.');
    }
}
