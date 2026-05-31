@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3 px-3" style="max-width:1200px;" data-aos="fade-up">
        <div class="mb-3" x-data="{ theme: (localStorage.getItem('theme') || (document.documentElement.classList.contains('theme-dark') ? 'dark' : 'light')) }">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-1">
                <div class="d-flex align-items-center gap-3">
                    @php
                        $firstName = isset($authUser['name']) ? explode(' ', trim($authUser['name']))[0] : 'User';
                    @endphp
                    <h1 class="fw-bold display-6 mb-0" style="font-size:2em;line-height:1.1;">Welcome back, <span
                            class="text-primary">{{ $firstName }}</span></h1>
                </div>

            </div>
            <div class="text-muted fs-6">Doccario, Your AI-powered document workspace.</div>
        </div>

        <div class="row g-3 mb-2">
            <div class="col-12">
                <div class="card shadow-sm h-100" style="min-height:180px;">
                    <div class="card-header d-flex align-items-center justify-content-between py-2">
                        <span class="fw-semibold fs-4">Recent Documents</span>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center"
                        style="min-height: 160px; width: 100%;">
                        @if (!empty($documents) && count($documents) > 0)
                            <ul class="list-group w-100 mb-2">
                                @foreach ($documents as $doc)
                                    <li class="list-group-item d-flex align-items-center gap-3 py-2"
                                        style="overflow:hidden;">
                                        <span class="avatar bg-primary-lt text-primary flex-shrink-0"
                                            style="height:2.2em;width:2.2em;">
                                            <i class="ti ti-file-type-pdf" style="font-size:1.8em;"></i>
                                        </span>
                                        <div class="flex-grow-1" style="min-width:0;">
                                            <div class="fw-semibold text-truncate"
                                                title="{{ $doc['title'] ?? $doc['originalName'] }}">
                                                {{ $doc['title'] ?? $doc['originalName'] }}</div>
                                            <div class="text-muted small">Uploaded:
                                                {{ \Carbon\Carbon::parse($doc['createdAt'])->format('Y-m-d H:i') }}</div>
                                        </div>
                                        <a href="{{ route('chat', ['conversationId' => $doc['conversationId']]) }}"
                                            class="btn btn-outline-primary btn-md flex-shrink-0" x-loading-btn
                                            style="min-width: 5em;">Open</a>
                                        <form action="{{ route('documents.destroy', $doc['id']) }}" method="POST"
                                            class="d-inline" x-data="{ deleting: false }">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-secondary btn-md flex-shrink-0"
                                                title="Delete document" x-bind:disabled="deleting" style="min-width: 4em"
                                                x-on:click="window.openConfirmModal('Are you sure you want to delete this document?', () => { deleting = true; $el.closest('form').submit(); })">
                                                <template x-if="!deleting">
                                                    <i class="ti ti-square-x fs-2"></i>
                                                </template>
                                                <template x-if="deleting">
                                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                                </template>
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="avatar avatar-xl bg-primary-lt text-primary mb-2" style="font-size: 2.2rem;"><i
                                    class="ti ti-folder-open"></i></span>
                            <div class="fw-semibold fs-3 mb-1 text-center">No documents uploaded yet</div>
                            <div class="text-muted mb-2 text-center">Start by uploading your first document to see it listed
                                here.</div>
                        @endif
                        <div class="d-flex justify-content-center mt-2">
                            @include('components.upload-button', [
                                'href' => route('chat'),
                                'text' => 'Upload Document',
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome, Chat, and Features -->
        <div class="row g-2 justify-content-center align-items-stretch">
            <div class="col-12 col-md-4 d-flex" style="min-height: 180px;">
                <div class="card shadow-sm flex-fill h-100" style="min-height: 100%;">
                    <div class="card-body d-flex flex-column align-items-start h-100 p-3">
                        <div class="mb-1">
                            <span class="avatar bg-success-lt text-success me-2"><i class="ti ti-rocket"></i></span>
                            <span class="fw-semibold">Welcome to Doccario</span>
                        </div>
                        <div class="mb-1">Get started by exploring your dashboard and discovering how Doccario can help
                            you manage and understand your documents with ease.</div>
                        <div class="text-muted small mt-auto">Onboarding made simple.</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex" style="min-height: 180px;">
                <div class="card shadow-sm flex-fill h-100" style="min-height: 100%;">
                    <div class="card-body d-flex flex-column align-items-start h-100 p-3">
                        <div class="mb-1">
                            <span class="avatar bg-success-lt text-succes me-2"><i class="ti ti-message-circle"></i></span>
                            <span class="fw-semibold">Explore Smart Chat</span>
                        </div>
                        <div class="mb-1">Interact with your documents using our AI-powered chat. Get instant answers,
                            summaries, and insights—just ask!</div>
                        <div class="text-muted small mt-auto">Try asking about a document after uploading.</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex" style="min-height: 180px;">
                <div class="card shadow-sm flex-fill h-100" style="min-height: 100%;">
                    <div class="card-body d-flex flex-column align-items-start h-100 p-3">
                        <div class="mb-1">
                            <span class="avatar bg-success-lt text-success me-2"><i class="ti ti-sparkles"></i></span>
                            <span class="fw-semibold">Why Doccario?</span>
                        </div>
                        <ul class="mb-1 ps-3 small">
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
