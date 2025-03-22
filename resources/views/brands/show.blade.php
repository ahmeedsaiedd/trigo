@extends('home.layouts.app')

@section('title', $brandData->name)

@section('content')

<div class="container">
    <h1 class="text-3xl font-bold text-gray-800">{{ $brandData->name }}</h1>
    <p class="mt-4">More information about {{ $brandData->name }}...</p>

    <!-- Products Section -->
    <h2 class="text-2xl font-bold text-gray-800 mt-6">Products from {{ $brandData->name }}</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
        @forelse($products as $product)
            <div class="border rounded-lg p-4 shadow-md">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover">
                <h3 class="text-lg font-semibold mt-2">{{ $product->name }}</h3>
                <p class="text-gray-600 mt-1">{{ $product->price }} EGP</p>
                <a href="{{ route('product.show', $product->id) }}" class="text-blue-500 mt-2 inline-block">View Product</a>
            </div>
        @empty
            <p class="text-gray-500">No products available for this brand.</p>
        @endforelse
    </div>
</div>

@endsection