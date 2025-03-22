@extends('home.layouts.app')

@section('title', 'Home - Trigo')

@section('content')
    <style>
        .product-action {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            /* 8px equivalent, using rem for scalability */
        }

        /* Ensure buttons don’t stack and fit inline */
        .btn-product {
            display: inline-block;
            padding: 0.5rem 1rem;
            /* Adjust as needed to match your design */
            text-align: center;
            white-space: nowrap;
            /* Prevents text wrapping */
        }

        /* Style for disabled state */
        .btn-product.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
            /* Prevents clicking entirely */
        }

        /* Dark theme adjustments (if needed) */
        .product-action-dark .btn-product {
            background-color: #333;
            /* Example dark theme */
            color: #fff;
        }

        .product-action-dark .btn-product:hover:not(.disabled) {
            background-color: #555;
            /* Hover state for active buttons */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .product-action {
                gap: 0.25rem;
                /* Smaller gap on mobile */
            }

            .btn-product {
                padding: 0.4rem 0.8rem;
                /* Slightly smaller padding on mobile */
                font-size: 0.9rem;
                /* Adjust text size if needed */
            }
        }

        /* Brands Carousel Styling */
        .brands-carousel .owl-item img {
            width: auto;
            max-height: 100px;
            /* Adjust based on your design */
            margin: 0 auto;
            filter: grayscale(50%);
            /* Optional: adds a subtle effect */
            transition: filter 0.3s ease;
        }

        .brands-carousel .owl-item img:hover {
            filter: grayscale(0%);
            /* Full color on hover */
        }
    </style>
    <main class="main">
        <!-- Intro Section -->
        <div class="intro-section pt-3 pb-3 mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="intro-slider-container slider-container-ratio mb-2 mb-lg-0">
                            <div class="intro-slider owl-carousel owl-simple owl-dark owl-nav-inside" data-toggle="owl"
                                data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "responsive": {
                                    "768": {
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                                <div class="intro-slide">
                                    <figure class="slide-image">
                                        <picture>
                                            <source media="(max-width: 480px)"
                                                srcset="{{ asset('template/assets/images/demos/demo-3/slider/slide-1-480w.jpg') }}">
                                            <img src="{{ asset('template/assets/images/demos/demo-3/slider/slide-1.jpg') }}"
                                                alt="AirPods Earphones" class="img-fluid">
                                        </picture>
                                    </figure>
                                    <div class="intro-content">
                                        <h3 class="intro-subtitle text-primary">Daily Deals</h3>
                                        <h1 class="intro-title">AirPods <br>Earphones</h1>
                                        <div class="intro-price">
                                            <sup>Today:</sup>
                                            <span class="text-primary">700 EGP<sup></sup></span>
                                        </div>
                                        <a href="{{ url('category') }}" class="btn btn-primary btn-round">
                                            <span>Click Here</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="intro-slide">
                                    <figure class="slide-image">
                                        <picture>
                                            <source media="(max-width: 480px)"
                                                srcset="{{ asset('template/assets/images/demos/demo-3/slider/slide-2-480w.jpg') }}">
                                            <img src="{{ asset('template/assets/images/demos/demo-3/slider/slide-2.jpg') }}"
                                                alt="Echo Dot 3rd Gen" class="img-fluid">
                                        </picture>
                                    </figure>
                                    <div class="intro-content">
                                        <h3 class="intro-subtitle text-primary">Deals and Promotions</h3>
                                        <h1 class="intro-title">Echo Dot <br>3rd Gen</h1>
                                        <div class="intro-price">
                                            <sup class="intro-old-price">$49.99</sup>
                                            <span class="text-primary">$29<sup>.99</sup></span>
                                        </div>
                                        <a href="{{ url('category') }}" class="btn btn-primary btn-round">
                                            <span>Click Here</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <span class="slider-loader"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="intro-banners">
                            <div class="banner mb-lg-1 mb-xl-2">
                                <a href="#">
                                    <img src="{{ asset('template/assets/images/demos/demo-3/banners/banner-1.jpg') }}"
                                        alt="Banner">
                                </a>
                                <div class="banner-content">
                                    <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">Top Product</a></h4>
                                    <h3 class="banner-title"><a href="#">Edifier <br>Stereo Bluetooth</a></h3>
                                    <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="banner mb-lg-1 mb-xl-2">
                                <a href="#">
                                    <img src="{{ asset('template/assets/images/demos/demo-3/banners/banner-2.jpg') }}"
                                        alt="Banner">
                                </a>
                                <div class="banner-content">
                                    <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">Clearance</a></h4>
                                    <h3 class="banner-title"><a href="#">GoPro - Fusion 360 <span>Save 299
                                                EGP</span></a>
                                    </h3>
                                    <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="banner mb-0">
                                <a href="#">
                                    <img src="{{ asset('template/assets/images/demos/demo-3/banners/banner-3.jpg') }}"
                                        alt="Banner">
                                </a>
                                <div class="banner-content">
                                    <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">Featured</a></h4>
                                    <h3 class="banner-title"><a href="#">Apple Watch 4 <span>Our Hottest
                                                Deals</span></a></h3>
                                    <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Brands Carousel -->
        <div class="container mb-6">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Featured Brands</h2>
            <div class="brands-carousel owl-carousel owl-simple" data-toggle="owl"
                data-owl-options='{
        "nav": false,
        "dots": false,
        "loop": true,
        "autoplay": true,
        "autoplayTimeout": 3000,
        "responsive": {
            "0": {"items": 2},
            "480": {"items": 3},
            "768": {"items": 4},
            "992": {"items": 5},
            "1200": {"items": 6}
        }
    }'>
                @forelse($brands as $brand)
                    <div class="brand">
                        <a href="{{ url($brand->name) }}"> <!-- Dynamic brand URL -->
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}">
                            <p class="text-center mt-2">{{ $brand->name }}</p>
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 text-center">No brands available.</p>
                @endforelse
            </div>
        </div>


        <!-- Featured Products Section -->
<div class="container featured">
    <!-- Navigation Tabs -->
    <ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="products-featured-link" data-toggle="tab" href="#products-featured-tab" role="tab" aria-controls="products-featured-tab" aria-selected="true">Featured</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="products-sale-link" data-toggle="tab" href="#products-sale-tab" role="tab" aria-controls="products-sale-tab" aria-selected="false">On Sale</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="products-top-link" data-toggle="tab" href="#products-top-tab" role="tab" aria-controls="products-top-tab" aria-selected="false">Top Rated</a>
        </li>
    </ul>

    <!-- Tab Content with Carousel -->
    <div class="tab-content tab-content-carousel">
        <!-- Featured Tab -->
        <div class="tab-pane p-0 fade show active" id="products-featured-tab" role="tabpanel" aria-labelledby="products-featured-link">
            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                "nav": true, 
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {"items": 2},
                    "600": {"items": 2},
                    "992": {"items": 3},
                    "1200": {"items": 4}
                }
            }'>
                @forelse($products->where('is_featured', 1) as $product)
                    <div class="product product-2">
                        <figure class="product-media">
                            <a href="{{ url('product/' . $product->id) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('template/assets/images/demos/demo-3/products/product-1.jpg') }}"
                                    alt="{{ $product->name }}" class="product-image">
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                            </div>
                            <div class="product-action product-action-dark">
                                <a href="#" class="btn-product btn-cart {{ $product->stock > 0 ? '' : 'disabled' }}"
                                    title="Add to Cart" @if ($product->stock <= 0) onclick="return false;" @endif>
                                    <span>Add to Cart</span>
                                </a>
                                <a href="{{ url('popup/quickView/' . $product->id) }}" class="btn-product btn-quickview" data-toggle="modal" data-target="#quickViewModal-{{ $product->id }}" title="Quick view">
                                    <span>Quick View</span>
                                </a>
                            </div>
                        </figure>
                        <div class="product-body">
                            <div class="product-cat"><a href="#">{{ $product->category->name ?? 'Uncategorized' }}</a></div>
                            <h3 class="product-title"><a href="{{ url('product/' . $product->id) }}">{{ $product->name }}</a></h3>
                            <div class="product-price">
                                @if ($product->after_sale_price)
                                    <span class="old-price">{{ number_format($product->price, 2) }} EGP</span>
                                    <span class="new-price">{{ number_format($product->after_sale_price, 2) }} EGP</span>
                                @else
                                    <span class="price">{{ number_format($product->price, 2) }} EGP</span>
                                @endif
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{ $product->rating * 20 }}%;"></div>
                                </div>
                                <span class="ratings-text">( {{ $product->reviews }} Reviews )</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No featured products found.</p>
                @endforelse
            </div>
        </div>

        <!-- On Sale Tab -->
        <div class="tab-pane p-0 fade" id="products-sale-tab" role="tabpanel" aria-labelledby="products-sale-link">
            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                "nav": true, 
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {"items": 2},
                    "600": {"items": 2},
                    "992": {"items": 3},
                    "1200": {"items": 4}
                }
            }'>
                @forelse($products->where('on_sale', 1) as $product)
                    <div class="product product-2">
                        <figure class="product-media">
                            <a href="{{ url('product/' . $product->id) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('template/assets/images/demos/demo-3/products/product-1.jpg') }}"
                                    alt="{{ $product->name }}" class="product-image">
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                            </div>
                            <div class="product-action product-action-dark">
                                <a href="#" class="btn-product btn-cart {{ $product->stock > 0 ? '' : 'opacity-50 cursor-not-allowed' }}"
                                    title="Add to cart" {{ $product->stock > 0 ? '' : 'disabled' }}><span>add to cart</span></a>
                                <a href="{{ url('popup/quickView/' . $product->id) }}" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                            </div>
                        </figure>
                        <div class="product-body">
                            <div class="product-cat"><a href="#">{{ $product->category->name ?? 'Uncategorized' }}</a></div>
                            <h3 class="product-title"><a href="{{ url('product/' . $product->id) }}">{{ $product->name }}</a></h3>
                            <div class="product-price">
                                @if ($product->after_sale_price)
                                    <span class="old-price">{{ number_format($product->price, 2) }} EGP</span>
                                    <span class="new-price">{{ number_format($product->after_sale_price, 2) }} EGP</span>
                                @else
                                    <span class="price">{{ number_format($product->price, 2) }} EGP</span>
                                @endif
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{ $product->rating * 20 }}%;"></div>
                                </div>
                                <span class="ratings-text">( {{ $product->reviews }} Reviews )</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No products on sale found.</p>
                @endforelse
            </div>
        </div>

        <!-- Top Rated Tab -->
        <div class="tab-pane p-0 fade" id="products-top-tab" role="tabpanel" aria-labelledby="products-top-link">
            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                "nav": true, 
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {"items": 2},
                    "600": {"items": 2},
                    "992": {"items": 3},
                    "1200": {"items": 4}
                }
            }'>
                @forelse($products->where('is_top_rated', 1) as $product)
                    <div class="product product-2">
                        <figure class="product-media">
                            <a href="{{ url('product/' . $product->id) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('template/assets/images/demos/demo-3/products/product-1.jpg') }}"
                                    alt="{{ $product->name }}" class="product-image">
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                            </div>
                            <div class="product-action product-action-dark">
                                <a href="#" class="btn-product btn-cart {{ $product->stock > 0 ? '' : 'opacity-50 cursor-not-allowed' }}"
                                    title="Add to cart" {{ $product->stock > 0 ? '' : 'disabled' }}><span>add to cart</span></a>
                                <a href="{{ url('popup/quickView/' . $product->id) }}" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                            </div>
                        </figure>
                        <div class="product-body">
                            <div class="product-cat"><a href="#">{{ $product->category->name ?? 'Uncategorized' }}</a></div>
                            <h3 class="product-title"><a href="{{ url('product/' . $product->id) }}">{{ $product->name }}</a></h3>
                            <div class="product-price">
                                @if ($product->after_sale_price)
                                    <span class="old-price">{{ number_format($product->price, 2) }} EGP</span>
                                    <span class="new-price">{{ number_format($product->after_sale_price, 2) }} EGP</span>
                                @else
                                    <span class="price">{{ number_format($product->price, 2) }} EGP</span>
                                @endif
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{ $product->rating * 20 }}%;"></div>
                                </div>
                                <span class="ratings-text">( {{ $product->reviews }} Reviews )</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No top-rated products found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    /* Ensure all product cards are the same size */
    .product-2 {
        display: flex;
        flex-direction: column;
        height: 100%; /* Ensure full height usage */
        overflow: hidden; /* Prevent overflow */
    }

    .product-media {
        position: relative;
        width: 100%;
        height: 250px; /* Fixed height for images */
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure images scale uniformly */
    }

    .product-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
    }

    .product-title {
        font-size: 1.1rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap; /* Prevent title from wrapping and affecting height */
    }

    .product-price {
        font-size: 1rem;
        margin: 5px 0;
        display: flex;
        align-items: center;
        gap: 0.5rem; /* Space between old and new prices */
    }

    .old-price {
        color: red; /* Red text for old price */
        text-decoration: line-through; /* Strikethrough */
        font-size: 0.9rem; /* Slightly smaller for old price */
    }

    .new-price {
        font-weight: bold; /* Bold for sale price */
        color: #333; /* Default color, adjust if needed */
    }

    .price {
        color: #333; /* Consistent color for non-sale price */
    }

    .ratings-container {
        margin-top: auto; /* Push ratings to the bottom */
    }

    /* Ensure carousel items are uniform */
    .owl-carousel .owl-item {
        display: flex;
        flex-direction: column;
    }

    .owl-carousel .owl-item .product-2 {
        width: 100%;
    }
</style>
    </main>
@endsection
