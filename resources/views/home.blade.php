@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<section class="homepage-banner py-4 bg-white">
    <div class="container">
        <div id="homepageCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded-4 overflow-hidden shadow-sm">
                @foreach($featuredProducts->take(4) as $product)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="banner-slide position-relative">
                        <img src="{{ $product->image_url }}" class="d-block w-100 banner-slide-img" alt="{{ $product->name }}">
                        <div class="banner-overlay"></div>
                        <div class="carousel-caption text-start text-white p-4 p-md-5">
                            <span class="badge bg-primary mb-3">Featured</span>
                            <h2 class="fw-bold">{{ $product->name }}</h2>
                            <p class="lead mb-3">Harga mulai dari Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('catalog.index') }}" class="btn btn-light btn-lg rounded-pill">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<section class="homepage-hero">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6 hero-intro">
                <span class="eyebrow">Marketplace Kamera Instax</span>
                <h1 class="display-4 fw-bold hero-title">
                    Belanja Kamera Instax & Aksesoris dengan Cepat dan Aman
                </h1>
                <p class="hero-copy">
                    Temukan koleksi Instax original, film, dan aksesoris terbaik dengan
                    rekomendasi produk terpercaya. Belanja sekarang, nikmati layanan cepat,
                    ongkir ramah, dan pembayaran mudah.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 hero-actions">
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-bag me-2"></i>Mulai Belanja
                    </a>
                    <a href="#kategori-populer" class="btn btn-outline-secondary btn-lg">
                        Lihat Kategori
                    </a>
                </div>

                <div class="hero-trust mt-5">
                    <div class="hero-trust-badge">
                        <i class="bi bi-shield-check"></i>
                        Original & Terpercaya
                    </div>
                    <div class="hero-trust-badge">
                        <i class="bi bi-truck"></i>
                        Pengiriman Aman
                    </div>
                    <div class="hero-trust-badge">
                        <i class="bi bi-wallet2"></i>
                        Pembayaran Mudah
                    </div>
                </div>
            </div>

            <div class="col-lg-6 hero-aside">
                <div class="hero-panel">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3>Temukan produk favorit</h3>
                            <p class="mb-0">Kategori terpopuler, pilihan produk bestseller, dan rekomendasi eksklusif.</p>
                        </div>
                        <span class="badge bg-primary text-white">#1 Instax</span>
                    </div>

                    <div class="row gx-3 gy-3 hero-card-meta">
                        <div class="col-12">
                            <div class="hero-step">
                                <span class="hero-step-icon"><i class="bi bi-search"></i></span>
                                <div>
                                    <strong>Cari produk yang Anda butuhkan</strong>
                                    <p class="mb-0">Akses kamera, film, dan aksesoris Instax dalam satu tempat.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="hero-step">
                                <span class="hero-step-icon"><i class="bi bi-check2-circle"></i></span>
                                <div>
                                    <strong>Produk asli, garansi jelas</strong>
                                    <p class="mb-0">Semua produk terjamin original dan dikirim cepat.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hero-category-list mt-4">
                        @foreach($categories->take(6) as $category)
                        <div class="hero-category-item">
                            <i class="bi bi-arrow-right-short"></i>
                            {{ $category->name }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="section-headline text-center mx-auto mb-5" style="max-width: 680px;">
            <h2>Semua kebutuhan Instax dalam satu halaman</h2>
            <p>Temukan kamera, film, dan aksesoris Instax yang paling dicari, lengkap dengan layanan belanja cepat, aman, dan mudah.</p>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="feature-card p-4 h-100">
                    <div class="mb-3 text-primary fs-3"><i class="bi bi-bag-check"></i></div>
                    <h5>Belanja cepat & mudah</h5>
                    <p class="mb-0 text-muted">Cari produk Instax favorit dan checkout dalam beberapa klik saja.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="feature-card p-4 h-100">
                    <div class="mb-3 text-primary fs-3"><i class="bi bi-shield-lock"></i></div>
                    <h5>Jaminan produk asli</h5>
                    <p class="mb-0 text-muted">Semua kamera dan film Instax kami dijamin original dan berkualitas tinggi.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="feature-card p-4 h-100">
                    <div class="mb-3 text-primary fs-3"><i class="bi bi-truck"></i></div>
                    <h5>Pengiriman aman</h5>
                    <p class="mb-0 text-muted">Dapatkan paketmu dengan pengiriman cepat dan packing yang terjamin.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="feature-card p-4 h-100">
                    <div class="mb-3 text-primary fs-3"><i class="bi bi-wallet2"></i></div>
                    <h5>Pembayaran fleksibel</h5>
                    <p class="mb-0 text-muted">Pilih metode pembayaran yang paling nyaman untukmu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="kategori-populer" class="py-5 category-section">
    <div class="container">
        <div class="section-headline text-center mx-auto">
            <h2>Kategori Populer</h2>
            <p>Telusuri kategori terbaik kami berdasarkan produk terlaris dan pilihan pelanggan.</p>
        </div>

        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                    <div class="category-card text-center p-4 h-100">
                        <div class="mb-3">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" width="72" height="72">
                        </div>
                        <h6 class="mb-1">{{ $category->name }}</h6>
                        <small class="text-muted">{{ $category->products_count }} produk</small>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="section-headline text-center mx-auto mb-5" style="max-width: 680px;">
            <h2>Belanja instax dengan percaya diri</h2>
            <p>Marketplace kami menghadirkan pilihan terbaik, reputasi terpercaya, dan proses yang lancar untuk setiap pembelian.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card p-4 h-100 text-center">
                    <div class="mb-3 text-primary fs-1">4.8/5</div>
                    <h5>Rating pelanggan</h5>
                    <p class="mb-0 text-muted">Dipercaya oleh pelanggan yang puas untuk kualitas produk dan layanan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-4 h-100 text-center">
                    <div class="mb-3 text-primary fs-1">1200+</div>
                    <h5>Produk tersedia</h5>
                    <p class="mb-0 text-muted">Ribuan pilihan kamera, film, dan aksesoris Instax yang dapat langsung dipesan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-4 h-100 text-center">
                    <div class="mb-3 text-primary fs-1">99%</div>
                    <h5>Transaksi sukses</h5>
                    <p class="mb-0 text-muted">Mayoritas pembeli menerima pesanan tepat waktu dan sesuai ekspektasi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 section-soft">
    <div class="container">
        <div class="section-headline text-center mx-auto">
            <h2>Produk Unggulan</h2>
            <p>Pilih dari daftar produk favorit dengan ulasan terbaik dan diskon eksklusif.</p>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="section-headline text-center mx-auto">
            <h2>Produk Terbaru</h2>
            <p>Temukan produk terbaru kami yang baru saja masuk ke toko.</p>
        </div>

        <div class="row g-4">
            @foreach($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
