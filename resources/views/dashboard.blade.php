@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-4 px-md-4" data-aos="fade-up">
        <!-- Dashboard Header: Welcome, Upload Document, Profile Dropdown -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
            <div class="flex-grow-1">
                <h1 class="fw-bold display-6 mb-1">Welcome back, <span
                        class="text-primary">{{ $authUser['name'] ?? 'User' }}</span></h1>
                <div class="text-muted fs-5">Your AI-powered document workspace</div>
            </div>
            <button class="btn btn-primary btn-lg px-4 d-flex align-items-center gap-2" x-loading-btn>
                <i class="ti ti-plus"></i>
                <span>Upload Document</span>
            </button>
            <div x-data="{ open: false }" class="position-relative ms-2">
                <button x-on:click="open = !open" x-bind:aria-expanded="open" aria-haspopup="true"
                    class="btn d-flex align-items-center gap-2">
                    <span class="avatar bg-secondary-lt text-secondary"><i class="ti ti-user"></i></span>
                    <span class="d-none d-md-inline">Profile</span>
                    <i class="ti ti-chevron-down"></i>
                </button>
                <div x-show="open" x-on:click.away="open = false" x-transition
                    class="dropdown-menu dropdown-menu-end show mt-2 shadow border-0 p-0"
                    style="min-width: 220px; right: 0; left: auto;">
                    <div class="px-3 py-2 border-bottom">
                        <div class="fw-semibold">{{ $authUser['name'] ?? 'User' }}</div>
                        <div class="text-muted small">{{ $authUser['email'] ?? 'user@email.com' }}</div>
                    </div>
                    <div class="px-3 py-2">
                        @include('components.theme-toggle')
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center gap-2">
                            <i class="ti ti-logout"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-3">
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="fw-semibold fs-5">Recent Documents</span>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center"
                        style="min-height: 260px;">
                        <span class="avatar avatar-xl bg-primary-lt text-primary mb-3" style="font-size: 3rem;"><i
                                class="ti ti-folder-open"></i></span>
                        <div class="fw-semibold fs-5 mb-2 text-center">No documents uploaded yet</div>
                        <div class="text-muted mb-3 text-center">Start by uploading your first document to see it listed
                            here.</div>
                        <a href="#" class="btn btn-primary btn-lg"><i class="ti ti-plus me-1"></i> Upload Document</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome, Chat, and Features -->
        <div class="row g-3 justify-content-center align-items-stretch">
            <div class="col-12 col-md-4 d-flex">
                <div class="card shadow-sm flex-fill h-100">
                    <div class="card-body d-flex flex-column align-items-start h-100">
                        <div class="mb-2">
                            <span class="avatar bg-primary-lt text-primary me-2"><i class="ti ti-rocket"></i></span>
                            <span class="fw-semibold">Welcome to Doccario</span>
                        </div>
                        <div class="mb-2">Get started by exploring your dashboard and discovering how Doccario can help
                            you manage and understand your documents with ease.</div>
                        <div class="text-muted small mt-auto">Onboarding made simple.</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex">
                <div class="card shadow-sm flex-fill h-100">
                    <div class="card-body d-flex flex-column align-items-start h-100">
                        <div class="mb-2">
                            <span class="avatar bg-info-lt text-info me-2"><i class="ti ti-message-circle"></i></span>
                            <span class="fw-semibold">Explore Smart Chat</span>
                        </div>
                        <div class="mb-2">Interact with your documents using our AI-powered chat. Get instant answers,
                            summaries, and insights—just ask!</div>
                        <div class="text-muted small mt-auto">Try asking about a document after uploading.</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex">
                <div class="card shadow-sm flex-fill h-100">
                    <div class="card-body d-flex flex-column align-items-start h-100">
                        <div class="mb-2">
                            <span class="avatar bg-success-lt text-success me-2"><i class="ti ti-sparkles"></i></span>
                            <span class="fw-semibold">Why Doccario?</span>
                        </div>
                        <ul class="mb-2 ps-3 small">
                            <li>Instant document search & smart filters</li>
                            <li>Enterprise-grade security & privacy</li>
                            <li>Seamless team collaboration</li>
                            <li>AI-powered summaries & insights</li>
                            <li>Mobile-friendly, modern SaaS UI</li>
                        </ul>
                        <div class="text-muted small mt-auto">Built for productivity and trust.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
