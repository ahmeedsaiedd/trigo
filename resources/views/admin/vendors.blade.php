@extends('admin.layouts.app')

@section('title', 'Vendors | Trigo')

@section('content')
<br>
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-300">Vendors Management</h1>
            <button id="exportExcel" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Export to Excel
            </button>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <!-- Tabs Navigation -->
        <div class="border-b dark:border-gray-700 mb-6 bg-gray-50 dark:bg-gray-800 px-4 py-2">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                @foreach(['approved' => 'Approved', 'pending' => 'Pending', 'rejected' => 'Rejected'] as $status => $label)
                    <li class="mr-2">
                        <button class="tab-button inline-block p-4 rounded-t-lg border-b-2 {{ $loop->first ? 'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-500 active' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}"
                            data-tab="{{ $status }}">{{ $label }}</button>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Tabs Content -->
        @foreach(['approved', 'pending', 'rejected'] as $status)
            <div class="tab-content {{ $loop->first ? '' : 'hidden' }}" id="{{ $status }}">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Vendor</th>
                                <th class="px-4 py-3">Shop Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Actions</th>
                                <th class="px-4 py-3">Registered</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($vendors->where('status', $status) as $vendor)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="{{ $vendor->shop_logo ? asset('storage/' . $vendor->shop_logo) : 'https://via.placeholder.com/150' }}"
                                                    alt="{{ $vendor->name }}" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{ $vendor->name }}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $vendor->phone }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $vendor->shop_name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $vendor->email }}</td>
                                    <td class="px-4 py-3 text-xs">
                                        <span class="status-badge px-2 py-1 font-semibold leading-tight rounded-full 
                                            {{ $vendor->status === 'approved' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 
                                               ($vendor->status === 'rejected' ? 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' : 
                                                'text-orange-700 bg-orange-100 dark:bg-orange-600 dark:text-white') }}">
                                            {{ ucfirst($vendor->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex space-x-2">
                                            <form action="{{ route('admin.vendors.update-status', $vendor->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit"
                                                    class="px-3 py-1 text-white bg-blue-600 rounded-md hover:bg-green-700 focus:outline-none focus:shadow-outline-green {{ $vendor->status === 'approved' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    {{ $vendor->status === 'approved' ? 'disabled' : '' }}>
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.vendors.update-status', $vendor->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit"
                                                    class="px-3 py-1 text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:shadow-outline-red {{ $vendor->status === 'rejected' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    {{ $vendor->status === 'rejected' ? 'disabled' : '' }}>
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $vendor->created_at->format('m/d/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">No {{ $status }} vendors found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <span class="flex items-center col-span-3">
                        Showing {{ $vendors->where('status', $status)->first() ? $vendors->perPage() * ($vendors->currentPage() - 1) + 1 : 0 }}-{{ $vendors->where('status', $status)->count() + ($vendors->perPage() * ($vendors->currentPage() - 1)) }} of {{ $vendors->where('status', $status)->count() }}
                    </span>
                    <span class="col-span-2"></span>
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        {{ $vendors->links() }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 is not loaded!');
                return;
            }

            // Success Popup
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#28a745',
                    background: '#f0fdf4',
                    color: '#166534'
                });
            @endif

            // Error Popup
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#dc3545',
                    background: '#fef2f2',
                    color: '#991b1b'
                });
            @endif

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
                a.download = `vendors_${activeTab}_${new Date().toISOString().split('T')[0]}.csv`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            });
        });
    </script>
@endpush