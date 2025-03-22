@extends('vendor.dashboard')

@section('title', 'Orders')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Orders</h2>
    <div class="mb-6">
        <div class="flex flex-wrap border-b border-gray-200 dark:border-gray-700">
            @foreach(['all', 'pending', 'confirmed', 'out-for-delivery', 'delivered', 'returned', 'failed-to-deliver', 'canceled'] as $tab)
                <button class="px-4 py-2 text-sm font-medium {{ request()->query('tab', 'all') === $tab ? 'border-b-2 border-primary-custom text-primary-custom' : 'text-gray-500' }} focus:outline-none" onclick="window.location.href='{{ route('vendor.orders', ['tab' => $tab]) }}'">{{ ucfirst(str_replace('-', ' ', $tab)) }}</button>
            @endforeach
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Order ID</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($orders as $order)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">{{ $order->id }}</td>
                            <td class="px-4 py-3">{{ $order->customer_name }}</td>
                            <td class="px-4 py-3">${{ $order->total }}</td>
                            <td class="px-4 py-3">{{ ucfirst(str_replace('-', ' ', $order->status)) }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('vendor.orders.show', $order->id) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection