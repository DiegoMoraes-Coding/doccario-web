<div x-data="{ dark: (localStorage.getItem('theme') ?? 'dark') === 'dark' }" x-init="document.documentElement.classList.toggle('theme-dark', dark);
document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');" class="border rounded d-flex align-items-center w-100 px-3"
    style="min-height:2.5rem;">
    <div class="form-check form-switch d-flex align-items-center w-100 m-0">
        <input type="checkbox" class="form-check-input" id="themeSwitch" x-model="dark"
            x-on:change="
                document.documentElement.classList.toggle('theme-dark', dark);
                document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
                localStorage.setItem('theme', dark ? 'dark' : 'light');
            ">
        <label class="form-check-label d-flex align-items-center w-100 ms-2" for="themeSwitch">
            <template x-if="!dark">
                <i class="ti ti-sun text-warning me-2"></i>
            </template>
            <template x-if="dark">
                <i class="ti ti-moon text-primary me-2"></i>
            </template>
            <span x-text="dark ? 'Dark Mode' : 'Light Mode'"></span>
        </label>
    </div>
</div>
