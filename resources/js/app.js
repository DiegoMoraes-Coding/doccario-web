import './bootstrap';
import AOS from 'aos';
import './button-loading';
import zxcvbn from 'zxcvbn';
import './password-strength';
import Alpine from 'alpinejs';
import { initApiWakeupOverlay } from './api-wakeup-overlay';

window.Alpine = Alpine;

Alpine.store('apiWakeup', {
    visible: false,
    message: 'Our service is waking up. This can take up to a minute on first use.',
    show(message) {
        if (message) {
            this.message = message;
        }
        this.visible = true;
    },
    hide() {
        this.visible = false;
    },
});

Alpine.start();
initApiWakeupOverlay();
AOS.init();
