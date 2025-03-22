<!-- resources/views/home/vendor-register.blade.php -->
@extends('home.layouts.app')

@section('title', 'Vendor Registration - Trigo')

@section('content')
<main class="main">
    <!-- Registration Form Section -->
    <div class="container featured">
        <h2 class="text-center mb-4">Become a Seller</h2>
        @if (session('success'))
            <!-- This will trigger the toast via JavaScript -->
            <div class="d-none" id="success-message">{{ session('success') }}</div>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('vendor.register.submit') }}" method="POST" class="product-2" enctype="multipart/form-data">
                    @csrf
                    <div class="product-body">
                        <!-- Shop Information -->
                        <h3 class="mb-3">Shop Information</h3>
                        <div class="form-group">
                            <label for="shop_name">Shop Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="shop_name" name="shop_name" required>
                        </div>
                        <div class="form-group">
                            <label for="shop_address">Shop Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="shop_address" name="shop_address" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="shop_logo">Shop Logo</label>
                            <input type="file" class="form-control-file" id="shop_logo" name="shop_logo" accept="image/*">
                        </div>

                        <!-- Owner Information -->
                        <h3 class="mb-3 mt-4">Owner Information</h3>
                        <div class="form-group">
                            <label for="name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                <label class="custom-control-label" for="terms">I agree to the <a href="#" class="text-primary">terms and conditions</a></label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="product-action product-action-dark text-center">
                            <button type="submit" class="btn btn-product btn-cart btn-primary btn-round btn-lg shadow-sm animate__animated animate__pulse animate__infinite" style="display: inline-block; visibility: visible;">
                                <span class="font-weight-bold">Register Now</span>
                                <i class="icon-long-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there's a success message from the session
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                Swal.fire({
                    toast: true,
                    position: 'top-end', // Top-right corner
                    icon: 'success',
                    title: successMessage.textContent,
                    showConfirmButton: false,
                    timer: 3000, // Auto-close after 3 seconds
                    timerProgressBar: true,
                    background: '#28a745', // Green background
                    color: '#fff', // White text
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            }
        });
    </script>