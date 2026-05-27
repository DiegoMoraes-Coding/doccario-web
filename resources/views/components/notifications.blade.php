<div x-data="{ show: false, type: '', message: '' }" x-init="@if (session('error')) show = true; type = 'danger'; message = '{{ session('error') }}';
        @elseif(session('success'))
            show = true; type = 'success'; message = '{{ session('success') }}';
        @elseif(session('info'))
            show = true; type = 'info'; message = '{{ session('info') }}'; @endif
if (show) setTimeout(() => show = false, 4000);" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="position-fixed bottom-0 end-0 mb-3 me-3 w-auto"
    style="z-index: 1050; min-width: 250px; max-width: 90vw;" aria-live="polite">
    <div :class="'alert alert-' + type + ' shadow'" role="alert">
        <span x-text="message"></span>
    </div>
</div>
