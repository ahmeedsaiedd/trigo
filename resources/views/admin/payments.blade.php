@extends('admin.layouts.app')

@section('title', 'Payments | Trigo')

@section('content')
<br>
    <div class="container px-6 mx-auto py-8">
        <!-- Heading -->
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Payments Overview</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-3 gap-6 mb-8 w-full">
            <!-- Total Payments -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center min-w-0 hover:shadow-lg transition-shadow duration-200">
                <div class="p-3 bg-primary-custom rounded-full mr-4 flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Payments</h3>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">$12,345.67</p>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center min-w-0 hover:shadow-lg transition-shadow duration-200">
                <div class="p-3 bg-yellow-500 rounded-full mr-4 flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Payments</h3>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">$1,234.56</p>
                </div>
            </div>

            <!-- Completed Payments -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center min-w-0 hover:shadow-lg transition-shadow duration-200">
                <div class="p-3 bg-green-500 rounded-full mr-4 flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Completed Payments</h3>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">$11,111.11</p>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Recent Transactions</h2>
                <a href="#" class="text-sm text-primary-custom hover:underline">View All</a>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th class="px-6 py-3">Transaction ID</th>
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Amount</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:divide-gray-700 text-gray-700 dark:text-gray-400">
                        <!-- Sample Row 1 -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-100">
                            <td class="px-6 py-4">#TX123456</td>
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">$250.00</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-600">Completed</span>
                            </td>
                            <td class="px-6 py-4">Mar 19, 2025</td>
                        </tr>
                        <!-- Sample Row 2 -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-100">
                            <td class="px-6 py-4">#TX123457</td>
                            <td class="px-6 py-4">Jane Smith</td>
                            <td class="px-6 py-4">$99.99</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full dark:text-yellow-100 dark:bg-yellow-600">Pending</span>
                            </td>
                            <td class="px-6 py-4">Mar 18, 2025</td>
                        </tr>
                        <!-- Sample Row 3 -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-100">
                            <td class="px-6 py-4">#TX123458</td>
                            <td class="px-6 py-4">Alex Johnson</td>
                            <td class="px-6 py-4">$1,500.00</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-600">Completed</span>
                            </td>
                            <td class="px-6 py-4">Mar 17, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
@endsection