@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-4 px-md-4" data-aos="fade-up">
        <!-- Profile Dropdown -->
        <div class="d-flex justify-content-end mb-3">
            <div x-data="{ open: false }" class="position-relative">
                <button x-on:click="open = !open" x-bind:aria-expanded="open" aria-haspopup="true"
                    class="btn btn-outline-secondary d-flex align-items-center gap-2" id="profileDropdownBtn">
                    <span class="avatar bg-secondary-lt text-secondary">DU</span>
                    <span class="d-none d-md-inline">Profile</span>
                    <i class="ti ti-chevron-down"></i>
                </button>
                <div x-show="open" x-on:click.away="open = false" x-transition
                    class="dropdown-menu dropdown-menu-end show mt-2 shadow border-0 p-0"
                    style="min-width: 220px; right: 0; left: auto;">
                    <div class="px-3 py-2 border-bottom">
                        <div class="fw-semibold">Doccario User</div>
                        <div class="text-muted small">user@email.com</div>
                    </div>
                    <div class="px-3 py-2">
                        @include('components.theme-toggle')
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center gap-2">
                            <i class="ti ti-logout"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
            <div>
                <h1 class="fw-bold display-6 mb-1">Welcome back, <span class="text-primary">Doccario User</span></h1>
                <div class="text-muted fs-5">Your AI-powered document workspace</div>
            </div>
            <button class="btn btn-primary btn-lg px-4 d-flex align-items-center gap-2" x-loading-btn>
                <i class="ti ti-plus"></i>
                <span>New Document</span>
            </button>
        </div>

        <!-- KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card card-link card-hover shadow-sm h-100" tabindex="0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <span class="avatar bg-primary-lt text-primary me-2"><i class="ti ti-file-text"></i></span>
                            <span class="text-uppercase text-muted small">Documents</span>
                        </div>
                        <div class="h2 mb-1">42</div>
                        <div class="text-success small">+3 this week</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card card-link card-hover shadow-sm h-100" tabindex="0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <span class="avatar bg-info-lt text-info me-2"><i class="ti ti-message-circle"></i></span>
                            <span class="text-uppercase text-muted small">Chats</span>
                        </div>
                        <div class="h2 mb-1">128</div>
                        <div class="text-success small">+12 this week</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card card-link card-hover shadow-sm h-100" tabindex="0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <span class="avatar bg-warning-lt text-warning me-2"><i class="ti ti-users"></i></span>
                            <span class="text-uppercase text-muted small">Team</span>
                        </div>
                        <div class="h2 mb-1">5</div>
                        <div class="text-muted small">Pro plan</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card card-link card-hover shadow-sm h-100" tabindex="0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <span class="avatar bg-danger-lt text-danger me-2"><i class="ti ti-clock"></i></span>
                            <span class="text-uppercase text-muted small">Uptime</span>
                        </div>
                        <div class="h2 mb-1">99.99%</div>
                        <div class="text-success small">All systems operational</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Recent Activity -->
            <div class="col-12 col-lg-5 col-xl-4 d-flex flex-column">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="fw-semibold fs-5">Recent Activity</span>
                        <span class="badge bg-dark text-white">Live</span>
                    </div>
                    <div class="card-body pt-2 pb-3 px-3">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 d-flex align-items-center" tabindex="0">
                                <span class="avatar bg-primary-lt text-primary me-2">JD</span>
                                <div>
                                    <span class="fw-semibold">Jane Doe</span> uploaded <span
                                        class="fw-semibold">Q1_Report.pdf</span>
                                    <div class="text-muted small">2 minutes ago</div>
                                </div>
                            </li>
                            <li class="mb-3 d-flex align-items-center" tabindex="0">
                                <span class="avatar bg-info-lt text-info me-2">AM</span>
                                <div>
                                    <span class="fw-semibold">Alex M.</span> started a chat
                                    <div class="text-muted small">10 minutes ago</div>
                                </div>
                            </li>
                            <li class="mb-3 d-flex align-items-center" tabindex="0">
                                <span class="avatar bg-warning-lt text-warning me-2">LS</span>
                                <div>
                                    <span class="fw-semibold">Lisa S.</span> changed team settings
                                    <div class="text-muted small">1 hour ago</div>
                                </div>
                            </li>
                            <li class="d-flex align-items-center" tabindex="0">
                                <span class="avatar bg-secondary-lt text-secondary me-2">YO</span>
                                <div>
                                    <span class="fw-semibold">You</span> viewed <span class="fw-semibold">Doccario
                                        Guide.pdf</span>
                                    <div class="text-muted small">Today, 09:12</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Recent Documents Table -->
            <div class="col-12 col-lg-7 col-xl-8">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="fw-semibold fs-5">Recent Documents</span>
                        <a href="#" class="text-decoration-none small text-primary">View all</a>
                    </div>
                    <div class="card-body pt-2 pb-3 px-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="text-muted small">
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Last Modified</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr tabindex="0">
                                        <td class="fw-semibold">Q1_Report.pdf</td>
                                        <td>PDF</td>
                                        <td>2 minutes ago</td>
                                        <td><span class="badge bg-success text-white">Processed</span></td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-primary me-1" title="Open"><i
                                                    class="ti ti-eye"></i></button>
                                            <button class="btn btn-sm btn-outline-secondary" title="Download"><i
                                                    class="ti ti-download"></i></button>
                                        </td>
                                    </tr>
                                    <tr tabindex="0">
                                        <td class="fw-semibold">Doccario Guide.pdf</td>
                                        <td>PDF</td>
                                        <td>Today, 09:12</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-primary me-1" title="Open"><i
                                                    class="ti ti-eye"></i></button>
                                            <button class="btn btn-sm btn-outline-secondary" title="Download"><i
                                                    class="ti ti-download"></i></button>
                                        </td>
                                    </tr>
                                    <tr tabindex="0">
                                        <td class="fw-semibold">Team_Plan.xlsx</td>
                                        <td>Excel</td>
                                        <td>Yesterday, 17:45</td>
                                        <td><span class="badge bg-info text-white">In Review</span></td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-primary me-1" title="Open"><i
                                                    class="ti ti-eye"></i></button>
                                            <button class="btn btn-sm btn-outline-secondary" title="Download"><i
                                                    class="ti ti-download"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
