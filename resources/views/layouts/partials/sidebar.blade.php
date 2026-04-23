<aside class="left-sidebar shadow-lg">
    <div>

        {{-- BRAND --}}
        <div class="brand-logo d-flex align-items-center justify-content-between py-3 px-4">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('storage/avatars/instax-logo.png') }}"
                     width="46"
                     class="me-2 rounded-3 shadow-sm" />
                <div>
                    <div class="brand-title">Ticketing</div>
                    <div class="brand-subtitle">Admin Panel</div>
                </div>
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-5"></i>
            </div>
        </div>

        <div class="sidebar-profile p-4 mb-4 rounded-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="profile-avatar d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-fill fs-4"></i>
                </div>
                <div>
                    <div class="fw-semibold text-white">{{ auth()->user()->name }}</div>
                    <div class="text-white-50 small">{{ ucfirst(auth()->user()->role ?? 'Admin') }}</div>
                </div>
            </div>
            <div class="text-white-50 small">Akses penuh ke semua modul admin.</div>
        </div>

        {{-- NAV --}}
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul class="list-unstyled" id="sidebarnav">

                <li class="nav-small-cap">
                    <span>Dashboard</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="ti ti-layout-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                       href="{{ route('admin.products.index') }}">
                        <i class="bi bi-calendar-event"></i>
                        <span>Event Saya</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                       href="{{ route('admin.categories.index') }}">
                        <i class="ti ti-category"></i>
                        <span>Kategori</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                       href="{{ route('admin.orders.index') }}">
                        <i class="ti ti-receipt"></i>
                        <span>Pesanan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}"
                       href="{{ route('admin.tickets.index') }}">
                        <i class="bi bi-ticket-detailed"></i>
                        <span>Support Tickets</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
                       href="{{ route('admin.reports.index') }}">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Laporan</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <span>Pengaturan</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                       href="{{ route('profile.edit') }}">
                        <i class="bi bi-gear"></i>
                        <span>Pengaturan Akun</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home') }}">
                        <i class="ti ti-world"></i>
                        <span>Kembali ke Situs</span>
                    </a>
                </li>

                <li class="sidebar-item mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="sidebar-link w-100 text-start border-0 bg-transparent">
                            <i class="ti ti-logout"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>

    </div>
</aside>

<style>
.left-sidebar {
    background: linear-gradient(180deg, #0f4ff2 0%, #0b2f9a 100%);
    min-height: 100vh;
    padding-top: 20px;
    color: #eef3ff;
}

.brand-title {
    font-size: 1rem;
    font-weight: 700;
    color: #ffffff;
}

.brand-subtitle {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.75);
}

.sidebar-profile {
    background: rgba(255,255,255,0.09);
    border: 1px solid rgba(255,255,255,0.12);
}

.profile-avatar {
    width: 56px;
    height: 56px;
    border-radius: 18px;
    background: rgba(255,255,255,0.18);
    color: #ffffff;
}

.sidebar-profile .fw-semibold {
    color: #ffffff;
}

.sidebar-profile .text-white-50 {
    color: rgba(255,255,255,0.72) !important;
}

.nav-small-cap {
    padding: 18px 22px 8px;
    font-size: 0.72rem;
    text-transform: uppercase;
    color: rgba(255,255,255,0.65);
    font-weight: 700;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 22px;
    margin: 4px 10px;
    border-radius: 16px;
    color: rgba(255,255,255,0.88);
    font-size: 0.95rem;
    transition: all 0.25s ease;
    text-decoration: none;
}

.sidebar-link i {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.88);
}

.sidebar-link:hover {
    background: rgba(255,255,255,0.12);
    color: #ffffff;
    transform: translateX(3px);
}

.sidebar-link.active {
    background: rgba(255,255,255,0.18);
    color: #ffffff;
    box-shadow: 0 18px 45px rgba(0,0,0,0.12);
}

.sidebar-link.active i {
    color: #ffffff;
}

button.sidebar-link {
    cursor: pointer;
    font-size: 0.95rem;
}

button.sidebar-link:hover {
    background: rgba(255,255,255,0.15);
}

@media (max-width: 991px) {
    .left-sidebar {
        width: 100%;
    }
}
</style>
