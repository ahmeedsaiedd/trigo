@extends('admin.layouts.app')
@section('title', 'Create Permission | Trigo')
@section('content')
<div class="container-fluid">
    <!-- Navigation Options -->

    <!-- Create Permission Form -->
    <div class="card mt-6">
        <h1 class="text-center text-xl font-semibold text-gray-900 mb-6">Create Permission</h1>
        <form method="POST" action="{{ route('permissions.store') }}">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2" for="name">Permission Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:outline-none transition duration-200" placeholder="Enter Permission Name" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn-custom w-full px-4 py-2 rounded-lg">Save</button>
        </form>
    </div>

    <!-- Permissions Table with Pagination -->
    <div class="mt-6">
        <h1 class="text-xl font-semibold text-gray-900 mb-4">Permissions</h1>
        @if ($permissions->isEmpty())
            <p class="text-gray-500 text-center py-4">No permissions found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700 font-medium">Permission Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 text-gray-800">{{ $permission->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            <div class="mt-6 flex justify-center">
                {{ $permissions->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Custom Styles -->
<style>
    .container-fluid {
        padding: 24px;
    }
    .card {
        width: 100%;
        padding: 24px;
        border-radius: 12px;
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .btn-custom {
        background-color: #4b5563;
        color: #ffffff;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .btn-custom:hover {
        background-color: #6b7280;
        transform: translateY(-2px);
    }
    input:focus {
        box-shadow: 0 0 0 3px rgba(107, 114, 128, 0.2);
        border-color: #6b7280;
    }
    table tr:hover {
        background-color: #f9fafb;
        transition: background-color 0.2s ease;
    }
    th, td {
        border-color: #e5e7eb;
    }
</style>
@endsection