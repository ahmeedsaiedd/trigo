@extends('home.layouts.app')

@section('title', 'Vendor Registration - Trigo')

@section('content')
<main class="main">
    <div class="container featured">
        @if (session('success'))
            <div class="d-none" id="success-message">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('vendor.register.store') }}" method="POST" class="product-2" enctype="multipart/form-data">
                    @csrf
                    <div class="product-body">
                        <h3 class="mb-3">Shop Information</h3>
                        <div class="form-group">
                            <label for="shop_name">Shop Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ old('shop_name') }}" required>
                            @error('shop_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_address">Shop Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="shop_address" name="shop_address" rows="3" required>{{ old('shop_address') }}</textarea>
                            @error('shop_address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_logo">Shop Logo</label>
                            <input type="file" class="form-control-file" id="shop_logo" name="shop_logo" accept="image/*">
                            @error('shop_logo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        @guest
                            <h3 class="mb-3 mt-4">Owner Information</h3>
                            <div class="form-group">
                                <label for="name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @endguest

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                <label class="custom-control-label" for="terms">I agree to the <a href="#" class="text-primary">terms and conditions</a></label>
                                @error('terms') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: successMessage.textContent,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#28a745',
                    color: '#fff',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            }
        });
    </script>
@endsection