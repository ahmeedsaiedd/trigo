<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // List all permissions
    public function index()
    {
        $permissions = Permission::paginate(10); // Paginate instead of all()
        return view('permissions.index', compact('permissions'));
    }

    // Show the form to create a new permission
    public function create()
    {
        $permissions = Permission::paginate(10); // Add paginated permissions
        return view('permissions.create', compact('permissions')); // Match view name
    }

    // Store a new permission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    // Show a specific permission
    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    // Show the form to edit a permission
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    // Update a permission
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    // Delete a permission
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}