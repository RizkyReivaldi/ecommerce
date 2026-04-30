




@extends('layouts.app')

@section('content')<!DOCTYPE html>


<style>
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(180deg, #f6f8fc 0%, #eef2f7 100%);
}

/* === GLOBAL === */
section {
    margin-bottom: 20px;
}

/* === CAROUSEL === */
.banner-slide-img {
    height: 460px;
    object-fit: cover;
    filter: brightness(0.85);
}

.banner-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(10,20,40,0.75) 0%, rgba(10,20,40,0.2) 60%, transparent 100%);
}

.carousel-caption {
    max-width: 600px;
}

.carousel-caption h2 {
    font-size: 2.2rem;
    font-weight: 800;
}

/* === SCROLL === */
.loket-scroll::-webkit-scrollbar {
    display: none;
}
.loket-scroll {
    scroll-behavior: smooth;
}

/* === EVENT CARD (UPGRADED) === */
.loket-card {
    min-width: 250px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border-radius: 18px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.6);
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
}

.loket-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

.loket-img-wrapper img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.loket-title {
    font-weight: 600;
    font-size: 0.95rem;
}

.loket-date {
    font-size: 0.8rem;
    color: #8a8a8a;
}

.loket-price {
    font-weight: 700;
    color: #2563eb;
}

.loket-organizer {
    font-size: 0.75rem;
    color: #b0b0b0;
}

/* === PROMO (LOKET STYLE GLASS) === */
.loket-promo-banner {
    background: linear-gradient(135deg, #2563eb, #60a5fa);
    padding: 25px;
    border-radius: 20px;
    color: white;
    box-shadow: 0 15px 40px rgba(37,99,235,0.3);
}

.loket-big {
    font-size: 42px;
    font-weight: 800;
}

.loket-pill {
    background: rgba(255,255,255,0.2);
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
}

/* === POSTER === */
.loket-poster-card img {
    width: 190px;
    height: 270px;
    border-radius: 16px;
    transition: 0.35s ease;
}

.loket-poster-card img:hover {
    transform: scale(1.08);
}

/* === RANK SECTION === */
.rank-number {
    font-size: 52px;
    font-weight: 900;
    color: white;
}

.rank-banner img {
    border-radius: 14px;
}

/* === CATEGORY CARD (LOKET STYLE) === */
.category-card {
    height: 160px; /* 🔥 fixed height */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: rgba(255,255,255,0.9);
    border-radius: 16px;
    overflow: hidden;
    transition: 0.25s;
    border: 1px solid rgba(255,255,255,0.6);
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    padding-bottom: 10px;
}

.category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.12);
}

.category-img-top img {
    height: 90px;
    width: 100%;
    object-fit: cover;
    border-radius: 12px;
}

.category-name {
    font-size: 0.8rem;
    font-weight: 600;
    padding: 6px;
    color: #1f2937;

    display: -webkit-box;
    -webkit-line-clamp: 2;   /* max 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-align: center;
}   

.category-card {
    position: relative;
    padding: 6px;
    gap: 4px;
}

.category-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.35);
    opacity: 0;
    transition: 0.25s ease;
    border-radius: 16px;
}

.category-card:hover .category-overlay {
    opacity: 1;
}

/* === CREATOR (FIXED + LOKET STYLE) === */
.creator-logo-card {
    text-align: center;
    min-width: 90px;
}

.creator-logo img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.creator-name {
    font-size: 0.8rem;
    margin-top: 6px;
}

/* === SLIDER BUTTON === */
.custom-slider-btn {
    background: white;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

/* === SUPPORT SECTION === */
.support-illustration {
    background: rgba(255,255,255,0.1);
    border-radius: 20px;
}

.loket-tabs .nav-link {
    border-radius: 999px;
    font-weight: 500;
    color: #6b7280;
    padding: 6px 16px;
    transition: 0.2s;
}

.loket-tabs .nav-link.active {
    background: #2563eb;
    color: white;
    box-shadow: 0 5px 15px rgba(37,99,235,0.3);
}
</style> 
    <!-- The homepage content (without navbar & footer as requested) -->
    <main>

        {{-- 1. Main Banner Carousel --}}
        <section class="homepage-banner py-4">
                <div class="container-fluid px-4">

                    @if(!$hasCarouselData)
                        {{-- ✅ FALLBACK: STATIC WELCOME --}}
                        <div class="rounded-4 overflow-hidden shadow-sm position-relative">
                            <img src="https://picsum.photos/1600/500?blur=2"
                                class="w-100"
                                style="height:500px; object-fit:cover;">

                            <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                                <h1 class="fw-bold">Welcome to Loket 🎉</h1>
                                <p class="lead">Temukan event terbaik & pesan tiketmu sekarang</p>
                            </div>
                        </div>

                    @else
                        {{-- ✅ NORMAL CAROUSEL --}}
                        <div id="homepageCarousel" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-inner rounded-4 overflow-hidden shadow-sm">

                                @foreach($topCarousel as $index => $event)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">

                                        <div class="banner-slide position-relative">

                                            <img src="{{ $event->image_url }}"
                                                class="d-block w-100 banner-slide-img"
                                                alt="{{ $event->name }}">

                                            <div class="banner-overlay"></div>

                                            <div class="carousel-caption text-start text-white p-4 p-md-5">

                                                <span class="badge bg-warning text-dark mb-3">
                                                    {{ $event->category->name ?? 'Event' }}
                                                </span>

                                                <h2 class="fw-bold">
                                                    {{ $event->name }}
                                                </h2>

                                                <p class="lead mb-3">
                                                    🔥 {{ $event->total_sold }} tiket terjual
                                                </p>

                                                <a href="{{ route('products.show', $event->slug) }}"
                                                class="btn btn-light btn-lg rounded-pill px-4">
                                                    Pesan Tiket
                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>

                        </div>
                    @endif

                </div>
        </section>

        {{-- 2. Event Seru Lagi Nunggu Kamu --}}
        <section class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">Event Seru Lagi Nunggu Kamu</h4>
                    <a href="#" class="text-primary fw-semibold text-decoration-none">See more →</a>
                </div>
                <div class="d-flex gap-4 overflow-auto pb-2 loket-scroll">

                    @foreach($eventSeru as $product)
                        <div style="min-width: 250px; max-width: 250px; flex-shrink: 0;">

                            <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden loket-card">

                                {{-- IMAGE --}}
                                <div class="position-relative">
                                    <a href="{{ route('catalog.show', $product->slug) }}">
                                        <img src="{{ $product->image_url }}"
                                            onerror="this.onerror=null;this.src='{{ asset('images/no-product-image.svg') }}';"
                                            class="w-100"
                                            alt="{{ $product->name }}"
                                            style="aspect-ratio: 16/9; object-fit: cover;">
                                    </a>

                                    @if($product->has_discount)
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 small">
                                            -{{ $product->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>

                                {{-- BODY --}}
                                <div class="card-body px-3 pt-3 pb-2 d-flex flex-column">

                                    <h6 class="fw-semibold mb-1" style="font-size: 0.95rem;">
                                        <a href="{{ route('catalog.show', $product->slug) }}"
                                        class="text-dark text-decoration-none card-title-link">
                                            {{ Str::limit($product->name, 45) }}
                                        </a>
                                    </h6>

                                    <p class="text-muted mb-2" style="font-size: 0.8rem;">
                                        {{ \Carbon\Carbon::parse($product->event_date ?? now())->format('d M Y') }}
                                    </p>

                                    <div class="mt-auto">
                                        <span class="fw-bold text-primary">
                                            {{ $product->formatted_price }}
                                        </span>
                                    </div>
                                </div>

                                <div class="px-3">
                                    <hr class="my-1" style="opacity: 0.08;">
                                </div>

                                <div class="px-3 pb-3 pt-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                            style="width: 26px; height: 26px;">
                                            <i class="bi bi-shop small text-secondary"></i>
                                        </div>

                                        <small class="text-muted fw-medium" style="font-size: 0.8rem;">
                                            {{ $product->organizer ?? 'Event Organizer' }}
                                        </small>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </section>  


        {{-- 3. TOP 3 BEST SELLER (Ranking) --}}
        <section class="py-5" style="background: linear-gradient(105deg, #102a54, #0b1f44);">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center gap-4 flex-wrap">

                    @forelse($topEvents as $index => $event)
                        <div class="top-rank-item d-flex align-items-center gap-3">

                            <div class="rank-number">
                                {{ $index + 1 }}
                            </div>

                            <div class="rank-banner">
                                <img src="{{ $event->image_url }}" alt="{{ $event->name }}">
                            </div>

                            <div class="text-white">
                                <strong>{{ $event->name }}</strong><br>
                                <small>{{ $event->total_sold }} tiket terjual</small>
                            </div>

                        </div>
                    @empty
                        <p class="text-white">Belum ada data penjualan</p>
                    @endforelse

                </div>
            </div>
        </section>

        {{-- 3. Program Belajar Terpopuler --}}
        <section class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">Program Belajar Terpopuler</h4>
                    <a href="#" class="text-primary fw-semibold text-decoration-none">See more →</a>
                </div>
                <div class="d-flex gap-4 overflow-auto pb-2 loket-scroll">

                    @foreach($programbelajar as $product)
                        <div style="min-width: 250px; max-width: 250px; flex-shrink: 0;">

                            <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden loket-card">

                                {{-- IMAGE --}}
                                <div class="position-relative">
                                    <a href="{{ route('catalog.show', $product->slug) }}">
                                        <img src="{{ $product->image_url }}"
                                            onerror="this.onerror=null;this.src='{{ asset('images/no-product-image.svg') }}';"
                                            class="w-100"
                                            alt="{{ $product->name }}"
                                            style="aspect-ratio: 16/9; object-fit: cover;">
                                    </a>

                                    @if($product->has_discount)
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 small">
                                            -{{ $product->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>

                                {{-- BODY --}}
                                <div class="card-body px-3 pt-3 pb-2 d-flex flex-column">

                                    <h6 class="fw-semibold mb-1" style="font-size: 0.95rem;">
                                        <a href="{{ route('catalog.show', $product->slug) }}"
                                        class="text-dark text-decoration-none card-title-link">
                                            {{ Str::limit($product->name, 45) }}
                                        </a>
                                    </h6>

                                    <p class="text-muted mb-2" style="font-size: 0.8rem;">
                                        {{ \Carbon\Carbon::parse($product->event_date ?? now())->format('d M Y') }}
                                    </p>

                                    <div class="mt-auto">
                                        <span class="fw-bold text-primary">
                                            {{ $product->formatted_price }}
                                        </span>
                                    </div>
                                </div>

                                <div class="px-3">
                                    <hr class="my-1" style="opacity: 0.08;">
                                </div>

                                <div class="px-3 pb-3 pt-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                            style="width: 26px; height: 26px;">
                                            <i class="bi bi-shop small text-secondary"></i>
                                        </div>

                                        <small class="text-muted fw-medium" style="font-size: 0.8rem;">
                                            {{ $product->organizer ?? 'Event Organizer' }}
                                        </small>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </section>  


        {{-- 4. PROMO BANNER (Loket Creator style) --}}
        <section class="py-3">
            <div class="container">
                <div class="loket-promo-banner d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center gap-3">
                        <div class="fw-bold fs-5">LOKET<span class="fw-light">Creator</span></div>
                        <div class="loket-pill">Biaya Komisi</div>
                    </div>
                    <div class="loket-promo-center text-center">
                        <div class="loket-big">1,2%</div>
                        <small class="text-secondary">Sudah termasuk PPN</small>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="loket-pill">Semua event creator</div>
                        <div class="loket-hashtag">#PASTIBISA</div>
                    </div>
                </div>
            </div>
        </section>        

        {{-- 5. Event Categories (DYNAMIC + CLICKABLE) --}}
        <section id="kategori-populer" class="py-5">
            <div class="container">
                <h5 class="fw-bold mb-4">Event Categories</h5>

                <div class="d-flex gap-3 overflow-auto pb-2 loket-scroll">

                    @foreach($categories as $category)
                        <div style="width: 140px; flex-shrink: 0;">

                            <a href="{{ route('catalog.index', ['category' => $category->slug]) }}#catalog"
                            class="text-decoration-none">

                                <div class="category-card position-relative overflow-hidden">

                                    {{-- IMAGE --}}
                                    <div class="category-img-top">
                                        <img src="{{ $category->image_url ?? 'https://picsum.photos/300/200' }}">
                                    </div>
                                    {{-- OVERLAY --}}
                                    <div class="category-overlay d-flex align-items-center justify-content-center">
                                        <i class="bi bi-arrow-right-circle fs-3 text-white"></i>
                                    </div>

                                    {{-- NAME --}}
                                    <div class="category-name text-center mt-2">
                                        {{ $category->name }}
                                    </div>

                                </div>

                            </a>

                        </div>
                    @endforeach

                </div>
            </div>
        </section>


        {{-- 6. LOKET Screen (Poster style) --}}
        <section class="py-5">
            <div class="container">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="fw-bold mb-0">LOKET Screen</h4>
                        <span class="badge bg-warning text-dark">BARU</span>
                    </div>
                </div>

                {{-- Tabs --}}
                <ul class="nav nav-pills mb-4 loket-tabs" id="movieTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#now">
                             Now Showing
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#soon">
                             Coming Soon
                        </button>
                    </li>
                </ul>

                {{-- Content --}}
                <div class="tab-content">

                    {{-- NOW SHOWING --}}
                    <div class="tab-pane fade show active" id="now">
                        <div class="d-flex gap-4 overflow-auto pb-2 loket-scroll">
                            @foreach($nowShowing as $movie)
                                @include('partials.card-movie', ['product' => $movie])
                            @endforeach
                        </div>
                    </div>

                    {{-- COMING SOON --}}
                    <div class="tab-pane fade" id="soon">
                        <div class="d-flex gap-4 overflow-auto pb-2 loket-scroll">
                            @foreach($comingSoon as $movie)
                                @include('partials.card-movie', ['product' => $movie])
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </section>


        {{-- 7. Rekomendasi untukmu --}}
        <section class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">Rekomendasi untukmu</h4>
                    <a href="#" class="text-primary fw-semibold text-decoration-none">See more →</a>
                </div>
                <div class="d-flex gap-4 overflow-auto pb-2 loket-scroll">
    
                    @foreach($recommendedProducts as $product)

                        @if($product->category && strtolower($product->category->name) === 'movie')
                            @include('partials.card-movie', ['product' => $product])
                        @else
                            @include('partials.product-card-figma', ['product' => $product])
                        @endif

                    @endforeach

                </div>
            </div>
        </section>



        {{-- 8. Creator Favorite (logo circle) --}}
            <section class="py-5">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Creator Favorite</h5>
                    </div>
                    <div class="d-flex gap-4 overflow-auto pb-2 loket-scroll">
                        <div class="creator-logo-card"><div class="creator-logo"><img src="https://picsum.photos/id/64/100/100"></div><div class="creator-name">Loket Origin</div></div>
                        <div class="creator-logo-card"><div class="creator-logo"><img src="https://picsum.photos/id/82/100/100"></div><div class="creator-name">Ismaya Live</div></div>
                        <div class="creator-logo-card"><div class="creator-logo"><img src="https://picsum.photos/id/86/100/100"></div><div class="creator-name">Rajawali</div></div>
                        <div class="creator-logo-card"><div class="creator-logo"><img src="https://picsum.photos/id/123/100/100"></div><div class="creator-name">Miles Music</div></div>
                        <div class="creator-logo-card"><div class="creator-logo"><img src="https://picsum.photos/id/168/100/100"></div><div class="creator-name">JOOX Event</div></div>
                    </div>
                </div>
            </section>

        {{-- 9. Saatnya Seru-Seruan --}}
        <section class="py-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="fw-bold mb-0">Saatnya Seru-Seruan</h4>
                        <span class="badge bg-warning text-dark">NEW</span>
                    </div>
                    <a href="#" class="text-primary fw-semibold text-decoration-none">See more →</a>
                </div>
                <div class="d-flex gap-4 overflow-auto pb-2 loket-scroll">

                    @foreach($saatnyaSeru as $product)
                        <div style="min-width: 250px; max-width: 250px; flex-shrink: 0;">

                            <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden loket-card">

                                {{-- IMAGE --}}
                                <div class="position-relative">
                                    <a href="{{ route('catalog.show', $product->slug) }}">
                                        <img src="{{ $product->image_url }}"
                                            onerror="this.onerror=null;this.src='{{ asset('images/no-product-image.svg') }}';"
                                            class="w-100"
                                            alt="{{ $product->name }}"
                                            style="aspect-ratio: 16/9; object-fit: cover;">
                                    </a>

                                    @if($product->has_discount)
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 small">
                                            -{{ $product->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>

                                {{-- BODY --}}
                                <div class="card-body px-3 pt-3 pb-2 d-flex flex-column">

                                    <h6 class="fw-semibold mb-1" style="font-size: 0.95rem;">
                                        <a href="{{ route('catalog.show', $product->slug) }}"
                                        class="text-dark text-decoration-none card-title-link">
                                            {{ Str::limit($product->name, 45) }}
                                        </a>
                                    </h6>

                                    <p class="text-muted mb-2" style="font-size: 0.8rem;">
                                        {{ \Carbon\Carbon::parse($product->event_date ?? now())->format('d M Y') }}
                                    </p>

                                    <div class="mt-auto">
                                        <span class="fw-bold text-primary">
                                            {{ $product->formatted_price }}
                                        </span>
                                    </div>
                                </div>

                                <div class="px-3">
                                    <hr class="my-1" style="opacity: 0.08;">
                                </div>

                                <div class="px-3 pb-3 pt-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                            style="width: 26px; height: 26px;">
                                            <i class="bi bi-shop small text-secondary"></i>
                                        </div>

                                        <small class="text-muted fw-medium" style="font-size: 0.8rem;">
                                            {{ $product->organizer ?? 'Event Organizer' }}
                                        </small>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        
        {{-- 10. Workshops --}}
        <section class="py-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="fw-bold mb-0">Workshop</h4>
                        <span class="badge bg-warning text-dark">NEW</span>
                    </div>
                    <a href="#" class="text-primary fw-semibold text-decoration-none">See more →</a>
                </div>
                <div class="d-flex gap-4 overflow-auto pb-2 loket-scroll">

                    @foreach($workshops as $product)
                        <div style="min-width: 250px; max-width: 250px; flex-shrink: 0;">

                            <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden loket-card">

                                {{-- IMAGE --}}
                                <div class="position-relative">
                                    <a href="{{ route('catalog.show', $product->slug) }}">
                                        <img src="{{ $product->image_url }}"
                                            onerror="this.onerror=null;this.src='{{ asset('images/no-product-image.svg') }}';"
                                            class="w-100"
                                            alt="{{ $product->name }}"
                                            style="aspect-ratio: 16/9; object-fit: cover;">
                                    </a>

                                    @if($product->has_discount)
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 small">
                                            -{{ $product->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>

                                {{-- BODY --}}
                                <div class="card-body px-3 pt-3 pb-2 d-flex flex-column">

                                    <h6 class="fw-semibold mb-1" style="font-size: 0.95rem;">
                                        <a href="{{ route('catalog.show', $product->slug) }}"
                                        class="text-dark text-decoration-none card-title-link">
                                            {{ Str::limit($product->name, 45) }}
                                        </a>
                                    </h6>

                                    <p class="text-muted mb-2" style="font-size: 0.8rem;">
                                        {{ \Carbon\Carbon::parse($product->event_date ?? now())->format('d M Y') }}
                                    </p>

                                    <div class="mt-auto">
                                        <span class="fw-bold text-primary">
                                            {{ $product->formatted_price }}
                                        </span>
                                    </div>
                                </div>

                                <div class="px-3">
                                    <hr class="my-1" style="opacity: 0.08;">
                                </div>

                                <div class="px-3 pb-3 pt-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                            style="width: 26px; height: 26px;">
                                            <i class="bi bi-shop small text-secondary"></i>
                                        </div>

                                        <small class="text-muted fw-medium" style="font-size: 0.8rem;">
                                            {{ $product->organizer ?? 'Event Organizer' }}
                                        </small>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        {{-- 11. Support & Ticketing Section --}}
        <section class="py-5" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <div class="text-white">
                            <h2 class="fw-bold mb-3">Butuh Bantuan?</h2>
                            <p class="lead mb-3">Tim support kami siap membantu Anda 24/7. Buat ticket support dan dapatkan respons cepat.</p>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle me-2"></i> Respon cepat dari tim support profesional</li>
                                <li class="mb-2"><i class="bi bi-check-circle me-2"></i> Tracking ticket komprehensif</li>
                                <li class="mb-2"><i class="bi bi-check-circle me-2"></i> Kategori prioritas penanganan</li>
                            </ul>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="#" class="btn btn-light btn-lg rounded-pill"><i class="bi bi-list-check"></i> View My Tickets</a>
                                <a href="#" class="btn btn-outline-light btn-lg rounded-pill"><i class="bi bi-plus-circle"></i> Create New Ticket</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="support-illustration p-5 text-center">
                            <i class="bi bi-headset" style="font-size: 80px; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // optional: smooth interactions
        document.querySelectorAll('.carousel').forEach(carousel => {
            new bootstrap.Carousel(carousel, { interval: 5000, wrap: true });
        });
    </script>

</html>


@endsection