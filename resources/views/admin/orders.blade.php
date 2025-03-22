@extends('admin.layouts.app')

@section('title', 'Orders | Trigo')

@section('content')
<br>
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-300">Orders Management</h1>
            <button id="exportExcel" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-green-700">
                Export to Excel
            </button>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <!-- Tabs Navigation -->
        <div class="border-b dark:border-gray-700 mb-6">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                @foreach(['all' => 'All', 'pending' => 'Pending', 'confirmed' => 'Confirmed', 'out_for_delivery' => 'Out for Delivery', 'delivered' => 'Delivered', 'returned' => 'Returned', 'failed_to_deliver' => 'Failed to Deliver', 'cancelled' => 'Cancelled'] as $status => $label)
                    <li class="mr-2">
                        <button class="tab-button inline-block p-4 rounded-t-lg border-b-2 {{ $loop->first ? 'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-500 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}"
                            data-tab="{{ $status }}">{{ $label }}</button>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Tabs Content -->
        <div class="overflow-x-auto">
            @foreach(['all', 'pending', 'confirmed', 'out_for_delivery', 'delivered', 'returned', 'failed_to_deliver', 'cancelled'] as $status)
                <div class="tab-content {{ $loop->first ? '' : 'hidden' }}" id="{{ $status }}">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="py-3 px-4 text-gray-600 dark:text-gray-400">Order ID</th>
                                <th class="py-3 px-4 text-gray-600 dark:text-gray-400">Customer</th>
                                <th class="py-3 px-4 text-gray-600 dark:text-gray-400">Amount</th>
                                <th class="py-3 px-4 text-gray-600 dark:text-gray-400">Status</th>
                                <th class="py-3 px-4 text-gray-600 dark:text-gray-400">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-4 text-gray-800 dark:text-gray-200">#12345</td>
                                <td class="py-3 px-4 text-gray-800 dark:text-gray-200">John Doe</td>
                                <td class="py-3 px-4 text-gray-800 dark:text-gray-200">EGP 150.00</td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-1 text-sm rounded-full 
                                        {{ ($status === 'all' || $status === 'delivered') ? 'text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900' : 
                                          ($status === 'pending' ? 'text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900' : 
                                          ($status === 'confirmed' ? 'text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900' : 
                                          ($status === 'out_for_delivery' ? 'text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-900' : 
                                          'text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900'))) }}">
                                        {{ ucfirst(str_replace('_', ' ', $status === 'all' ? 'delivered' : $status)) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-800 dark:text-gray-200">Mar 15, 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
    <script>
        // Tab switching
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                const tab = this.getAttribute('data-tab');
                
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('border-blue-600', 'text-blue-600', 'dark:border-blue-500', 'dark:text-blue-500', 'active');
                    btn.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                });
                this.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                this.classList.add('border-blue-600', 'text-blue-600', 'dark:border-blue-500', 'dark:text-blue-500', 'active');

                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(tab).classList.remove('hidden');
            });
        });

        // Excel export
        document.getElementById('exportExcel').addEventListener('click', function() {
            const activeTab = document.querySelector('.tab-button.active').getAttribute('data-tab');
            const table = document.getElementById(activeTab).querySelector('table');
            let csv = [];
            
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent);
            csv.push(headers.join(','));

            table.querySelectorAll('tbody tr').forEach(row => {
                const cells = Array.from(row.querySelectorAll('td')).map(td => {
                    const text = td.textContent.trim();
                    return text.includes(',') ? `"${text}"` : text;
                });
                csv.push(cells.join(','));
            });

            const csvContent = csv.join('\n');
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `orders_${activeTab}_${new Date().toISOString().split('T')[0]}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        });
    </script>
    @endpush
@endsection