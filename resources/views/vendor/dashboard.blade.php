@extends('vendor.layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <br>

    <!-- Analytics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Earnings</h3>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">EGP 5,678</p>
                <p class="text-sm text-green-600 dark:text-green-400">+8% this month</p>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full">
                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Pending Orders</h3>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">23</p>
                <p class="text-sm text-yellow-600 dark:text-yellow-400">2 new today</p>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Active Products</h3>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">150</p>
                <p class="text-sm text-blue-600 dark:text-blue-400">10 added this week</p>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full">
                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Sales</h3>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">EGP 12,345</p>
                <p class="text-sm text-green-600 dark:text-green-400">+5% from last month</p>
            </div>
        </div>
    </div>

    
    
@endsection