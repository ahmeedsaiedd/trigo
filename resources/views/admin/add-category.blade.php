@extends('admin.layouts.app')

@section('title', 'Add Category | Trigo')

@section('content')
    <div class="container px-6 mx-auto py-8">
        <br>
        <!-- Heading -->
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Add New Category</h1>

        <!-- Form -->
        <form action="{{ route('admin.categories.store') }}" method="POST" class="max-w-md bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Category Name
                </label>
                <input type="text" name="name" id="name" placeholder="Enter category name"
                    class="w-80 px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary-custom focus:border-primary-custom focus:outline-none dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-primary-custom text-white font-semibold rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-custom transition-colors duration-150">
                    Save Category
                </button>
            </div>
        </form>
    </div>
@endsection