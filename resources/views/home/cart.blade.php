@extends('layouts.app') <!-- Adjust to your frontend layout -->

@section('title', 'Cart | ' . (\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo'))

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Your Cart</h2>
                <p class="text-gray-600 dark:text-gray-400">Review items in your shopping cart.</p>
            </div>
            <!-- Cart Icon Snippet -->
            <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" data-display="static">
                <div class="icon relative">
                    <i class="icon-shopping-cart text-2xl text-gray-600 dark:text-gray-400"></i>
                    <span class="cart-count absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $cartCount ?? 0 }}
                    </span>
                </div>
                <p class="text-gray-700 dark:text-gray-300">Cart</p>
            </a>
        </div>

        <!-- Cart Items Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="p-6 bg-white dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Product Name</th>
                                <th class="px-6 py-3">Price</th>
                                <th class="px-6 py-3">Quantity</th>
                                <th class="px-6 py-3">Total</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartItems as $key => $item)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $item['name'] ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">${{ number_format($item['price'] ?? 0, 2) }}</td>
                                    <td class="px-6 py-4">{{ $item['quantity'] ?? 1 }}</td>
                                    <td class="px-6 py-4">${{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.remove', $key) }}" method="POST" class="inline">
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
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Your cart is empty.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Cart Summary (Optional) -->
        @if(!empty($cartItems))
            <div class="mt-6 flex justify-end">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Cart Total</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Subtotal: ${{ number_format(collect($cartItems)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1)), 2) }}
                    </p>
                    <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Proceed to Checkout</button>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .icon-shopping-cart:before {
            content: "\f07a"; /* FontAwesome shopping cart unicode */
            font-family: "FontAwesome"; /* Ensure FontAwesome is loaded */
        }
    </style>
@endsection