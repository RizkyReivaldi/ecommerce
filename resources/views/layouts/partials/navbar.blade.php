<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid px-4">

        {{-- Brand --}}
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            ADMIN PANEL
        </a>

        {{-- Toggle --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">

            {{-- LEFT MENU --}}
            <ul class="navbar-nav me-auto gap-2">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-calendar-event"></i> Events
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-tags"></i> Categories
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orders.index') }}">
                        <i class="bi bi-receipt"></i> Orders
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>

            </ul>

            {{-- RIGHT SIDE --}}
            <ul class="navbar-nav ms-auto align-items-center">

                {{-- Language Switcher --}}
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="adminLanguageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="adminLanguageDropdown">
                        <li><a class="dropdown-item {{ app()->getLocale() === 'id' ? 'active' : '' }}" href="{{ route('locale.switch', 'id') }}">ID - Bahasa</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('locale.switch', 'en') }}">EN - English</a></li>
                    </ul>
                </li>

                {{-- Quick Action --}}
                {{-- <li class="nav-item me-2">
                    <a href="{{ route('admin.dasboard') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        + Create Event
                    </a>
                </li> --}}

                {{-- User Dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar_url }}"
                             class="rounded-circle me-2"
                             width="32"
                             height="32"
                             alt="user">
                        <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="bi bi-house me-2"></i> Back to Site
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>