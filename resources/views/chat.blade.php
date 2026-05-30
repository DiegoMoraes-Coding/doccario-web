@extends('layouts.app')

@section('content')
    <div class="d-flex h-100 flex-column flex-md-row" x-data="{ messages: [], userInput: '', sidebarOpen: false }" data-aos="fade-left">
        @include('components.sidebar')

        <!-- Chat Main Area -->
        <div class="flex-grow-1 d-flex flex-column h-100 w-100" style="margin: 0 auto;">
            <!-- Chat Header -->
            <div class="border-bottom px-3 px-md-4 py-3 bg-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <!-- Sidebar toggle for mobile -->
                    <button class="btn btn-icon btn-ghost-primary d-inline-block d-md-none me-2" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                        <i class="ti ti-menu-2"></i>
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-icon btn-ghost-primary d-none d-md-inline-block"
                        x-loading-btn>
                        <i class="ti ti-arrow-left"></i>
                    </a>
                    <div>
                        <h5 class="mb-0 fw-bold">Chat with AI</h5>
                        <small class="text-muted">
                            <i class="ti ti-file-pdf"></i> <span>{{ $documentName }}</span>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Messages Container -->
            <div class="flex-grow-1 overflow-y-auto px-4 py-4 " style="background: var(--tblr-bg-surface);">
                <!-- Welcome State -->
                <template x-if="messages.length === 0">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center py-5 mx-auto w-100"
                        style="max-width: 900px;">
                        <div class="avatar avatar-xl bg-primary-lt text-primary mb-3">
                            <i class="ti ti-message-circle" style="font-size: 2rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Start Chatting</h4>
                        <p class="text-muted mb-4 w-50">Ask questions about your document and get instant answers
                            powered by
                            AI.
                            Start by typing your message below.</p>
                        <div class="d-flex gap-2 flex-wrap justify-content-center">
                            <button class="btn btn-outline-primary btn-sm">What's in this doc?</button>
                            <button class="btn btn-outline-primary btn-sm">Summarize</button>
                            <button class="btn btn-outline-primary btn-sm">Find key points</button>
                        </div>
                    </div>
                </template>

                <!-- Messages -->
                <template x-for="(msg, idx) in messages" :key="idx">
                    <div class="mb-4 d-flex"
                        :class="msg.role === 'user' ? 'justify-content-end' : 'justify-content-start'">
                        <div style="max-width: 75%;">
                            <div class="d-flex align-items-end gap-2"
                                :class="msg.role === 'user' ? 'flex-row-reverse' : ''">
                                <div class="avatar avatar-sm"
                                    :class="msg.role === 'user' ? 'bg-primary' : 'bg-secondary'">
                                    <i :class="msg.role === 'user' ? 'ti ti-user' : 'ti ti-robot'"
                                        style="font-size: 0.875rem;"></i>
                                </div>
                                <div class="p-3 rounded"
                                    :class="msg.role === 'user' ? 'bg-primary text-white' : 'bg-body-secondary border'">
                                    <p class="mb-0" x-text="msg.text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Input Area -->
            <div class="border-top px-4 py-3 bg-body">
                <form
                    @submit.prevent="if(userInput.trim()){ messages.push({role: 'user', text: userInput}); userInput=''; }"
                    class="d-flex gap-2">
                    <input type="text" class="form-control form-control-lg" placeholder="Ask about your document..."
                        x-model="userInput" autocomplete="off">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ti ti-send"></i>
                    </button>
                </form>
                <small class="text-muted d-block mt-2 text-center">
                    <i class="ti ti-lock-check"></i> Your conversations are encrypted and private.
                </small>
            </div>
        </div>
    </div>
@endsection
