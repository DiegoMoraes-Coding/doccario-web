@extends('layouts.landing')

@section('title', 'Doccario — AI-Powered Document Workspace')

@section('content')
    @php
        $navLinks = [
            ['href' => '#features', 'label' => 'Features'],
            ['href' => '#how-it-works', 'label' => 'How it works'],
            ['href' => '#security', 'label' => 'Security'],
            ['href' => '#early-access', 'label' => 'Early access'],
        ];
    @endphp

    {{-- Navigation --}}
    <header class="navbar navbar-expand-lg bg-body border-bottom sticky-top">
        <div class="container-xl">
            <a href="{{ route('landing') }}" class="navbar-brand fw-bold fs-3">Doccario.</a>

            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#landingNavOffcanvas" aria-controls="landingNavOffcanvas" aria-label="Open menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse d-none d-lg-flex">
                <ul class="navbar-nav mx-auto gap-lg-2">
                    @foreach ($navLinks as $link)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $link['href'] }}">{{ $link['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-ghost-primary">Log in</a>
                    <a href="{{ route('signup') }}" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </div>
    </header>

    {{-- Mobile menu --}}
    <div class="offcanvas offcanvas-end d-lg-none bg-body" tabindex="-1" id="landingNavOffcanvas"
        aria-labelledby="landingNavOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="landingNavOffcanvasLabel">Doccario.</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div class="d-grid gap-2 mt-3">
                <a href="{{ route('login') }}" class="btn btn-ghost-primary">Log in</a>
                <a href="{{ route('signup') }}" class="btn btn-primary">Get Started</a>
            </div>
        </div>
    </div>

    <main class="px-3 py-0">
        {{-- Hero --}}
        <section class="py-5 bg-body">
            <div class="container-xl py-lg-4">
                <div class="row align-items-center g-4 g-lg-5">
                    <div class="col-lg-6 text-center text-lg-start">
                        <span class="badge bg-primary-lt text-primary mb-3 px-3 py-2 fw-medium">
                            <i class="ti ti-sparkles me-1"></i> Early access — free to try
                        </span>
                        <h1 class="display-4 fw-bold lh-sm mb-4">
                            Turn every PDF into a<br class="d-none d-sm-inline">
                            <span class="text-primary">conversation</span>
                        </h1>
                        <p class="lead text-muted mb-4">
                            Upload a PDF, ask questions in plain English, and get instant answers, summaries,
                            and insights — without digging through pages of text.
                        </p>
                        <div
                            class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start mb-4">
                            <a href="{{ route('signup') }}" class="btn btn-primary btn-lg px-4">
                                Start for free
                                <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-4">
                                Sign in
                            </a>
                        </div>
                        <p class="text-muted small mb-0">
                            <i class="ti ti-check text-success me-1"></i> Free while in early access
                            <span class="mx-2 text-secondary">·</span>
                            <i class="ti ti-check text-success me-1"></i> No credit card required
                        </p>
                    </div>

                    <div class="col-lg-6">
                        <div class="card shadow-sm border rounded-3 overflow-hidden">
                            <div class="card-header bg-body-secondary border-bottom py-2 px-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status status-red status-dot"></span>
                                    <span class="status status-yellow status-dot"></span>
                                    <span class="status status-green status-dot"></span>
                                    <span class="text-muted small ms-1">app.doccario.com</span>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    {{-- Sidebar preview --}}
                                    <div
                                        class="col-4 col-sm-3 border-end bg-body-tertiary d-none d-sm-flex flex-column p-3">
                                        <div class="fw-bold small mb-3 text-primary">Doccario.</div>
                                        <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                                            <i class="ti ti-home"></i> Dashboard
                                        </div>
                                        <div class="d-flex align-items-center gap-2 small text-primary fw-medium mb-3">
                                            <i class="ti ti-message-circle"></i> Chat
                                        </div>
                                        <div class="text-uppercase text-muted small mb-2">Documents</div>
                                        <div class="d-flex align-items-center gap-2 small mb-2 p-2 rounded bg-primary-lt">
                                            <i class="ti ti-file-type-pdf text-primary"></i>
                                            <span class="text-truncate">Research Paper.pdf</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 small mb-2 p-2 rounded">
                                            <i class="ti ti-file-type-pdf text-muted"></i>
                                            <span class="text-truncate text-muted">Lecture Notes.pdf</span>
                                        </div>
                                    </div>
                                    {{-- Chat preview --}}
                                    <div class="col-12 col-sm-9 d-flex flex-column bg-body">
                                        <div class="border-bottom px-3 py-2 d-flex align-items-center gap-2">
                                            <i class="ti ti-file-type-pdf text-primary"></i>
                                            <span class="small fw-semibold">Research Paper.pdf</span>
                                        </div>
                                        <div class="p-3 d-flex flex-column gap-3 flex-grow-1">
                                            <div class="d-flex gap-2 align-items-start">
                                                <span class="avatar avatar-sm bg-secondary-lt flex-shrink-0">
                                                    <i class="ti ti-user"></i>
                                                </span>
                                                <div class="card card-sm shadow-none border mb-0 w-75">
                                                    <div class="card-body py-2 px-3 small">
                                                        What is the main conclusion of this paper?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 align-items-start">
                                                <span class="avatar avatar-sm bg-primary-lt text-primary flex-shrink-0">
                                                    <i class="ti ti-sparkles"></i>
                                                </span>
                                                <div class="card card-sm shadow-none border mb-0 bg-primary-lt w-75">
                                                    <div class="card-body py-2 px-3 small">
                                                        The authors argue that retrieval-augmented generation improves
                                                        answer accuracy on long documents, with the strongest gains on
                                                        technical PDFs over 20 pages.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top p-2 mt-auto">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control border-end-0"
                                                    placeholder="Ask about your document..." disabled>
                                                <button class="btn btn-primary" type="button" disabled>
                                                    <i class="ti ti-send"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Use cases --}}
        <section class="py-4 border-top border-bottom bg-body-tertiary rounded">
            <div class="container-xl">
                <p class="text-center text-muted small text-uppercase mb-4">
                    Built for anyone working with PDFs
                </p>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3 justify-content-center">
                    @foreach ([['icon' => 'ti-school', 'label' => 'Students & researchers'], ['icon' => 'ti-briefcase', 'label' => 'Freelancers & consultants'], ['icon' => 'ti-book', 'label' => 'Course materials'], ['icon' => 'ti-file-text', 'label' => 'Reports & manuals'], ['icon' => 'ti-gavel', 'label' => 'Contracts & agreements'], ['icon' => 'ti-user', 'label' => 'Personal documents']] as $useCase)
                        <div class="col">
                            <div class="card card-sm h-100 shadow-none border-0 bg-transparent">
                                <div class="card-body text-center p-2">
                                    <span class="avatar avatar-sm bg-primary-lt text-primary mb-2">
                                        <i class="ti {{ $useCase['icon'] }}"></i>
                                    </span>
                                    <div class="small fw-medium text-muted">{{ $useCase['label'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Features --}}
        <section id="features" class="py-5">
            <div class="container-xl">
                <div class="text-center mb-5">
                    <span class="badge bg-primary-lt text-primary mb-3">Platform capabilities</span>
                    <h2 class="fw-bold display-6 mb-3">
                        Everything you need to work smarter with documents
                    </h2>
                    <p class="text-muted col-lg-8 mx-auto">
                        A focused set of tools to upload PDFs, track your usage, and chat with your documents
                        — everything that ships in Doccario today.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <span class="avatar bg-primary-lt text-primary mb-3">
                                    <i class="ti ti-message-chatbot"></i>
                                </span>
                                <h3 class="h4 fw-semibold mb-2">AI-Powered Chat</h3>
                                <p class="text-muted mb-0">
                                    Ask questions in natural language and receive precise, context-aware answers
                                    sourced directly from your uploaded PDFs.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <span class="avatar bg-success-lt text-success mb-3">
                                    <i class="ti ti-file-upload"></i>
                                </span>
                                <h3 class="h4 fw-semibold mb-2">Instant Document Upload</h3>
                                <p class="text-muted mb-0">
                                    Upload PDFs from your dashboard and open a dedicated chat for each document.
                                    Your files are ready to query as soon as processing completes.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <span class="avatar bg-warning-lt text-warning mb-3">
                                    <i class="ti ti-bolt"></i>
                                </span>
                                <h3 class="h4 fw-semibold mb-2">Streaming Responses</h3>
                                <p class="text-muted mb-0">
                                    Answers stream in real time as the AI processes your question — no waiting
                                    for full page reloads or stale interfaces.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <span class="avatar bg-info-lt text-info mb-3">
                                    <i class="ti ti-chart-bar"></i>
                                </span>
                                <h3 class="h4 fw-semibold mb-2">Usage Insights</h3>
                                <p class="text-muted mb-0">
                                    See how many documents you've uploaded and how much of your quota you've used
                                    — right from your dashboard home screen.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <span class="avatar bg-danger-lt text-danger mb-3">
                                    <i class="ti ti-moon"></i>
                                </span>
                                <h3 class="h4 fw-semibold mb-2">Light &amp; Dark Mode</h3>
                                <p class="text-muted mb-0">
                                    A polished interface that adapts to your environment. Reduce eye strain
                                    during long review sessions with seamless theme switching.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <span class="avatar bg-secondary-lt text-secondary mb-3">
                                    <i class="ti ti-devices"></i>
                                </span>
                                <h3 class="h4 fw-semibold mb-2">Works Everywhere</h3>
                                <p class="text-muted mb-0">
                                    Responsive design built for desktop and mobile. Review contracts on your
                                    laptop, get answers on the go — same experience, any device.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- How it works --}}
        <section id="how-it-works" class="py-5 bg-body-tertiary border-top rounded">
            <div class="container-xl">
                <div class="row align-items-center g-5">
                    <div class="col-lg-5">
                        <span class="badge bg-primary-lt text-primary mb-3">How it works</span>
                        <h2 class="fw-bold display-6 mb-3">
                            From upload to insight in three steps
                        </h2>
                        <p class="text-muted mb-0">
                            No complex setup. Create an account, upload a PDF, and start asking questions
                            in minutes.
                        </p>
                    </div>
                    <div class="col-lg-7">
                        <div class="d-flex flex-column gap-4">
                            @foreach ([['icon' => 'ti-upload', 'title' => 'Upload your PDF', 'desc' => 'Add a report, paper, contract, or any PDF from your dashboard.'], ['icon' => 'ti-message-question', 'title' => 'Ask a question', 'desc' => 'Type what you need — a summary, a specific detail, or a key takeaway — in plain English.'], ['icon' => 'ti-circle-check', 'title' => 'Get answers in chat', 'desc' => 'Responses stream into your conversation, grounded in the document you uploaded.']] as $i => $step)
                                <div class="d-flex gap-3">
                                    <span class="avatar bg-primary-lt text-primary flex-shrink-0 fw-bold">
                                        {{ $i + 1 }}
                                    </span>
                                    <div>
                                        <h3 class="h5 fw-semibold mb-1">
                                            <i class="ti {{ $step['icon'] }} text-primary me-1"></i>
                                            {{ $step['title'] }}
                                        </h3>
                                        <p class="text-muted mb-0">{{ $step['desc'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Security & Early access --}}
        <section id="security" class="py-5">
            <div class="container-xl">
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <span class="badge bg-primary-lt text-primary mb-3">How it's built</span>
                                <h2 class="fw-bold h2 mb-3">
                                    A straightforward, security-conscious setup
                                </h2>
                                <p class="text-muted mb-4">
                                    Doccario is a Laravel frontend that talks to a separate API. Your documents
                                    and AI processing live on the backend — this app handles auth, UI, and streaming.
                                </p>
                                <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                                    @foreach (['JWT authentication with automatic token refresh', 'Optional "remember me" via secure HTTP-only cookies', 'Document storage and AI handled by the API, not in the browser', 'Sign out clears your session immediately'] as $item)
                                        <li class="d-flex align-items-start gap-2">
                                            <i class="ti ti-shield-check text-success mt-1"></i>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100 shadow-sm" id="early-access">
                            <div class="card-body p-4 d-flex flex-column">
                                <span class="badge bg-success-lt text-success mb-3">Early access</span>
                                <h2 class="fw-bold h2 mb-3">
                                    Free to use while we build
                                </h2>
                                <p class="text-muted mb-4">
                                    Doccario is in active development. There are no paid plans yet — create an account,
                                    upload PDFs, and help shape what comes next.
                                </p>
                                <ul class="list-unstyled mb-4 d-flex flex-column gap-2">
                                    @foreach (['Sign up with email — no credit card', 'Upload PDFs and chat with each one', 'Light and dark mode included'] as $item)
                                        <li class="d-flex align-items-start gap-2 small text-muted">
                                            <i class="ti ti-check text-success mt-1"></i>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-auto">
                                    <a href="{{ route('signup') }}" class="btn btn-primary w-100 btn-lg">
                                        Create a free account
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Bottom CTA --}}
        <section class="py-5">
            <div class="container-xl">
                <div class="card bg-primary-lt border-primary rounded-3 shadow-sm">
                    <div class="card-body p-4 p-lg-5 text-center">
                        <h2 class="fw-bold display-6 mb-3">
                            Try it on your next PDF
                        </h2>
                        <p class="text-muted col-lg-8 mx-auto mb-4">
                            Upload a document you're already working on — a paper, a contract, a manual —
                            and see how fast you can get answers without re-reading every page.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                            <a href="{{ route('signup') }}" class="btn btn-primary btn-lg px-5">
                                Create a free account
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-5">
                                Log in to your account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="border-top py-4 mt-auto">
        <div class="container-xl">
            <div class="row align-items-center g-3">
                <div class="col-md">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="fw-bold">Doccario.</span>
                        <span class="text-muted small">© {{ date('Y') }} All rights reserved.</span>
                    </div>
                </div>
                <div class="col-md-auto">
                    @include('components.theme-toggle')
                </div>
            </div>
        </div>
    </footer>
@endsection
