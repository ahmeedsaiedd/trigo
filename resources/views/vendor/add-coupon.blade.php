@extends('vendor.dashboard')

@section('title', 'Add Coupon')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Add Coupon</h2>
    <form action="{{ route('vendor.coupons.store') }}" method="POST" class="p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        @csrf
        <div class="mb-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Coupon Code</span>
                <input type="text" name="code" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input" required>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Discount (%)</span>
                <input type="number" name="discount" max="100" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input" required>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Expiry Date</span>
                <input type="date" name="expiry_date" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input" required>
            </label>
        </div>
        <button type="submit" class="px-4 py-2 bg-primary-custom text-white rounded-md">Save Coupon</button>
    </form>
@endsection