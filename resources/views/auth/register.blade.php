<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.navbar')
    <div class="container d-flex justify-content-center align-items-center"
        style="">
        <div class="col-md-6">
            <div class="card p-4 shadow-lg border-0 rounded-lg">
                <div class="text-center">
                    <h3 class="fw-bold text-primary">{{ __('Register') }}</h3>
                    <p class="text-muted">Create a new account</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus placeholder="Enter your name">
                            </div>
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required placeholder="Enter your email">
                            </div>
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required placeholder="Enter your password">
                                <span class="input-group-text">
                                    <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required placeholder="Confirm your password">
                            </div>
                        </div>

                        <!-- Register Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                {{ __('Register') }}
                            </button>
                        </div>

                        <!-- Already have an account? -->
                        <div class="text-center mt-3">
                            <p class="switch-link">Already have an account?
                                <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-bold">
                                    Login here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.script')
    <!-- Password Toggle Script -->
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            let passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.classList.remove("bi-eye-slash");
                this.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                this.classList.remove("bi-eye");
                this.classList.add("bi-eye-slash");
            }
        });
    </script>

</body>

</html>
