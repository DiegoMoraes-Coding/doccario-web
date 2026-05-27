/**
 * Global Button Loading Handler
 * 
 * Usage: Add x-loading-btn attribute to any button
 * The button will automatically show a spinner on click/submit
 * and restore its original state after the request completes
 */

document.addEventListener('DOMContentLoaded', () => {
    const spinnerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

    // Handle buttons and links with x-loading-btn attribute
    document.querySelectorAll('button[x-loading-btn], a[x-loading-btn]').forEach(el => {
        const originalHTML = el.innerHTML;
        el.dataset.originalHTML = originalHTML;

        if (el.tagName.toLowerCase() === 'button') {
            const form = el.closest('form');
            if (form) {
                form.addEventListener('submit', () => {
                    if (!el.disabled) showLoading(el);
                });
            }
            el.addEventListener('click', (e) => {
                if (el.type !== 'submit' && !el.disabled) {
                    showLoading(el);
                    setTimeout(() => restoreButton(el), 5000);
                }
            });
        } else if (el.tagName.toLowerCase() === 'a') {
            el.addEventListener('click', (e) => {
                // Only show spinner if not already loading
                if (!el.classList.contains('loading')) {
                    showLoading(el);
                    // Prevent further clicks until navigation
                    el.classList.add('loading');
                    el.style.pointerEvents = 'none';
                }
            });
        }
    });

    function showLoading(el) {
        if (el.tagName.toLowerCase() === 'button') {
            el.disabled = true;
        }
        el.innerHTML = spinnerHTML;
        el.classList.add('d-flex', 'align-items-center', 'justify-content-center');
    }

    function restoreButton(el) {
        if (el.tagName.toLowerCase() === 'button') {
            el.disabled = false;
        }
        el.innerHTML = el.dataset.originalHTML;
        el.classList.remove('loading');
        el.style.pointerEvents = '';
    }
});
