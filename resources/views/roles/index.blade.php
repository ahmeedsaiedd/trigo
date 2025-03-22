@extends('admin.layouts.app')
@section('title', 'Roles | Trigo')
@section('content')
<div class="container-fluid px-4 py-6">
    <div class="bg-white dark:bg-gray-800 p-4 rounded divide-y divide-gray-200 dark:divide-gray-700">
        <div class="pb-4">
            <h1 class="text-xl font-medium mb-3">Navigation</h1>
            <div class="flex gap-3">
                <a href="{{ route('users.index') }}" class="border border-gray-600 px-3 py-1 rounded">Users</a>
                <a href="{{ route('permissions.index') }}" class="border border-gray-600 px-3 py-1 rounded">Permissions</a>
            </div>
        </div>
        <div class="py-4">
            <h1 class="text-xl font-medium mb-3">Create Role</h1>
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="block">Role Name</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-3">
                    <label class="block">Permissions</label>
                    <select name="permissions[]" class="w-full border rounded select2" multiple>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full bg-gray-800 text-white rounded p-2">Save</button>
            </form>
        </div>
        <div class="pt-4">
            <h1 class="text-xl font-medium mb-3">Roles</h1>
            @if ($roles->isEmpty())
                <p class="text-gray-500 text-center py-4">No roles found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-gray-700 font-medium">Role Name</th>
                                <th class="px-6 py-3 text-left text-gray-700 font-medium">Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-3 text-gray-800 dark:text-gray-200">{{ $role->name }}</td>
                                    <td class="px-6 py-3 text-gray-800 dark:text-gray-200">{{ $role->permissions->pluck('name')->join(', ') ?: 'None' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('scripts')
<script>
    $(document).ready(function() { $('#permissions').select2({ placeholder: "Select permissions", width: '100%' }); });
</script>
@endsection