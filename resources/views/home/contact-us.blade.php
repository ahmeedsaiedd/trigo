@extends('home.layouts.app') <!-- Adjust to your frontend layout -->

@section('title', 'Contact Us | ' . (\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo'))

@section('content')
    <div class="container min-vh-100 d-flex align-items-center justify-content-center bg-gradient py-4">
        <div class="card border-0 shadow-lg rounded-4 w-100" style="max-width: 36rem;">
            <div class="card-body p-5">
                <!-- Awesome Contact Us Form -->
                <form action="" method="POST" class="text-center">
                    @csrf
                    <div class="mb-4">
                        <h2 class="h3 fw-bold text-dark mb-2 animate__animated animate__fadeIn">
                            Get in Touch
                        </h2>
                        <p class="text-muted small mb-4">
                            Have questions or want to connect? We’d love to hear from you about our local fashion and food!
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium text-dark">Your Name</label>
                        <input type="text" id="name" name="name" class="form-control rounded-pill px-4 py-2" placeholder="e.g., John Doe" required>
                        @error('name')
                            <p class="text-danger small mt-2 animate__animated animate__shakeX">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium text-dark">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control rounded-pill px-4 py-2" placeholder="e.g., john@example.com" required>
                        @error('email')
                            <p class="text-danger small mt-2 animate__animated animate__shakeX">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="message" class="form-label fw-medium text-dark">Your Message</label>
                        <textarea id="message" name="message" class="form-control rounded-3 px-4 py-2" rows="4" placeholder="Tell us how we can help..." required></textarea>
                        @error('message')
                            <p class="text-danger small mt-2 animate__animated animate__shakeX">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-75 gradient-button rounded-pill shadow-sm mx-auto d-flex align-items-center justify-content-center">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </form>
            </div>
            <!-- Optional Contact Info -->
            <div class="card-footer text-center bg-transparent border-0 py-3">
                <p class="text-muted small mb-0">
                    Or reach us at: <a href="mailto:support@{{ strtolower(\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'trigo') }}.com" class="text-primary">support@{{ strtolower(\App\Models\Setting::where('key', 'business_name')->value('value') ?? 'trigo') }}.com</a>
                </p>
            </div>
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
            background: linear-gradient(to right, #007bff, #20c997); /* Blue to teal */
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
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); /* Lift on hover */
        }
        @media (prefers-color-scheme: dark) {
            .card {
                background: rgba(31, 41, 55, 0.95); /* Dark mode gray */
            }
        }
    </style>
@endsection

@section('scripts')
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection