@extends('admin.layouts.app')

@section('title', 'All Products | Trigo')

@section('content')
    <div class="mb-8">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">All Products</h2>
        <p class="text-gray-600 dark:text-gray-400">Manage your products here.</p>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
    @endif

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">SKU</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Stock</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($products as $product)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $product->sku }}</td>
                            <td class="px-4 py-3 text-sm">${{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-3 text-sm">{{ $product->category->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ ucfirst($product->status) }}</td>
                            <td class="px-4 py-3 text-sm">{{ $product->stock }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $products->links() }}</div>
    </div>
@endsection