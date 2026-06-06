@extends('layouts.app')

@section('content')
    <div class="container position-relative h-100 d-flex flex-column align-items-center justify-content-center">
        @include('components.auth-topbar')
        <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;" data-aos="fade-up">
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
                        name="name" required autofocus value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" required value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" x-data="{ password: '' }">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required x-model="password">
                    <template x-if="password.length > 0">
                        <div data-aos="fade-left">
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar" :class="window.passwordStrength(password).barClass"
                                    role="progressbar"
                                    :style="'width: ' + ((window.passwordStrength(password).score + 1) * 20) + '%'"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="small mt-1" x-text="window.passwordStrength(password).label"></div>
                        </div>
                    </template>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>
                <button type="submit" class="btn btn-primary w-100" x-loading-btn>Create Account</button>
            </form>
            <div class="text-center mt-3">
                <span class="text-muted small">Already have an account?</span>
                <a href="{{ route('login') }}" class="small">Sign in</a>
            </div>
        </div>
    </div>
@endsection
