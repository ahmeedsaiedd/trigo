@extends('home.layouts.app') <!-- Adjust to your frontend layout -->

@section('title', 'Track Order | ' . (\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo'))

@section('content')
    <div class="container min-vh-100 d-flex align-items-center justify-content-center bg-gradient">
        <div class="card border-0 shadow-sm rounded-4 w-100 position-relative overflow-hidden" style="max-width: 30rem;">
            <!-- Awesome Track Order Form -->
            <form action="" method="POST" class="text-center p-5 pt-0">
                @csrf
                <div class="mb-4">
                    <h2 class="h4 fw-bold text-dark mb-1 animate__animated animate__fadeIn">
                        Track Your Order
                    </h2>
                    <p class="text-muted small mb-4">Follow your local treasures’ journey!</p>
                </div>
                <div class="mb-4">
                    <label for="order_id" class="form-label fw-medium text-dark">Order ID</label>
                    <div class="position-relative">
                        <input type="text" id="order_id" name="order_id" class="form-control rounded-pill px-4 py-2 border-light" placeholder="e.g., TRIGO12345" required>
                    </div>
                    @error('order_id')
                        <p class="text-danger small mt-2 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-75 gradient-button rounded-pill shadow-sm mx-auto d-flex align-items-center justify-content-center">
                    <span>Track My Order</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Animate.css for Animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Gradient Background for Page */
        .bg-gradient {
            background: linear-gradient(135deg, #e6f0fa, #d1f2eb, #e2e8f0); /* Light blue-teal-gray */
        }
        @media (prefers-color-scheme: dark) {
            .bg-gradient {
                background: linear-gradient(135deg, #1e3a8a, #0d9488, #1f2937); /* Dark blue-teal-gray */
            }
        }
        /* Gradient Button */
        .gradient-button {
            background: linear-gradient(to right, #007bff, #20c997); /* Same colors */
            color: #000; /* Black text */
            border: none;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }
        .gradient-button:hover {
            background: linear-gradient(to right, #0069d9, #1cb386); /* Darker gradient */
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4); /* Glow effect */
            color: #000;
        }
        /* Card Styling */
        .card {
            background: rgba(255, 255, 255, 0.95); /* Slightly transparent */
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); /* Subtle lift on hover */
        }
        @media (prefers-color-scheme: dark) {
            .card {
                background: rgba(31, 41, 55, 0.95); /* Dark mode gray */
            }
        }
        .z-index-1 { z-index: 1; }
    </style>
@endsection

@section('scripts')
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection