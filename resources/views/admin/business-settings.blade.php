@extends('admin.layouts.app')

@section('title', 'Business Settings | Trigo')

@section('content')
<br>
    <div class="container px-6 mx-auto py-8">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Business Settings</h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg dark:bg-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.business-settings.update') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="business_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Business Name</label>
                <input type="text" name="business_name" id="business_name" value="{{ $settings['business_name'] }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-custom focus:border-primary-custom dark:bg-gray-700 dark:text-gray-100" required>
            </div>

            <div class="mb-4">
                <label for="shipping_carrier" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Shipping Carrier</label>
                <input type="text" name="shipping_carrier" id="shipping_carrier" value="{{ $settings['shipping_carrier'] }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-custom focus:border-primary-custom dark:bg-gray-700 dark:text-gray-100" required>
            </div>

            <div class="mb-4">
                <label for="warehouse_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warehouse Location</label>
                <input type="text" name="warehouse_location" id="warehouse_location" value="{{ $settings['warehouse_location'] }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-custom focus:border-primary-custom dark:bg-gray-700 dark:text-gray-100" required>
            </div>

            <button type="submit" class="px-4 py-2 bg-primary-custom text-white rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-custom transition-colors duration-150">
                Update Settings
            </button>
        </form>
    </div>
@endsection