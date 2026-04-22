@php
    $cartCount = auth()->check()
        ? (auth()->user()->cart?->items()->count() ?? 0)
        : 0;

    $wishlistCount = auth()->check()
        ? auth()->user()->wishlists()->count()
        : 0;

    $createEventRoute = auth()->check()
        ? route('catalog.create')
        : route('login');
@endphp

<div class="top-strip d-none d-lg-flex justify-content-end align-items-center px-4 py-1" style="background-color: #1b40a0; gap: 25px;">
    <div class="d-flex gap-4 align-items-center">
        <a href="{{ route('catalog.create') }}" style="color: white; text-decoration: none; font-size: 11px; font-weight: 500;">{{ __('Mulai Jadi Event Creator') }}</a>
        <a href="{{ route('pricing') }}" style="color: white; text-decoration: none; font-size: 11px; font-weight: 500;">{{ __('Biaya') }}</a>
        <a href="{{ route('blog.home') }}" style="color: white; text-decoration: none; font-size: 11px; font-weight: 500;">{{ __('Blog') }}</a>
        <a href="{{ route('pages.loket-plus') }}" style="color: white; text-decoration: none; font-size: 11px; font-weight: 500;">{{ __('LOKET X') }}</a>
        <a href="{{ route('pages.loket-screen') }}" style="color: white; text-decoration: none; font-size: 11px; font-weight: 500;">{{ __('LOKET Screen') }}</a>
        <a href="{{ route('pages.loket-plus') }}" style="color: white; text-decoration: none; font-size: 11px; font-weight: 500;">{{ __('LOKET Plus') }}</a>
        <a href="#" style="color: white; text-decoration: none; font-size: 11px; font-weight: 500;">{{ __('Pusat Bantuan') }}</a>
        
        <div class="dropdown lang-dropdown">
            <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 11px; font-weight: 500;">
                {{ strtoupper(app()->getLocale()) }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="languageDropdown">
                <li><a class="dropdown-item {{ app()->getLocale() === 'id' ? 'active' : '' }}" href="{{ route('locale.switch', 'id') }}">ID - Bahasa</a></li>
                <li><a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('locale.switch', 'en') }}">EN - English</a></li>
            </ul>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark navbar-loket sticky-top shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}">
            <span class="brand-mark">LOKET</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <div class="d-none d-lg-flex flex-column align-items-start ms-3" style="gap: 5px; padding-top: 10px;">
                
                <div class="d-flex justify-content-center w-100">
                    <form action="{{ route('catalog.index') }}" method="GET" style="width: 100%; max-width: 800px;">

                        <div class="input-group shadow-sm"
                            style="border-radius: 8px; overflow: hidden; background-color: #091d42; border: 1px solid rgba(255,255,255,0.2);">

                            {{-- Category --}}
                            <select name="category"
                                    style="border: none; outline: none; padding: 0 12px; background-color: #091d42; color: white; font-size: 0.85rem;">
                                <option value="">All</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>

                            {{-- Input --}}
                            <input type="text"
                                id="searchInput"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="{{ __('Cari event seru di sini') }}"
                                autocomplete="off"
                                style="flex: 1; border: none; outline: none; padding: 10px 14px; background-color: #091d42; color: white; font-size: 0.9rem;">

                            {{-- Button --}}
                            <button type="submit"
                                    style="background-color: #0d6efd; border: none; padding: 0 18px;">
                                <i class="bi bi-search text-white"></i>
                            </button>
                        </div>

                        {{-- Live Result --}}
                        <div id="searchResults"
                            style="position: absolute; width: 100%; max-width: 800px; background: white; border-radius: 8px; margin-top: 5px; display: none; z-index: 999; box-shadow: 0 6px 20px rgba(0,0,0,0.1);">
                        </div>

                    </form>
                </div>

                <div class="d-flex flex-wrap gap-3" style="font-size: 0.8rem; margin-left: 5px;">
                    <a href="{{ route('promo.indodana') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">#Promo_Indodana</a>
                    <a href="{{ route('pages.loket-plus') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">#LOKETPlus</a>
                    <a href="{{ route('pages.loket-screen') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">#LOKETScreen</a>
                    <a href="{{ route('pages.loket-promo') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">#LOKET_Promo</a>
                    <a href="{{ route('pages.loket-attraction') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">#LoketAttraction</a>
                </div>
            </div>
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
                    <a class="nav-link px-3 text-white-75" href="{{ route('catalog.create') }}"><i class="bi bi-calendar-event"></i> {{ __('Buat Event') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 text-white-75" href="{{ route('catalog.index') }}"><i class="bi bi-compass"></i> {{ __('Jelajah') }}</a>
                </li>
                

                @auth
                    <li class="nav-item d-lg-none">
                        <a class="nav-link px-3 text-white-75" href="{{ route('wishlist.index') }}">{{ __('Wishlist') }}</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link px-3 text-white-75" href="{{ route('cart.index') }}">{{ __('Keranjang') }}</a>
                    </li>
                @endauth

                @auth
                    <li class="nav-item d-none d-lg-inline">
                        <a class="nav-link px-3 text-white-75" href="{{ route('wishlist.index') }}">{{ __('Wishlist') }}</a>
                    </li>
                    <li class="nav-item d-none d-lg-inline">
                        <a class="nav-link px-3 text-white-75" href="{{ route('cart.index') }}">{{ __('Keranjang') }}</a>
                    </li>
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center px-3" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle me-2 user-avatar" width="32" height="32" alt="{{ auth()->user()->name }}">
                            <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                            <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>{{ __('My Dashboard') }}</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>{{ __('Profil Saya') }}</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('orders.index') }}"><i class="bi bi-bag me-2"></i>{{ __('Pesanan Saya') }}</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('tickets.index') }}"><i class="bi bi-ticket-detailed me-2"></i>{{ __('Support Tickets') }}</a></li>
                            @if (auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-primary py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>{{ __('Admin Panel') }}</a></li>
                                <li><a class="dropdown-item text-info py-2" href="{{ route('admin.tickets.dashboard') }}"><i class="bi bi-ticket me-2"></i>{{ __('Ticket Management') }}</a></li>
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
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm rounded-pill px-4 py-2" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm rounded-pill px-4 py-2" href="{{ route('login') }}">{{ __('Masuk') }}</a>
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

    .navbar-loket .lang-dropdown,
    .top-strip .lang-dropdown {
        position: relative;
    }

    .navbar-loket .lang-dropdown .dropdown-menu,
    .top-strip .lang-dropdown .dropdown-menu {
        min-width: 180px;
        position: absolute !important;
        top: calc(100% + 4px);
        right: 0;
        left: auto;
        z-index: 99999 !important;
    }

    .navbar-loket .lang-dropdown .dropdown-item.active,
    .navbar-loket .lang-dropdown .dropdown-item:hover {
        background: #0d6efd;
        color: #ffffff;
    }
</style>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let query = this.value;

    if (query.length < 2) {
        document.getElementById('searchResults').style.display = 'none';
        return;
    }

    fetch(`/search?q=${query}`)
        .then(res => res.json())
        .then(data => {
            let box = document.getElementById('searchResults');
            box.innerHTML = '';
            let noResultsText = "{{ __('No results') }}";

            if (data.length === 0) {
                box.innerHTML = `<div style="padding:10px;">${noResultsText}</div>`;
            } else {
                data.forEach(item => {
                    box.innerHTML += `
                        <a href="/catalog/${item.slug}" 
                           style="display:block; padding:10px; text-decoration:none; color:#333; border-bottom:1px solid #eee;">
                            ${item.name}
                        </a>
                    `;
                });
            }

            box.style.display = 'block';
        });
});
</script>