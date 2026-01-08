<aside class="left-sidebar shadow-lg" style="background: linear-gradient(to bottom, #EFF6F8, #DDEEF2);">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between py-3 px-4">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img d-flex align-items-center">
                <img src="public/storage/avatars/instax-logo.png" width="50" alt="Instax Shop" class="me-2 rounded-circle shadow-sm" />
                <span style="color: #6b98a5; font-weight: bold; font-size: 1.2rem;">Instax Admin</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav" class="list-unstyled">
                <li class="nav-small-cap px-4 py-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4 text-muted"></i>
                    <span class="hide-menu text-muted">Dashboard</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link px-4 py-2" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard text-black"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap px-4 py-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4 text-muted"></i>
                    <span class="hide-menu text-muted">Main Menu</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link px-4 py-2" href="{{ route('admin.categories.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-category text-black "></i>
                        </span>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link px-4 py-2" href="{{ route('admin.products.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-package text-black"></i>
                        </span>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link px-4 py-2" href="{{ route('admin.orders.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-receipt text-black"></i>
                        </span>
                        <span class="hide-menu">Pesanan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link px-4 py-2" href="{{ route('admin.reports.sales') }}" aria-expanded="false">
                        <span>
                            <i class="bi bi-graph-up-arrow text-black"></i>
                        </span>
                        <span class="hide-menu">Laporan</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<style>
    .left-sidebar {
        transition: all 0.3s ease;
    }

    .sidebar-link {
        color: #6b98a5;
        border-radius: 8px;
        transition: background-color 0.3s, color 0.3s, transform 0.3s;
    }

    .sidebar-link:hover {
        background-color: #DDEEF2;
        color: #4a7c8b;
        transform: translateX(5px);
    }

    .nav-small-cap {
        border-bottom: 1px solid rgba(107, 152, 165, 0.1);
    }

    .brand-logo:hover span {
        color: #4a7c8b;
    }
</style>
