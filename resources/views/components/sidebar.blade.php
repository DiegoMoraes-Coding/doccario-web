<!-- Offcanvas Sidebar for mobile -->
<div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="sidebarOffcanvas"
    aria-labelledby="sidebarOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        @include('components.sidebar-inner')
    </div>
</div>
<!-- Static Sidebar for md+ -->
<div id="sidebar-main" class="sidebar bg-body border-end d-none d-md-flex flex-column p-3 h-100"
    style="width: 260px; min-width: 200px;">
    @include('components.sidebar-inner')
</div>
