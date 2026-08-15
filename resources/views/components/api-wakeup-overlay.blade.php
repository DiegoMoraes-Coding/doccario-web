<div
    x-data
    x-cloak
    x-show="$store.apiWakeup.visible"
    x-transition.opacity
    class="api-wakeup-overlay position-fixed top-0 start-0 w-100 h-100"
    style="z-index: 9999; background: rgba(0, 0, 0, 0.55); backdrop-filter: blur(4px);"
    role="alertdialog"
    aria-modal="true"
    aria-live="polite"
    :aria-busy="$store.apiWakeup.visible ? 'true' : 'false'"
>
    <div class="d-flex align-items-center justify-content-center w-100 h-100">
        <div class="card shadow-lg border-0 text-center p-4 mx-3" style="max-width: 420px; width: 100%;">
            <div class="spinner-border text-primary mb-3 mx-auto" role="status" aria-hidden="true"></div>
            <h2 class="h4 mb-2">Starting services</h2>
            <p class="text-muted mb-0" x-text="$store.apiWakeup.message"></p>
        </div>
    </div>
</div>
