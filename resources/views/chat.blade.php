@extends('layouts.app')

@section('content')
    <div class="d-flex h-100 flex-column flex-md-row" x-data="chatComponent()" data-aos="fade-left">
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
            <div class="px-4 py-4 d-flex justify-content-center overflow-hidden flex-grow-1"
                style="background: var(--tblr-bg-surface); min-height: 0;">
                <div class="flex-grow-1 overflow-y-auto overflow-x-hidden d-flex flex-column align-items-center"
                    style="min-height: 0;">
                    <div class="w-100" style="max-width: 800px;">
                        <!-- Welcome State -->
                        <template x-if="messages.length === 0">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center py-5 mx-auto w-100"
                                style="max-width: 800px;">
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
                            <div class="mb-3 d-flex"
                                :class="msg.role === 'user' ? 'justify-content-end' : 'justify-content-start'">
                                <div style="max-width: 75%;">
                                    <div class="d-flex align-items-end gap-2"
                                        :class="msg.role === 'user' ? 'flex-row-reverse' : ''">
                                        <div class="avatar avatar-sm">
                                            <i :class="msg.role === 'user' ? 'ti ti-mood-smile' : 'ti ti-robot-face'"
                                                style="font-size: 0.875rem; min-width: 2.5em"></i>
                                        </div>
                                        <div class="p-4 rounded shadow-sm fs-3 fw-medium lh-lg"
                                            :class="msg.role === 'user' ? 'bg-primary text-white' :
                                                'bg-body-tertiary border border-0'">
                                            <p class="mb-0" x-text="msg.text"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="border-top px-4 py-3 bg-body d-flex justify-content-center">
                <div class="w-100" style="max-width: 800px;">
                    <form @submit.prevent="sendMessage" class="d-flex gap-2">
                        <input type="text" class="form-control form-control-lg" placeholder="Ask about your document..."
                            x-model="userInput" autocomplete="off" :disabled="loading">
                        <button type="submit" class="btn btn-primary btn-lg" :disabled="loading || !userInput.trim()">
                            <template x-if="!loading">
                                <i class="ti ti-send"></i>
                            </template>
                            <template x-if="loading">
                                <span class="spinner-border spinner-border-sm" role="status"></span>
                            </template>
                        </button>
                    </form>
                    <small class="text-muted d-block mt-2 text-center">
                        <i class="ti ti-lock-check"></i> Your conversations are encrypted and private.
                    </small>
                </div>
            </div>
            <script>
                function chatComponent() {
                    return {
                        messages: @json(
                            $conversationData
                                ? array_map(function ($msg) {
                                    return ['role' => $msg['role'], 'text' => $msg['content']];
                                }, $conversationData['messages'] ?? [])
                                : []
                        ),
                        userInput: '',
                        loading: false,
                        sidebarOpen: false,
                        sendMessage() {
                            if (!this.userInput.trim() || this.loading) return;
                            const question = this.userInput.trim();
                            this.messages.push({
                                role: 'user',
                                text: question
                            });
                            this.userInput = '';
                            this.loading = true;
                            // Add assistant message placeholder
                            const idx = this.messages.length;
                            this.messages.push({
                                role: 'assistant',
                                text: ''
                            });
                            const conversationId = @json($conversationId ?? '');
                            fetch(`/conversations/${conversationId}/ask`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                },
                                body: JSON.stringify({
                                    question
                                })
                            }).then(response => {
                                if (!response.body) throw new Error('No response body');
                                const reader = response.body.getReader();
                                let buffer = '';
                                const decoder = new TextDecoder();
                                const processChunk = ({
                                    done,
                                    value
                                }) => {
                                    if (done) {
                                        this.loading = false;
                                        return;
                                    }
                                    buffer += decoder.decode(value, {
                                        stream: true
                                    });
                                    let lines = buffer.split('\n');
                                    buffer = lines.pop(); // last line may be incomplete
                                    for (const line of lines) {
                                        if (!line.startsWith('data:')) continue;
                                        const data = line.slice(5).trim();
                                        if (data === '[DONE]') {
                                            this.loading = false;
                                            return;
                                        }
                                        try {
                                            const json = JSON.parse(data);
                                            if (json.error) {
                                                this.messages[idx].text = '[Error] ' + json.error;
                                                this.loading = false;
                                            } else if (json.content) {
                                                this.messages[idx].text += json.content;
                                            }
                                        } catch (e) {
                                            // ignore parse errors
                                        }
                                    }
                                    return reader.read().then(processChunk);
                                };
                                return reader.read().then(processChunk);
                            }).catch(err => {
                                this.messages[idx].text = '[Error] ' + (err.message || 'Unknown error');
                                this.loading = false;
                            });
                        }
                    }
                }
            </script>
        </div>
    </div>
@endsection
