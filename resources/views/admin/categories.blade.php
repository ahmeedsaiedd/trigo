@extends('admin.layouts.app')

@section('title', 'All Categories | Trigo')

@section('content')
<br>
    <div class="container px-6 mx-auto py-8">
        <!-- Heading -->
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">All Categories</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Categories Table -->
        <div class="w-full bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:divide-gray-700 text-gray-700 dark:text-gray-400">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-100">
                                <td class="px-6 py-4">{{ $category->id }}</td>
                                <td class="px-6 py-4">{{ $category->name }}</td>
                                <td class="px-6 py-4">{{ $category->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No categories found. Add one to get started!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection