@extends('layouts.app') <!-- Assuming a frontend layout like 'layouts.app' -->

@section('title', 'Wishlist | ' . (\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo'))

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Your Wishlist</h2>
                <p class="text-gray-600 dark:text-gray-400">View and manage items you’ve added to your wishlist.</p>
            </div>
            <!-- Wishlist Icon from Your Snippet -->
            <div class="wishlist">
                <a href="{{ route('home.wishlist') }}" title="Wishlist" class="flex flex-col items-center">
                    <div class="icon relative">
                        <i class="icon-heart-o text-2xl text-gray-600 dark:text-gray-400"></i>
                        <span class="wishlist-count badge absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $wishlistCount ?? 0 }}
                        </span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mt-1">Wishlist</p>
                </a>
            </div><!-- End .wishlist -->
        </div>

        <!-- Wishlist Items Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="p-6 bg-white dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Product Name</th>
                                <th class="px-6 py-3">Price</th>
                                <th class="px-6 py-3">Added On</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wishlistItems as $item)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('product.show', $item->product->id) }}" class="text-blue-600 hover:underline dark:text-blue-400">
                                            {{ $item->product->name ?? 'N/A' }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">${{ number_format($item->product->price ?? 0, 2) }}</td>
                                    <td class="px-6 py-4">{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to remove this item?')">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Your wishlist is empty.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $wishlistItems->links() }}
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .icon-heart-o:before {
            content: "\f08a"; /* FontAwesome heart outline unicode */
            font-family: "FontAwesome"; /* Ensure FontAwesome is loaded in your layout */
        }
    </style>
@endsection