@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="card shadow-lg p-4">
                <div class="text-center mb-3">
                    <h3 class="fw-bold">Login</h3>
                    <p class="text-muted">Welcome back! Please enter your details.</p>
                </div>
                <div class="card-body p-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Enter your email">
                            </div>
                            @error('email') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Enter your password">
                                <span class="input-group-text">
                                    <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                            @error('password') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <!-- Login Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Login</button>
                        </div>

                        <!-- Forgot Password & Register -->
                        <div class="text-center mt-3">
                            <a href="#" class="text-decoration-none text-primary fw-bold d-block">Forgot Your Password?</a>
                            <p class="mt-2">
                                Don't have an account? 
                                <a href="{{ route('auth.register') }}" class="text-decoration-none text-primary fw-bold">Register here</a>
                                {{-- <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-bold">Register here</a> --}}
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                passwordInput.type = 'password';
                this.classList.replace('bi-eye', 'bi-eye-slash');
            }
        });
    </script>
@endsection