<div id="sidebar-main" class="sidebar bg-body border-end d-none d-md-flex flex-column p-3 h-100"
    style="width: 260px; min-width: 200px;">
    <!-- Navigation -->
    <nav class="flex-grow-0 mb-4">
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center gap-2">
                    <i class="ti ti-layout-dashboard"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('chat') }}" class="nav-link active d-flex align-items-center gap-2">
                    <i class="ti ti-message-circle"></i> Chat
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center gap-2">
                    <i class="ti ti-settings"></i> Settings
                </a>
            </li>
        </ul>
    </nav>
    <!-- Documents List -->
    <div class="flex-grow-1 overflow-auto mb-4">
        <div class="fw-semibold text-muted small mb-2">Your Documents</div>
        <ul class="list-unstyled mb-0">
            <li>
                <a href="#" class="d-flex align-items-center gap-2 py-2 px-2 rounded bg-primary-lt text-primary">
                    <i class="ti ti-file-pdf"></i> Sample.pdf
                </a>
            </li>
            <li>
                <a href="#" class="d-flex align-items-center gap-2 py-2 px-2 rounded">
                    <i class="ti ti-file-pdf"></i> AnotherDoc.pdf
                </a>
            </li>
            <li>
                <a href="#" class="d-flex align-items-center gap-2 py-2 px-2 rounded">
                    <i class="ti ti-file-pdf"></i> Report2026.pdf
                </a>
            </li>
        </ul>
    </div>
    <!-- User/Profile -->
    <div class="mt-auto pt-3 border-top">
        @include('components.profile-button', ['user' => $authUser ?? [], 'direction' => 'up'])
    </div>
</div>
