@extends('vendor.dashboard')

@section('title', 'Shop Settings')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Shop Settings</h2>
    <form action="{{ route('vendor.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Business Name</span>
                <input type="text" name="business_name" value="{{ \App\Models\Setting::where('key', 'business_name')->value('value') }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input" required>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Logo</span>
                <input type="file" name="logo" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input">
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Primary Color</span>
                <input type="color" name="primary_color" value="{{ \App\Models\Setting::where('key', 'primary_color')->value('value') ?? '#4f46e5' }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input">
            </label>
        </div>
        <button type="submit" class="px-4 py-2 bg-primary-custom text-white rounded-md">Save Settings</button>
    </form>
@endsection