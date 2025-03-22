@extends('home.layouts.app') <!-- Adjust to your frontend layout -->

@section('title', 'About Us | ' . (\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo'))

@section('content')
    <!-- Additional Section: Our Story -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 md:pl-10">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">Our Story</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Born from a love for our community, {{ \App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo' }} started with a simple idea: to bring the best of local fashion and food to your doorstep. We partner with talented artisans and small-scale producers who pour their hearts into every stitch and every bite.
                </p>
                <p class="text-gray-600 dark:text-gray-300">
                    From handwoven textiles to farm-fresh delicacies, we’re here to celebrate the richness of our local culture and support the hands that make it possible.
                </p>
            </div>
        </div>
    </section>

    
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .bg-wave-pattern {
            background-image: url('{{ asset('images/wave-pattern.svg') }}');
        }
        .drop-shadow-lg {
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
        }
        /* Footer fixed styles (temporary, move to layout) */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        /* Ensure content doesn’t overlap footer */
        body {
            padding-bottom: 100px; /* Adjust based on footer height */
        }
    </style>
@endsection