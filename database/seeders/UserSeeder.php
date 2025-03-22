<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Vendor', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'User', 'guard_name' => 'web']);

        // Create permissions
        Permission::firstOrCreate(['name' => 'manage-vendors', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'manage-products', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'manage-categories', 'guard_name' => 'web']);

        // Create an admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'status' => 'approved',
                'role' => 'admin'
            ]
        );
        $admin->assignRole('Admin');
        $admin->givePermissionTo('manage-vendors', 'manage-products', 'manage-categories');

        // Create a vendor user
        $vendor = User::firstOrCreate(
            ['email' => 'vendor@example.com'],
            [
                'name' => 'Vendor User',
                'shop_name' => 'Vendor Shop',
                'shop_address' => '123 Vendor Street, City',
                'phone' => '123-456-7890',
                'password' => Hash::make('password'),
                'status' => 'approved',
                'role' => 'vendor'
            ]
        );
        $vendor->assignRole('Vendor');

        // Create a regular user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'status' => 'approved',
                'role' => 'user'
            ]
        );
        $user->assignRole('User');
    }
}