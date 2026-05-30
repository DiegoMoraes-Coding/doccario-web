@props(['user', 'direction' => 'down'])
<div x-cloak x-data="{ open: false, direction: '{{ $direction }}' }" class="position-relative w-100" style="z-index: 1040;">
    <button x-on:click="open = !open" x-bind:aria-expanded="open" aria-haspopup="true"
        class="btn d-flex align-items-center gap-2 w-100">
        <span class="avatar bg-secondary-lt text-secondary"><i class="ti ti-user"></i></span>
        <span class="d-none d-md-inline">Profile</span>
        <i class="ti ti-chevron-down" x-show="direction === 'down'"></i>
        <i class="ti ti-chevron-up" x-show="direction === 'up'"></i>
    </button>
    <div x-cloak x-show="open" x-on:click.away="open = false" x-transition
        :class="direction === 'up' ? 'dropdown-menu dropdown-menu-end show mb-2 shadow border-0 p-0 dropup' :
            'dropdown-menu dropdown-menu-end show mt-2 shadow border-0 p-0'"
        style="min-width: 220px; right: 0; left: auto; z-index: 1050;"
        x-bind:style="direction === 'up' ? 'min-width: 220px; right: 0; left: auto; bottom: 100%; top: auto; z-index: 1050;' :
            'min-width: 220px; right: 0; left: auto; z-index: 1050;'">
        <div class="px-3 py-2 border-bottom">
            <div class="fw-semibold">{{ $user['name'] ?? 'User' }}</div>
            <div class="text-muted small">{{ $user['email'] ?? 'user@email.com' }}</div>
        </div>
        <div class="px-3 py-2">
            @include('components.theme-toggle')
        </div>
        <div class="dropdown-divider m-0"></div>
        <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center gap-2" x-loading-btn>
                <i class="ti ti-logout"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
