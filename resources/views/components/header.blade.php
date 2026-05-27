<header class="navbar navbar-expand-lg navbar-light bg-body border-bottom px-3 px-md-4 py-2 w-100 position-sticky top-0"
    style="z-index: 1035;">
    <div class="container-fluid d-flex align-items-center justify-content-between p-0">
        <a href="/" class="navbar-brand fw-bold fs-3 m-0 p-0" style="line-height:1;">
            Doccario.
        </a>
        <div class="d-flex align-items-center gap-2 ms-auto">
            @include('components.profile-button', [
                'user' => $authUser ?? [],
                'direction' => 'down',
            ])
        </div>
    </div>
</header>
