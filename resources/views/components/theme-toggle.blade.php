<div x-data="{ dark: (localStorage.getItem('theme') ?? 'dark') === 'dark' }" class="text-end">
    <button type="button" class="btn btn-outline-secondary d-inline-flex align-items-center"
        x-on:click="
            dark = !dark;
            document.documentElement.classList.toggle('theme-dark', dark);
            document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
            localStorage.setItem('theme', dark ? 'dark' : 'light');
        "
        x-init="document.documentElement.classList.toggle('theme-dark', dark);
        document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');" x-bind:aria-pressed="dark" :class="dark ? 'active' : ''" title="Toggle light/dark mode">
        <i class="ti ti-sun d-none d-dark-inline"></i>
        <i class="ti ti-moon d-dark-none"></i>
        <span class="ms-2">Theme</span>
    </button>
</div>
