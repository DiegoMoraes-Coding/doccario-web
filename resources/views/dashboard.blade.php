@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-4 px-md-4" data-aos="fade-up">
        <!-- Dashboard Header: Welcome, Upload Document, Profile Dropdown -->
        <div class="mb-4" x-data="{ theme: (localStorage.getItem('theme') || (document.documentElement.classList.contains('theme-dark') ? 'dark' : 'light')) }">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-2">
                <div class="d-flex align-items-center gap-3">
                    <span
                        style="height:2.5em;width:2.5em;min-width:2.5em;max-width:2.5em;max-height:2.5em;display:flex;align-items:center;justify-content:center;font-size:2em;">
                        <i class="ti ti-mood-smile-beam" style="font-size:2em;"></i>
                    </span>
                    @php
                        $firstName = isset($authUser['name']) ? explode(' ', trim($authUser['name']))[0] : 'User';
                    @endphp
                    <h1 class="fw-bold display-6 mb-0" style="font-size:2.5em;line-height:1;">Welcome back, <span
                            class="text-primary">{{ $firstName }}</span></h1>
                </div>

            </div>
            <div class="text-muted fs-5">Doccario, Your AI-powered document workspace.</div>
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
                        @include('components.upload-button', [
                            'href' => route('chat'),
                            'text' => 'Upload Document',
                        ])
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
