<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Sync permissions if any are selected
        if ($request->has('permissions')) {
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Add other methods (show, edit, update, destroy) as needed
}
