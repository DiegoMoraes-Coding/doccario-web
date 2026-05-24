@extends('layouts.app')

@section('content')
    <div class="container position-relative min-vh-100 d-flex align-items-center justify-content-center">
        <div class="position-absolute top-0 end-0 p-3" style="z-index: 10;" data-aos="fade-left">
            @include('components.theme-toggle')
        </div>
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;" data-aos="fade-up">
            <div class="text-center mb-4">
                <span class="mb-2 d-inline-flex align-items-center justify-content-center" style="height: 56px; width: 56px;">
                    <i class="ti ti-user-plus" style="font-size: 64px;"></i>
                </span>
                <h2 class="h3 mb-0">Create Doccario Account</h2>
                <p class="text-muted small">Join us and start organizing your documents.</p>
            </div>
            {{-- Notifications are now handled globally in the layout --}}
            <form method="POST" action="{{ url('/signup') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="John Doe" required autofocus value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="you@example.com" required value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Create a strong password" required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm your password" required>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100" x-loading-btn>Create Account</button>
            </form>
            <div class="text-center my-3">
                <span class="text-muted">or sign up with</span>
            </div>
            <div class="row g-2 mb-2">
                <div class="col">
                    <button type="button"
                        class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
                        <i class="ti ti-brand-google me-2"></i> Google
                    </button>
                </div>
                <div class="col">
                    <button type="button"
                        class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
                        <i class="ti ti-brand-apple me-2"></i> Apple
                    </button>
                </div>
                <div class="col">
                    <button type="button"
                        class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
                        <i class="ti ti-brand-github me-2"></i> GitHub
                    </button>
                </div>
            </div>
            <div class="text-center mt-3">
                <span class="text-muted small">Already have an account?</span>
                <a href="{{ route('login') }}" class="small">Sign in</a>
            </div>
        </div>
    </div>
@endsection
