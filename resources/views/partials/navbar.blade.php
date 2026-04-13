@php
    $cartCount = auth()->check()
        ? (auth()->user()->cart?->items()->count() ?? 0)
        : 0;

    $wishlistCount = auth()->check()
        ? auth()->user()->wishlists()->count()
        : 0;
@endphp

<div class="top-strip d-none d-lg-flex justify-content-between align-items-center px-4 py-2">
    <div class="d-flex gap-3 small text-white-75">
        <a href="#" class="top-strip-link">Mulai Jadi Event Creator</a>
        <a href="#" class="top-strip-link">Biaya</a>
        <a href="#" class="top-strip-link">Blog</a>
        <a href="#" class="top-strip-link">Pusat Bantuan</a>
    </div>
    <div class="d-flex gap-3 small text-white-50">
        <span>#Promo_Indodana</span>
        <span>#LOKETPlus</span>
        <span>#LOKETScreen</span>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark navbar-loket sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}">
            <span class="brand-mark">LOKET</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <form class="navbar-search mx-auto d-none d-lg-flex align-items-center" action="{{ route('catalog.index') }}" method="GET">
                <div class="input-group shadow-sm w-100">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control rounded-pill ps-2 py-2 border-0" placeholder="Cari event seru di sini" value="{{ request('q') }}">
                </div>
            </form>

            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item d-lg-none w-100 mb-2">
                    <form action="{{ route('catalog.index') }}" method="GET">
                        <div class="input-group shadow-sm w-100">
                            <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="q" class="form-control rounded-pill ps-2 py-2 border-0" placeholder="Cari event seru di sini" value="{{ request('q') }}">
                        </div>
                    </form>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 text-white-75" href="{{ route('catalog.index') }}">Jelajah</a>
                </li>

                @auth
                    <li class="nav-item d-lg-none">
                        <a class="nav-link px-3 text-white-75" href="{{ route('wishlist.index') }}">Wishlist</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link px-3 text-white-75" href="{{ route('cart.index') }}">Keranjang</a>
                    </li>
                @endauth

                @auth
                    <li class="nav-item d-none d-lg-inline">
                        <a class="nav-link px-3 text-white-75" href="{{ route('wishlist.index') }}">Wishlist</a>
                    </li>
                    <li class="nav-item d-none d-lg-inline">
                        <a class="nav-link px-3 text-white-75" href="{{ route('cart.index') }}">Keranjang</a>
                    </li>
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center px-3" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle me-2 user-avatar" width="32" height="32" alt="{{ auth()->user()->name }}">
                            <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                            <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('orders.index') }}"><i class="bi bi-bag me-2"></i>Pesanan Saya</a></li>
                            @if (auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-primary py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger py-2"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item d-lg-none">
                        <a class="nav-link px-3 text-white-75" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link px-3 text-white-75" href="{{ route('register') }}">Daftar</a>
                    </li>
                    <li class="nav-item d-none d-lg-inline">
                        <a class="nav-link px-3 text-white-75" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm rounded-pill px-4 py-2" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    .top-strip {
        background: #0d2a61;
    }

    .top-strip-link,
    .navbar-loket .nav-link,
    .navbar-loket .brand-mark {
        color: rgba(255,255,255,.92);
    }

    .top-strip-link:hover,
    .navbar-loket .nav-link:hover,
    .navbar-loket .navbar-brand:hover {
        color: #ffffff;
        text-decoration: none;
    }

    .navbar-loket {
        background: linear-gradient(180deg, #0f3370 0%, #142f6e 100%);
    }

    .navbar-loket .navbar-brand {
        font-size: 1.35rem;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .navbar-search .form-control {
        border-radius: 999px;
        min-height: 46px;
        box-shadow: 0 18px 36px rgba(0, 0, 0, 0.08);
    }

    .navbar-search .input-group-text {
        border-radius: 999px 0 0 999px;
        border: none;
        background: #ffffff;
    }

    .navbar-loket .btn-outline-light {
        border-color: rgba(255,255,255,.72);
        color: #ffffff;
    }

    .navbar-loket .btn-outline-light:hover {
        background: rgba(255,255,255,.12);
        color: #ffffff;
    }

    .navbar-loket .dropdown-menu {
        background: rgba(255,255,255,.98);
        border: none;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
    }

    .navbar-loket .dropdown-item {
        color: #1f2937;
    }

    .navbar-loket .dropdown-item:hover {
        background: rgba(20, 47, 110, 0.06);
    }

    .navbar-loket .navbar-toggler {
        filter: brightness(0.95);
    }
</style>
