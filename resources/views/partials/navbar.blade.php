@php
    $cartCount = auth()->check()
        ? (auth()->user()->cart?->items()->count() ?? 0)
        : 0;

    $wishlistCount = auth()->check()
        ? auth()->user()->wishlists()->count()
        : 0;
@endphp


<nav class="navbar navbar-expand-lg instax-navbar sticky-top">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <i class="bi bi-camera-fill me-2 brand-icon"></i>
            <span class="fw-bold">Instax Shop</span>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            {{-- Search --}}
            <form class="mx-auto navbar-search" action="{{ route('catalog.index') }}" method="GET">
                <input
                    type="text"
                    name="q"
                    class="form-control"
                    placeholder=" 🔍  Cari kamera Instx"
                    value="{{ request('q') }}">
            </form>

            {{-- Right Menu --}}
            <ul class="navbar-nav ms-auto align-items-center gap-1">

                {{-- Catalog --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog.index') }}">
                        <i class="bi bi-grid me-1"></i>
                        <span>Katalog</span>
                    </a>
                </li>

                {{-- Theme Toggle (REQUIRED by app.blade.js) --}}
                <li class="nav-item ms-1">
                    <button id="themeToggle"
                            type="button"
                            class="btn theme-toggle-btn"
                            aria-label="Toggle theme">
                        🌙
                    </button>
                </li>

                @auth
                    {{-- Wishlist --}}
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('wishlist.index') }}">
                                <i class="bi bi-heart"></i>

                                <span
                                    id="wishlist-count"
                                    class="badge badge-dot bg-danger"
                                    style="{{ auth()->user()->wishlists()->count() > 0 ? '' : 'display:none' }}"
                                >
                                    {{ auth()->user()->wishlists()->count() }}
                                </span>
                            </a>
                        </li>
                    {{-- Cart --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3"></i>

                            <span
                                id="cart-count"
                                class="badge badge-dot bg-primary"
                                style="{{ $cartCount > 0 ? '' : 'display:none' }}"
                            >
                                {{ $cartCount }}
                            </span>
                        </a>
                    </li>
                    {{-- User --}}
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                           href="#"
                           data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar_url }}"
                                 class="rounded-circle me-2 user-avatar"
                                 alt="Avatar">
                            <span class="d-none d-lg-inline">
                                {{ auth()->user()->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end glass-dropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag me-2"></i> Pesanan
                                </a>
                            </li>

                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-primary" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin Panel
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-2">
                        <a class="btn btn-login" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-register" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
