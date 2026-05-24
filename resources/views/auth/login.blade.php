@extends('layouts.app')

@section('content')
    <div class="container position-relative min-vh-100 d-flex align-items-center justify-content-center">
        @include('components.auth-topbar')
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;" data-aos="fade-up">
            <div class="text-center mb-4">
                <span class="mb-2 d-inline-flex align-items-center justify-content-center" style="height: 56px; width: 56px;">
                    <i class="ti ti-face-id" style="font-size: 64px;"></i>
                </span>
                <h2 class="h3 mb-0">Sign in to Doccario</h2>
                <p class="text-muted small">Welcome back! Please login to your account.</p>
            </div>
            {{-- Notifications are now handled globally in the layout --}}
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com"
                        required autofocus value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="small text-decoration-none">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100" x-loading-btn>Sign In</button>
            </form>
            <div class="text-center my-3">
                <span class="text-muted">or sign in with</span>
            </div>
            @include('components.auth-socials')
            <div class="text-center mt-3">
                <span class="text-muted small">Don't have an account?</span>
                <a href="{{ route('signup') }}" class="small">Sign up</a>
            </div>
        </div>
    </div>
@endsection
