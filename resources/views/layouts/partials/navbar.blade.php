{{-- ================================================
FILE: resources/views/partials/navbar.blade.php
FUNGSI: Navigation bar untuk customer di toko kamera Instax
================================================ --}}

<nav class="navbar navbar-expand-lg navbar-light shadow-lg sticky-top" style="background: linear-gradient(to right, #EFF6F8, #DDEEF2);">
    <div class="container">
        {{-- Logo & Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="color: #6b98a5; font-weight: bold; font-size: 1.5rem;">
            <i class="bi bi-camera-fill me-2" style="font-size: 1.8rem; color: #4a7c8b;"></i>
            Instax Shop
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Search Form --}}
            <form class="mx-auto" style="max-width: 420px;" action="{{ route('catalog.index') }}" method="GET">
                <div class="position-relative">
                    <input type="text" name="q" class="form-control rounded-pill ps-5 py-2 shadow-sm bg-white border-0"
                        placeholder="Cari kamera" value="{{ request('q') }}" style="transition: all 0.3s;">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                </div>
            </form>

            {{-- Right Menu --}}
            <ul class="navbar-nav ms-auto align-items-center">
                {{-- Katalog --}}
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('catalog.index') }}">
                        <i class="bi bi-grid me-1"></i> Katalog
                    </a>
                </li>

                @auth
                    {{-- Wishlist --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative px-3" href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart"></i>
                            @if (auth()->user()->wishlists()->count() > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 0.6rem;">
                                    {{ auth()->user()->wishlists()->count() }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative px-3" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3"></i>
                            @php
                                $cartCount = auth()->user()->cart?->items()->count() ?? 0;
                            @endphp
                            @if ($cartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                    style="font-size: 0.6rem;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center px-3" href="#" id="userDropdown"
                            data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle me-2 shadow-sm" width="32"
                                height="32" alt="{{ auth()->user()->name }}">
                            <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag me-2"></i> Pesanan Saya
                                </a>
                            </li>
                            @if (auth()->user()->isAdmin())
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-primary py-2" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin Panel
                                    </a>
                                </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger py-2">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Guest Links --}}
                    <li class="nav-item">
                        <a class="nav-link px-3" id="masuk" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-secondary btn-sm ms-2 px-4 py-2" id="daftar" href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        transition: background-color 0.3s ease;
    }

    .navbar-brand:hover {
        color: #4a7c8b;
    }

    .nav-link {
        color: #6b98a5;
        transition: color 0.3s, transform 0.3s;
    }

    .nav-link:hover {
        color: #4a7c8b;
        transform: translateY(-2px);
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(107, 152, 165, 0.25);
        border-color: #6b98a5;
    }

    .dropdown-menu {
        background-color: #EFF6F8;
    }

    .dropdown-item:hover {
        background-color: #DDEEF2;
    }

    #daftar {
        border-radius: 20px;
        border-color: #6b98a5;
        color: #6b98a5;
        transition: background-color 0.3s, color 0.3s, transform 0.3s;
    }

    #daftar:hover {
        background-color: #6b98a5;
        color: white;
        transform: translateY(-2px);
    }

    #masuk {
        border-radius: 20px;
        background-color: #6b98a5;
        color: white;
        transition: background-color 0.3s, color 0.3s, transform 0.3s;
    }

    #masuk:hover {
        background-color: #4a7c8b;
        color: white;
        transform: translateY(-2px);
    }
</style>
