/**
 * Global Button Loading Handler
 * 
 * Usage: Add x-loading-btn attribute to any button
 * The button will automatically show a spinner on click/submit
 * and restore its original state after the request completes
 */

document.addEventListener('DOMContentLoaded', () => {
    const spinnerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

    // Handle buttons with x-loading-btn attribute
    document.querySelectorAll('button[x-loading-btn]').forEach(button => {
        const originalHTML = button.innerHTML;
        const form = button.closest('form');

        // Store original state
        button.dataset.originalHTML = originalHTML;

        // On form submission
        if (form) {
            form.addEventListener('submit', (e) => {
                if (!button.disabled) {
                    showLoading(button);
                }
            });
        }

        // On direct button click (if not a form submit)
        button.addEventListener('click', (e) => {
            if (button.type !== 'submit' && !button.disabled) {
                showLoading(button);
                // Auto-restore after 3 seconds for non-form buttons
                setTimeout(() => restoreButton(button), 3000);
            }
        });
    });

    function showLoading(button) {
        button.disabled = true;
        button.innerHTML = spinnerHTML;
        button.classList.add('d-flex', 'align-items-center', 'justify-content-center');
    }

    function restoreButton(button) {
        button.disabled = false;
        button.innerHTML = button.dataset.originalHTML;
    }
});
