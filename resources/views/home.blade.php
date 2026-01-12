@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- HERO SLIDER --}}
<section class="py-5 hero-section hero-slider">
    {{-- Slides --}}
    <div class="hero-slide active"
         style="background-image:url('{{ asset('./storage/products/images-removebg-preview.png') }}')"></div>

    <div class="hero-slide"
         style="background-image:url('{{ asset('./storage/products/25e26c3f-2e73-4dc5-bc76-baa9a6d2e8dc.jpg') }}')"></div>

    <div class="hero-slide"
         style="background-image:url('{{ asset('images/hero/hero-3.jpg') }}')"></div>

    <div class="hero-overlay"></div>

    <div class="container position-relative" style="z-index:2">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3 hero-text-white">
                    Belanja Kamera Instax<br>Mudah & Terpercaya
                </h1>

                <p class="lead mb-4 hero-text-white-muted">
                    Temukan kamera Instax original, film, dan aksesoris
                    dengan harga terbaik.
                </p>

                <a href="{{ route('catalog.index') }}" class="btn btn-cta-primary">
                    <i class="bi bi-bag me-2"></i>Mulai Belanja
                </a>
            </div>

            <div class="col-lg-6 d-none d-lg-block text-center">
                <img src="{{ asset('storage/products/images-removebg-preview.png') }}"
                     class="img-fluid hero-img">
            </div>
        </div>
    </div>
</section>

{{-- BAR --}}
<div class="section-bar"><span>Hero → Kategori</span></div>

{{-- KATEGORI --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Kategori Populer</h2>

        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                   class="text-decoration-none">
                    <div class="card glass-card text-center h-100">
                        <div class="card-body">
                            <img src="{{ $category->image_url }}"
                                 class="rounded-circle mb-3"
                                 width="80" height="80">
                            <h6 class="mb-0">{{ $category->name }}</h6>
                            <small class="text-muted">
                                {{ $category->products_count }} produk
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BAR --}}
<div class="section-bar"><span>Kategori → Unggulan</span></div>

{{-- PRODUK UNGGULAN --}}
<section class="py-5 section-soft">
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h2>Produk Unggulan</h2>
            <a href="{{ route('catalog.index') }}" class="text-muted">
                Lihat Semua →
            </a>
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

{{-- BAR --}}
<div class="section-bar"><span>Unggulan → Terbaru</span></div>

{{-- PRODUK TERBARU --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Produk Terbaru</h2>

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
