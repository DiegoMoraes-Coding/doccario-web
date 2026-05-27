@extends('layouts.app')

@section('content')
    <div class="container-xl" x-data="{ messages: [], userInput: '' }">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <span class="fw-bold">Chat with AI</span>
                            <span class="text-muted ms-2">(Document: <span id="doc-name">Sample.pdf</span>)</span>
                        </div>
                        <a href="/dashboard" class="btn btn-link">Back to Dashboard</a>
                    </div>
                    <div class="card-body"
                        style="min-height: 400px; max-height: 60h; overflow-y: auto; background: var(--tblr-bg-surface);">
                        <template x-for="(msg, idx) in messages" :key="idx">
                            <div class="mb-3" :class="msg.role === 'user' ? 'text-end' : 'text-start'">
                                <div class="d-inline-block p-2 rounded"
                                    :class="msg.role === 'user' ? 'bg-primary text-white' : 'bg-light'">
                                    <span x-text="msg.text"></span>
                                </div>
                            </div>
                        </template>
                        <template x-if="messages.length === 0">
                            <div class="text-center text-muted mt-5">
                                <i class="ti ti-message-circle fs-2 mb-2"></i>
                                <div>Start chatting about your document!</div>
                            </div>
                        </template>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <form
                            x-on:submit.prevent="if(userInput.trim()){ messages.push({role: 'user', text: userInput}); userInput=''; }"
                            class="d-flex align-items-center gap-2">
                            <input type="text" class="form-control" placeholder="Type your message..."
                                x-model="userInput" autocomplete="off">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
