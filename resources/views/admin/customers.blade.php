@extends('admin.layouts.app')

@section('title', 'Customers | ' . (\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo'))

@section('content')
    <div class="mb-8">
        
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="p-6 bg-white dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                    <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $user->id }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if(isset($user->role))
                                        @if($user->role === 'Customer')
                                            <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full dark:bg-blue-700 dark:text-blue-100">Customer</span>
                                        @elseif($user->role === 'Vendor')
                                            <span class="px-2 py-1 text-xs font-semibold bg-purple-100 text-purple-800 rounded-full dark:bg-purple-700 dark:text-purple-100">Vendor</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full dark:bg-gray-700 dark:text-gray-100">{{ $user->role }}</span>
                                        @endif
                                    @elseif(method_exists($user, 'hasRole') && $user->hasRole('Customer'))
                                        <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full dark:bg-blue-700 dark:text-blue-100">Customer</span>
                                    @elseif(method_exists($user, 'hasRole') && $user->hasRole('Vendor'))
                                        <span class="px-2 py-1 text-xs font-semibold bg-purple-100 text-purple-800 rounded-full dark:bg-purple-700 dark:text-purple-100">Vendor</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full dark:bg-gray-700 dark:text-gray-100">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($user->status))
                                        @if($user->status === 'Active')
                                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full dark:bg-green-700 dark:text-green-100">Active</span>
                                        @elseif($user->status === 'Inactive')
                                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full dark:bg-red-700 dark:text-red-100">Inactive</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full dark:bg-gray-700 dark:text-gray-100">{{ $user->status }}</span>
                                        @endif
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full dark:bg-gray-700 dark:text-gray-100">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endsection