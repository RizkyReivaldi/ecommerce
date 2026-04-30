@php
    $cartCount = auth()->check()
        ? (auth()->user()->cart?->items()->count() ?? 0)
        : 0;

    $wishlistCount = auth()->check()
        ? auth()->user()->wishlists()->count()
        : 0;
@endphp

{{-- ===== TOP STRIP ===== --}}
<div class="loket-topstrip d-none d-lg-flex justify-content-between align-items-center px-4">
    <div class="d-flex align-items-center gap-4">
        <a href="{{ route('catalog.create') }}" class="topstrip-link">{{ __('Mulai Jadi Event Creator') }}</a>
        <a href="{{ route('pricing') }}" class="topstrip-link">{{ __('Biaya') }}</a>
        <a href="{{ route('blog.home') }}" class="topstrip-link">{{ __('Blog') }}</a>
        <a href="{{ route('pages.loket-plus') }}" class="topstrip-link">{{ __('LOKET X') }}</a>
        <a href="{{ route('pages.loket-screen') }}" class="topstrip-link">{{ __('LOKET Screen') }}</a>
        <a href="{{ route('pages.loket-plus') }}" class="topstrip-link">{{ __('LOKET Plus') }}</a>
        <a href="#" class="topstrip-link">{{ __('Pusat Bantuan') }}</a>
    </div>
    <div class="dropdown">
        <button class="topstrip-lang dropdown-toggle" type="button" data-bs-toggle="dropdown">
            {{ strtoupper(app()->getLocale()) }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li><a class="dropdown-item {{ app()->getLocale() === 'id' ? 'active' : '' }}" href="{{ route('locale.switch', 'id') }}">ID - Bahasa</a></li>
            <li><a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('locale.switch', 'en') }}">EN - English</a></li>
        </ul>
    </div>
</div>

{{-- ===== MAIN NAVBAR ===== --}}
<nav class="loket-navbar sticky-top">
    <div class="loket-nav-inner">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="loket-brand">LOKET</a>

        {{-- ===== KATEGORI MEGA-MENU ===== --}}
        <div class="loket-kategori-wrap" id="kategoriWrap">
            <button class="loket-kategori-btn" id="kategoriBtn" type="button" aria-expanded="false">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                {{ __('Kategori') }}
                <svg class="kat-chevron" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            </button>

            {{-- Mega menu panel --}}
            <div class="loket-megamenu" id="megaMenu">
                <div class="megamenu-body">

                    <p class="megamenu-heading">Kategori Event</p>

                    <div class="megamenu-grid">
                        @php
                            $navCategories = \App\Models\Category::orderBy('name')->get();
                            $fallbackIcons = ['🎭','💼','📸','👗','🌿','🧠','🌙','💪','♻️','🍜','🎵','⚽','🚗','🔬','🎨','🗳️','😂','🎓','🏕️','🏫'];
                        @endphp

                        @forelse($navCategories as $i => $cat)
                            <a href="{{ route('catalog.index', ['category' => $cat->id]) }}" class="megamenu-cat-item">
                                <span class="cat-icon-wrap">
                                    @if($cat->image_url)
                                        <img src="{{ $cat->image_url }}" alt="{{ $cat->name }}"
                                             onerror="this.style.display='none';this.nextElementSibling.style.display='inline'">
                                        <span style="display:none">{{ $fallbackIcons[$i % count($fallbackIcons)] }}</span>
                                    @else
                                        {{ $fallbackIcons[$i % count($fallbackIcons)] }}
                                    @endif
                                </span>
                                <span class="cat-label">{{ $cat->name }}</span>
                            </a>
                        @empty
                            @foreach([
                                ['🏠','Keluarga & Anak'],['💼','Bisnis & Keuangan'],['📷','Media & Hiburan'],['👗','Fashion & Kecantikan'],
                                ['🌿','Hobi & Gaya Hidup'],['🧠','Pengembangan Diri'],['🌙','Agama & Spiritualitas'],['💪','Kesehatan & Kebugaran'],
                                ['♻️','Lingkungan & Keberlanjutan'],['🍜','Makanan & Minuman'],['🎵','Musik'],['⚽','Olahraga & Kebugaran'],
                                ['🚗','Otomotif'],['🔬','Sains & Teknologi'],['🎨','Seni & Budaya'],['🗳️','Sosial & Politik'],
                                ['😂','Komedi & Pertunjukan'],['🎓','Pendidikan'],['🏕️','Perjalanan & Alam Terbuka'],['🏫','Aktivitas Sekolah & Kampus'],
                            ] as [$icon, $label])
                                <a href="{{ route('catalog.index') }}" class="megamenu-cat-item">
                                    <span class="cat-icon-wrap">{{ $icon }}</span>
                                    <span class="cat-label">{{ $label }}</span>
                                </a>
                            @endforeach
                        @endforelse
                    </div>

                    {{-- Apps & Services --}}
                    <p class="megamenu-heading" style="margin-top:24px;">Aplikasi & Layanan</p>
                    <div class="megamenu-apps">

                        <a href="{{ route('pages.loket-plus') }}" class="megamenu-app-card">
                            <div class="app-icon app-icon--blue">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </div>
                            <div class="app-info">
                                <strong>LOKET X</strong>
                                <span>Aplikasi companion LOKÉT yang buat pengalaman event lebih praktis!</span>
                            </div>
                            <svg class="app-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </a>

                        <a href="{{ route('pages.loket-screen') }}" class="megamenu-app-card megamenu-app-card--yellow">
                            <div class="app-icon app-icon--yellow">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                            </div>
                            <div class="app-info">
                                <strong>LOKET Screen</strong>
                                <span>Beli tiket bioskop tanpa antre! Pesan tiket & nikmati promo spesial.</span>
                            </div>
                            <svg class="app-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </a>

                        <a href="{{ route('pages.loket-plus') }}" class="megamenu-app-card megamenu-app-card--peach">
                            <div class="app-icon app-icon--peach">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                            </div>
                            <div class="app-info">
                                <strong>LOKET Plus</strong>
                                <span>Bundling tiket eksklusif harga terbaik lengkap dengan Proteksi Tiket</span>
                            </div>
                            <svg class="app-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </a>

                    </div>
                </div>
            </div>
            <div class="megamenu-backdrop" id="megaBackdrop"></div>
        </div>

        {{-- Search --}}
        <div class="loket-search-wrap">
            <form action="{{ route('catalog.index') }}" method="GET" class="position-relative">
                <div class="loket-searchbar">
                    <select name="category" class="loket-search-cat">
                        <option value="">{{ __('Semua') }}</option>
                        @foreach(\App\Models\Category::orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" id="searchInput" name="q" value="{{ request('q') }}"
                        placeholder="{{ __('Cari event seru di sini') }}"
                        autocomplete="off" class="loket-search-input">
                    <button type="submit" class="loket-search-btn">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </div>
                <div id="searchResults" class="loket-search-results"></div>
            </form>
        </div>

        {{-- Right actions --}}
        <div class="loket-nav-actions">

            <a href="{{ route('catalog.create') }}" class="loket-nav-link d-none d-lg-flex">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ __('Buat Event') }}
            </a>

            <a href="{{ route('catalog.index') }}" class="loket-nav-link d-none d-lg-flex">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
                {{ __('Jelajah') }}
            </a>

            @auth
                <a href="{{ route('wishlist.index') }}" class="loket-icon-btn position-relative d-none d-lg-flex" title="Wishlist">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    @if($wishlistCount > 0)<span class="loket-badge">{{ $wishlistCount }}</span>@endif
                </a>

                <a href="{{ route('cart.index') }}" class="loket-icon-btn position-relative d-none d-lg-flex" title="Keranjang">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    @if($cartCount > 0)<span class="loket-badge">{{ $cartCount }}</span>@endif
                </a>

                <span class="loket-divider d-none d-lg-flex"></span>

                <div class="dropdown">
                    <button class="loket-avatar-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar_url }}" width="32" height="32" class="rounded-circle" alt="{{ auth()->user()->name }}" style="object-fit:cover;border:2px solid rgba(255,255,255,0.35);">
                        <span class="d-none d-xl-inline ms-1" style="font-size:13px;color:rgba(255,255,255,.9);">{{ Str::limit(auth()->user()->name, 14) }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-1" style="min-width:210px;">
                        <li class="px-3 pt-2 pb-1">
                            <div style="font-weight:600;font-size:14px;">{{ auth()->user()->name }}</div>
                            <div style="font-size:12px;color:#888;">{{ auth()->user()->email }}</div>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2 text-primary"></i>{{ __('My Dashboard') }}</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>{{ __('Profil Saya') }}</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('orders.index') }}"><i class="bi bi-bag me-2"></i>{{ __('Pesanan Saya') }}</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('tickets.index') }}"><i class="bi bi-ticket-detailed me-2"></i>{{ __('Support Tickets') }}</a></li>
                        @if(auth()->user()->isAdmin())
                            <li><hr class="dropdown-divider my-1"></li>
                            <li><a class="dropdown-item text-primary py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>{{ __('Admin Panel') }}</a></li>
                            <li><a class="dropdown-item text-info py-2" href="{{ route('admin.tickets.dashboard') }}"><i class="bi bi-ticket me-2"></i>{{ __('Ticket Management') }}</a></li>
                        @endif
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger py-2"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <span class="loket-divider d-none d-lg-flex"></span>
                <a href="{{ route('register') }}" class="loket-btn-outline d-none d-md-inline-flex">{{ __('Daftar') }}</a>
                <a href="{{ route('login') }}" class="loket-btn-solid">{{ __('Masuk') }}</a>
            @endauth

            {{-- Mobile hamburger --}}
            <button class="loket-hamburger d-lg-none" id="mobileMenuBtn" aria-label="Menu">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
        </div>
    </div>

    {{-- Tags row --}}
    <div class="loket-tags-row d-none d-lg-flex">
        <a href="{{ route('promo.indodana') }}" class="tag-link">#Promo_Indodana</a>
        <a href="{{ route('pages.loket-plus') }}" class="tag-link">#LOKETPlus</a>
        <a href="{{ route('pages.loket-screen') }}" class="tag-link">#LOKETScreen</a>
        <a href="{{ route('pages.loket-promo') }}" class="tag-link">#LOKET_Promo</a>
        <a href="{{ route('pages.loket-attraction') }}" class="tag-link">#LoketAttraction</a>
    </div>

    {{-- Mobile slide-down menu --}}
    <div class="loket-mobile-menu" id="mobileMenu">
        <form action="{{ route('catalog.index') }}" method="GET" class="px-4 pt-3 pb-2">
            <div class="loket-searchbar">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Cari event seru di sini') }}" class="loket-search-input">
                <button type="submit" class="loket-search-btn">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </button>
            </div>
        </form>
        <a href="{{ route('catalog.create') }}" class="mobile-link">{{ __('Buat Event') }}</a>
        <a href="{{ route('catalog.index') }}" class="mobile-link">{{ __('Jelajah') }}</a>
        @auth
            <a href="{{ route('wishlist.index') }}" class="mobile-link">{{ __('Wishlist') }}</a>
            <a href="{{ route('cart.index') }}" class="mobile-link">{{ __('Keranjang') }}</a>
            <a href="{{ route('dashboard') }}" class="mobile-link">{{ __('Dashboard') }}</a>
        @else
            <a href="{{ route('register') }}" class="mobile-link">{{ __('Daftar') }}</a>
            <a href="{{ route('login') }}" class="mobile-link" style="color:#ffd166;font-weight:700;">{{ __('Masuk') }}</a>
        @endauth
    </div>
</nav>

<style>
/* ===== TOP STRIP ===== */
.loket-topstrip {
    background: #fff;
    border-bottom: 1px solid #e8ecf3;
    padding-top: 7px;
    padding-bottom: 7px;
}
.topstrip-link {
    font-size: 12px; font-weight: 500;
    color: #4a5568; text-decoration: none;
    transition: color .15s;
}
.topstrip-link:hover { color: #1b3fa0; }
.topstrip-lang {
    font-size: 11px; font-weight: 600;
    border: 1px solid #d0d5dd; border-radius: 20px;
    padding: 3px 10px; background: #fff; color: #333; cursor: pointer;
}

/* ===== MAIN NAVBAR ===== */
.loket-navbar {
    background: linear-gradient(180deg, #0f3370 0%, #142f6e 100%);
    position: sticky; top: 0; z-index: 1040;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.loket-nav-inner {
    max-width: 1280px; margin: 0 auto;
    padding: 0 20px; height: 62px;
    display: flex; align-items: center; gap: 10px;
}
.loket-brand {
    font-size: 22px; font-weight: 800;
    color: #fff; text-decoration: none;
    letter-spacing: .06em; flex-shrink: 0;
}

/* ===== KATEGORI BUTTON ===== */
.loket-kategori-wrap { position: relative; flex-shrink: 0; }
.loket-kategori-btn {
    display: flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.12);
    border: 1.5px solid rgba(255,255,255,0.25);
    border-radius: 8px; padding: 8px 14px;
    color: #fff; font-size: 13px; font-weight: 600;
    cursor: pointer; white-space: nowrap;
    transition: background .15s, border-color .15s;
}
.loket-kategori-btn:hover,
.loket-kategori-btn.active {
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.45);
}
.kat-chevron { transition: transform .2s; }
.loket-kategori-btn.active .kat-chevron { transform: rotate(180deg); }

/* ===== MEGA MENU ===== */
.loket-megamenu {
    display: none;
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    width: 820px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 16px 48px rgba(0,0,0,0.15);
    z-index: 1050;
    border: 1px solid #e8ecf3;
    animation: megaFadeIn .18s ease;
}
.loket-megamenu.open { display: block; }
@keyframes megaFadeIn {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}
.megamenu-body { padding: 24px 28px 28px; }
.megamenu-heading {
    font-size: 12px; font-weight: 700;
    color: #1a2c4e; text-transform: uppercase;
    letter-spacing: .07em; margin: 0 0 14px;
}
.megamenu-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2px;
}
.megamenu-cat-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 10px; border-radius: 8px;
    text-decoration: none; color: #1f2937;
    font-size: 13.5px; font-weight: 500;
    transition: background .12s;
}
.megamenu-cat-item:hover { background: #f0f4ff; color: #1b3fa0; }
.cat-icon-wrap {
    width: 34px; height: 34px; border-radius: 8px;
    background: #f0f4ff;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}
.cat-icon-wrap img { width: 22px; height: 22px; object-fit: cover; border-radius: 4px; }
.cat-label { line-height: 1.3; font-size: 13px; }

/* ===== APP CARDS ===== */
.megamenu-apps {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
}
.megamenu-app-card {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 14px; border-radius: 10px;
    text-decoration: none; color: #1a1a1a;
    background: #f6f8fc; border: 1px solid #e8ecf3;
    transition: box-shadow .15s, border-color .15s;
}
.megamenu-app-card:hover { box-shadow: 0 4px 14px rgba(0,0,0,0.08); border-color: #c5d0e8; color: #1a1a1a; }
.megamenu-app-card--yellow { background: #fffbee; border-color: #f5e4a0; }
.megamenu-app-card--peach  { background: #fff5f0; border-color: #f5cbb5; }
.app-icon {
    width: 38px; height: 38px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; color: #fff;
}
.app-icon--blue  { background: #1b3fa0; }
.app-icon--yellow { background: #f0a500; }
.app-icon--peach  { background: #e8602c; }
.app-info { flex: 1; min-width: 0; }
.app-info strong { display: block; font-size: 12px; font-weight: 700; color: #1a1a1a; margin-bottom: 2px; }
.app-info span   { font-size: 11px; color: #666; line-height: 1.4; display: block; }
.app-chevron { color: #bbb; flex-shrink: 0; }

/* ===== BACKDROP ===== */
.megamenu-backdrop {
    display: none; position: fixed; inset: 0;
    z-index: 1049; background: rgba(0,0,0,0.25);
}
.megamenu-backdrop.open { display: block; }

/* ===== SEARCH ===== */
.loket-search-wrap { flex: 1; min-width: 0; max-width: 620px; }
.loket-searchbar {
    display: flex; background: #fff;
    border-radius: 8px; overflow: hidden;
    height: 40px; border: 2px solid transparent;
    transition: border-color .2s;
}
.loket-searchbar:focus-within { border-color: #f0a500; }
.loket-search-cat {
    border: none; outline: none;
    padding: 0 10px 0 12px; font-size: 13px; color: #333;
    background: #f5f7fa; border-right: 1px solid #e0e4ea;
    cursor: pointer; flex-shrink: 0;
}
.loket-search-input {
    flex: 1; border: none; outline: none;
    padding: 0 12px; font-size: 14px; color: #111;
    background: #fff; min-width: 0;
}
.loket-search-btn {
    background: #f0a500; border: none; padding: 0 16px;
    cursor: pointer; color: #fff; flex-shrink: 0;
    display: flex; align-items: center;
    transition: background .15s;
}
.loket-search-btn:hover { background: #d49200; }
.loket-search-results {
    display: none; position: absolute; width: 100%;
    background: #fff; border-radius: 8px; margin-top: 6px;
    z-index: 1060; box-shadow: 0 8px 24px rgba(0,0,0,0.12); overflow: hidden;
}

/* ===== RIGHT ACTIONS ===== */
.loket-nav-actions {
    display: flex; align-items: center;
    gap: 2px; flex-shrink: 0; margin-left: auto;
}
.loket-nav-link {
    display: flex; align-items: center; gap: 6px;
    color: rgba(255,255,255,.9); text-decoration: none;
    font-size: 13px; font-weight: 500;
    padding: 8px 10px; border-radius: 6px;
    transition: background .15s; white-space: nowrap;
}
.loket-nav-link:hover { background: rgba(255,255,255,.12); color: #fff; }
.loket-icon-btn {
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,.9); text-decoration: none;
    padding: 8px; border-radius: 6px; transition: background .15s;
}
.loket-icon-btn:hover { background: rgba(255,255,255,.12); color: #fff; }
.loket-badge {
    position: absolute; top: 3px; right: 3px;
    width: 16px; height: 16px; background: #ff4757;
    border-radius: 50%; font-size: 9px; font-weight: 700; color: #fff;
    display: flex; align-items: center; justify-content: center;
    border: 1.5px solid #142f6e;
}
.loket-divider { width: 1px; height: 22px; background: rgba(255,255,255,.2); margin: 0 4px; }
.loket-avatar-btn {
    background: none; border: none; cursor: pointer;
    display: flex; align-items: center;
    padding: 4px 6px; border-radius: 6px; transition: background .15s;
}
.loket-avatar-btn:hover { background: rgba(255,255,255,.12); }
.loket-avatar-btn::after { display: none; }
.loket-btn-outline {
    border: 1.5px solid rgba(255,255,255,.75); border-radius: 24px;
    padding: 7px 18px; color: #fff; font-size: 13px; font-weight: 600;
    text-decoration: none; transition: background .15s; white-space: nowrap;
}
.loket-btn-outline:hover { background: rgba(255,255,255,.12); color: #fff; }
.loket-btn-solid {
    background: #fff; color: #1b3fa0; border-radius: 24px;
    padding: 7px 20px; font-size: 13px; font-weight: 700;
    text-decoration: none; transition: background .15s; white-space: nowrap;
}
.loket-btn-solid:hover { background: #eef2ff; color: #1b3fa0; }
.loket-hamburger {
    background: none; border: none; cursor: pointer;
    color: #fff; padding: 6px; display: flex;
}

/* ===== TAGS ROW ===== */
.loket-tags-row {
    max-width: 1280px; margin: 0 auto;
    padding: 4px 20px 8px 175px; gap: 18px;
}
.tag-link {
    font-size: 12px; color: rgba(255,255,255,.55);
    text-decoration: none; transition: color .15s;
}
.tag-link:hover { color: rgba(255,255,255,.9); }

/* ===== MOBILE MENU ===== */
.loket-mobile-menu {
    display: none; flex-direction: column;
    background: #0f3370; padding-bottom: 12px;
    border-top: 1px solid rgba(255,255,255,.1);
}
.loket-mobile-menu.open { display: flex; }
.mobile-link {
    padding: 12px 24px; color: rgba(255,255,255,.85);
    text-decoration: none; font-size: 14px; font-weight: 500;
    border-bottom: 1px solid rgba(255,255,255,.06);
    transition: background .12s;
}
.mobile-link:hover { background: rgba(255,255,255,.08); color: #fff; }

/* ===== DROPDOWN STYLE ===== */
.loket-navbar .dropdown-menu { border: none; box-shadow: 0 12px 32px rgba(0,0,0,0.1); }
.loket-navbar .dropdown-item { font-size: 14px; color: #1f2937; }
.loket-navbar .dropdown-item:hover { background: #f4f6fb; }
.loket-navbar .dropdown-divider { 
    border-top: 1px solid #dee2e6 !important; 
    margin: 0.5rem 0 !important; 
    opacity: 1 !important; 
}

/* ===== RESPONSIVE: push mega menu left if near edge ===== */
@media (max-width: 900px) {
    .loket-megamenu { width: calc(100vw - 24px); left: 0; }
    .megamenu-grid  { grid-template-columns: repeat(2, 1fr); }
    .megamenu-apps  { grid-template-columns: 1fr; }
}
</style>

<script>
(function () {
    /* ===== MEGA MENU ===== */
    const btn      = document.getElementById('kategoriBtn');
    const menu     = document.getElementById('megaMenu');
    const backdrop = document.getElementById('megaBackdrop');

    function openMenu()  {
        menu.classList.add('open');
        backdrop.classList.add('open');
        btn.classList.add('active');
        btn.setAttribute('aria-expanded','true');
    }
    function closeMenu() {
        menu.classList.remove('open');
        backdrop.classList.remove('open');
        btn.classList.remove('active');
        btn.setAttribute('aria-expanded','false');
    }

    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.classList.contains('open') ? closeMenu() : openMenu();
    });
    backdrop.addEventListener('click', closeMenu);
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeMenu(); });
    menu.addEventListener('click', function(e) { e.stopPropagation(); });

    /* ===== MOBILE MENU ===== */
    const mobileBtn  = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileBtn) mobileBtn.addEventListener('click', () => mobileMenu.classList.toggle('open'));

    /* ===== LIVE SEARCH ===== */
    const inp = document.getElementById('searchInput');
    const res = document.getElementById('searchResults');
    if (inp && res) {
        inp.addEventListener('keyup', function() {
            const q = this.value.trim();
            if (q.length < 2) { res.style.display = 'none'; return; }
            fetch('/search?q=' + encodeURIComponent(q))
                .then(r => r.json())
                .then(data => {
                    res.innerHTML = '';
                    if (!data.length) {
                        res.innerHTML = '<div style="padding:12px 16px;color:#888;font-size:14px;">Tidak ada hasil ditemukan</div>';
                    } else {
                        data.forEach(item => {
                            const a = document.createElement('a');
                            a.href = '/catalog/' + item.slug;
                            a.style.cssText = 'display:flex;align-items:center;gap:10px;padding:10px 16px;text-decoration:none;color:#1f2937;border-bottom:1px solid #f0f2f5;font-size:14px;transition:background .1s;';
                            a.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#bbb" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>' + item.name;
                            a.onmouseover = () => a.style.background = '#f8fafc';
                            a.onmouseout  = () => a.style.background = '';
                            res.appendChild(a);
                        });
                    }
                    res.style.display = 'block';
                });
        });
        document.addEventListener('click', function(e) {
            if (!inp.contains(e.target) && !res.contains(e.target)) res.style.display = 'none';
        });
    }
})();
</script>
