/**
 * Show the overlay only when the external API is asleep (Render cold start).
 */

const DEFAULT_MESSAGE = 'Our service is waking up. This can take up to a minute on first use.';

let skipWarmupCheck = false;

export function showApiWakeupOverlay(message = DEFAULT_MESSAGE) {
    if (window.Alpine?.store('apiWakeup')) {
        window.Alpine.store('apiWakeup').show(message);
    }
}

export function hideApiWakeupOverlay() {
    if (window.Alpine?.store('apiWakeup')) {
        window.Alpine.store('apiWakeup').hide();
    }
}

export async function ensureApiAwake() {
    const checkResponse = await fetch('/api/warmup', {
        credentials: 'same-origin',
        headers: {
            Accept: 'application/json',
        },
    });

    const checkData = await checkResponse.json();

    if (checkData.status === 'awake') {
        return true;
    }

    showApiWakeupOverlay();

    try {
        const waitResponse = await fetch('/api/warmup?wait=1', {
            credentials: 'same-origin',
            headers: {
                Accept: 'application/json',
            },
        });

        return waitResponse.ok;
    } finally {
        hideApiWakeupOverlay();
    }
}

export function initApiWakeupOverlay() {
    document.addEventListener('submit', async (event) => {
        if (skipWarmupCheck) {
            return;
        }

        const form = event.target;

        if (!(form instanceof HTMLFormElement)) {
            return;
        }

        if (form.dataset.noWakeupOverlay !== undefined) {
            return;
        }

        event.preventDefault();

        try {
            await ensureApiAwake();
        } catch {
            // Proceed anyway — the server-side client will retry too.
        }

        skipWarmupCheck = true;
        form.submit();
        skipWarmupCheck = false;
    });

    if (document.body.dataset.warmApi === 'true') {
        fetch('/api/warmup', {
            credentials: 'same-origin',
            headers: {
                Accept: 'application/json',
            },
        }).catch(() => {});
    }
}

window.showApiWakeupOverlay = showApiWakeupOverlay;
window.hideApiWakeupOverlay = hideApiWakeupOverlay;
window.ensureApiAwake = ensureApiAwake;
