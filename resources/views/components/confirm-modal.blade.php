<div x-data="{ show: false, message: '', onConfirm: null }"
    x-on:open-confirm-modal.window="message = $event.detail.message; onConfirm = $event.detail.onConfirm; show = true">
    <div x-show="show" x-cloak class="modal-backdrop fade show"></div>
    <!-- Modal -->
    <div x-show="show" x-cloak :class="show ? 'modal fade show d-block' : 'modal fade'" tabindex="-1" aria-modal="true"
        role="dialog" style="display:none;" data-aos="fade-up">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border border-2 rounded">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Action</h5>
                    <button type="button" class="btn-close" x-on:click="show = false"></button>
                </div>
                <div class="modal-body">
                    <p x-text="message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" x-on:click="show = false">Cancel</button>
                    <button type="button" class="btn btn-danger" x-on:click="onConfirm(); show = false"
                        x-loading-btn>Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.openConfirmModal = function(message, onConfirm) {
        window.dispatchEvent(new CustomEvent('open-confirm-modal', {
            detail: {
                message,
                onConfirm
            }
        }));
    };
</script>
