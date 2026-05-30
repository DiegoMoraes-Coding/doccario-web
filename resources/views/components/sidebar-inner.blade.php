<!-- Navigation -->
<nav class="flex-grow-0 mb-4">
    <ul class="nav nav-pills flex-column gap-1">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link d-flex align-items-center gap-2">
                <i class="ti ti-home"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('chat') }}" class="nav-link active d-flex align-items-center gap-2">
                <i class="ti ti-message-circle"></i> Chat
            </a>
        </li>
    </ul>
</nav>
<!-- Documents List -->
<div class="flex-grow-1 overflow-auto mb-4">
    <div class="fw-semibold text-muted small mb-2 px-3">Your Documents</div>
    @if (!empty($documents) && count($documents) > 0)
        <ul class="list-group list-group-flush">
            @foreach ($documents as $doc)
                <li class="list-group-item px-3 py-2 border-0">
                    <a href="{{ route('chat', ['document' => $doc['id']]) }}"
                        class="d-flex align-items-center gap-2 text-decoration-none text-body">
                        <span class="avatar bg-primary-lt text-primary flex-shrink-0"
                            style="height:1.8em;width:1.8em;"><i class="ti ti-file-type-pdf"
                                style="font-size:1.1em;"></i></span>
                        <span class="text-truncate" style="max-width: 120px;"
                            title="{{ $doc['title'] ?? $doc['originalName'] }}">{{ $doc['title'] ?? $doc['originalName'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <div class="d-flex flex-column align-items-center justify-content-center py-5 text-center text-muted">
            <i class="ti ti-folder-open" style="font-size: 2.5rem;"></i>
            <div class="mt-3">Your uploaded documents will appear here</div>
        </div>
    @endif
</div>
