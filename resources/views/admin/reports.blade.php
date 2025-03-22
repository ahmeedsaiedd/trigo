@extends('admin.layouts.app')

@section('title', 'Reports | ' . (\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo'))

@section('content')
    <div class="mb-8">
        
    </div>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
        <!-- Sales Summary Card -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Sales Summary</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Total sales this month</p>
            <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-gray-100">$12,345</p>
            <p class="mt-2 text-sm text-green-600 dark:text-green-400">+15% from last month</p>
        </div>

        <!-- Vendor Performance Card -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Top Vendor</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Highest sales this month</p>
            <p class="mt-1 text-xl font-bold text-gray-800 dark:text-gray-100">Vendor A</p>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">$4,500 in sales</p>
        </div>

        <!-- Customer Activity Card -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Customer Activity</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">New customers this month</p>
            <p class="mt-1 text-3xl font-bold text-gray-800 dark:text-gray-100">87</p>
            <p class="mt-2 text-sm text-green-600 dark:text-green-400">+10% from last month</p>
        </div>
    </div>

    <!-- Sales Trend Chart -->
    <div class="mb-8 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Sales Trend (Last 6 Months)</h3>
        <canvas id="salesChart" class="mt-4"></canvas>
    </div>

    <!-- Detailed Reports Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="p-6 bg-white dark:bg-gray-800">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Detailed Sales Report</h3>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                    <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Order ID</th>
                            <th class="px-6 py-3">Vendor</th>
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Amount</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">2025-03-01</td>
                            <td class="px-6 py-4">#ORD12345</td>
                            <td class="px-6 py-4">Vendor A</td>
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">$250.00</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Completed</span></td>
                        </tr>
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">2025-03-02</td>
                            <td class="px-6 py-4">#ORD12346</td>
                            <td class="px-6 py-4">Vendor B</td>
                            <td class="px-6 py-4">Jane Smith</td>
                            <td class="px-6 py-4">$175.50</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">Pending</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">2025-03-03</td>
                            <td class="px-6 py-4">#ORD12347</td>
                            <td class="px-6 py-4">Vendor A</td>
                            <td class="px-6 py-4">Mike Johnson</td>
                            <td class="px-6 py-4">$320.75</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Oct 2024', 'Nov 2024', 'Dec 2024', 'Jan 2025', 'Feb 2025', 'Mar 2025'],
                    datasets: [{
                        label: 'Sales ($)',
                        data: [5000, 6200, 5800, 7500, 8200, 12345],
                        borderColor: 'var(--primary-color)', // Use dynamic primary color
                        backgroundColor: 'rgba(79, 70, 229, 0.2)', // Fallback to indigo with transparency
                        fill: true,
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#6b7280' }, // Gray-600
                            grid: { color: '#e5e7eb' } // Gray-200
                        },
                        x: {
                            ticks: { color: '#6b7280' },
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { labels: { color: '#374151' } } // Gray-700
                    }
                }
            });
        });
    </script>
@endsection