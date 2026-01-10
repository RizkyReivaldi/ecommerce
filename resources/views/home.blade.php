@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- HERO SECTION --}}
<section class="py-5 hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">
                    Belanja Kamera Instax<br>Mudah & Terpercaya
                </h1>
                <p class="lead mb-4 text-muted">
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

<div class="instax-divider"></div>

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
