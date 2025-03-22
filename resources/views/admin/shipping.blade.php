@extends('admin.layouts.app')

@section('title', 'Shipping | Trigo')

@section('content')
<br>
    <div class="container px-6 mx-auto py-8">
        <!-- Heading -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Shipping Dashboard</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Manage and track your shipments with ease!</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Flowbite Dropdown -->
                <div class="relative">
                    <button id="dropdownFilterButton" data-dropdown-toggle="dropdownFilter" class="text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 flex items-center focus:outline-none focus:ring-2 focus:ring-primary-custom">
                        Filter Shipments
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="dropdownFilter" class="z-10 hidden bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownFilterButton">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">All Shipments</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Pending</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Shipped</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Delivered</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Flowbite Button -->
                <button type="button" class="px-4 py-2 bg-primary-custom text-white rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-custom transition-colors duration-150">
                    Export Report
                </button>
            </div>
        </div>

        <!-- Demo Data Setup -->
        <?php
            $totalShipments = 2340;
            $pendingShipments = 145;
            $deliveredShipments = 1892;
            $recentShipments = [
                (object) [
                    'shipment_id' => '#SHP12345',
                    'order_id' => '#ORD12345',
                    'customer_name' => 'John Doe',
                    'destination' => '123 Main St, NY',
                    'status' => 'delivered',
                    'updated_at' => new DateTime('2025-03-19')
                ],
                (object) [
                    'shipment_id' => '#SHP12346',
                    'order_id' => '#ORD12346',
                    'customer_name' => 'Jane Smith',
                    'destination' => '456 Oak Ave, CA',
                    'status' => 'pending',
                    'updated_at' => new DateTime('2025-03-18')
                ],
                (object) [
                    'shipment_id' => '#SHP12347',
                    'order_id' => '#ORD12347',
                    'customer_name' => 'Alex Johnson',
                    'destination' => '789 Pine Rd, TX',
                    'status' => 'shipped',
                    'updated_at' => new DateTime('2025-03-17')
                ],
                (object) [
                    'shipment_id' => '#SHP12348',
                    'order_id' => '#ORD12348',
                    'customer_name' => 'Emily Brown',
                    'destination' => '101 Maple Ln, FL',
                    'status' => 'pending',
                    'updated_at' => new DateTime('2025-03-16')
                ],
                (object) [
                    'shipment_id' => '#SHP12349',
                    'order_id' => '#ORD12349',
                    'customer_name' => 'Michael Lee',
                    'destination' => '202 Birch Dr, WA',
                    'status' => 'delivered',
                    'updated_at' => new DateTime('2025-03-15')
                ]
            ];
        ?>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Shipments -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center hover:shadow-lg transition-shadow duration-200">
                <div class="p-3 bg-blue-500 rounded-full mr-4 flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Shipments</p>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $totalShipments }}</p>
                </div>
            </div>

            <!-- Pending Shipments -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center hover:shadow-lg transition-shadow duration-200">
                <div class="p-3 bg-yellow-500 rounded-full mr-4 flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending Shipments</p>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $pendingShipments }}</p>
                </div>
            </div>

            <!-- Delivered Shipments -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center hover:shadow-lg transition-shadow duration-200">
                <div class="p-3 bg-green-500 rounded-full mr-4 flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Delivered Shipments</p>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $deliveredShipments }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Shipments Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Recent Shipments</h3>
                <a href="{{ url('/admin/shipping/all') }}" class="text-sm text-primary-custom hover:underline">View All</a>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Shipment ID</th>
                            <th scope="col" class="px-6 py-3">Order ID</th>
                            <th scope="col" class="px-6 py-3">Customer</th>
                            <th scope="col" class="px-6 py-3">Destination</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Last Updated</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:divide-gray-700">
                        @foreach ($recentShipments as $shipment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-100">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $shipment->shipment_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $shipment->order_id }}</td>
                                <td class="px-6 py-4">{{ $shipment->customer_name }}</td>
                                <td class="px-6 py-4">{{ $shipment->destination }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $shipment->status === 'delivered' ? 'text-green-800 bg-green-100 dark:text-green-100 dark:bg-green-600' : 
                                           ($shipment->status === 'shipped' ? 'text-blue-800 bg-blue-100 dark:text-blue-100 dark:bg-blue-600' : 
                                           'text-yellow-800 bg-yellow-100 dark:text-yellow-100 dark:bg-yellow-600') }}">
                                        {{ ucfirst($shipment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $shipment->updated_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <a href="#" class="text-primary-custom hover:underline mr-2">Track</a>
                                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:underline">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Flowbite JS -->
    @push('scripts')
        <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    @endpush
    <br>
@endsection