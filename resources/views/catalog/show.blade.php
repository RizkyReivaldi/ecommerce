@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb instax-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index') }}">Katalog</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}">
                    {{ $product->category->name }}
                </a>
            </li>
            <li class="breadcrumb-item active">
                {{ Str::limit($product->name, 30) }}
            </li>
        </ol>
    </nav>

    <div class="row g-5">
        {{-- PRODUCT IMAGE --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm instax-card">
                <div class="position-relative">
                    <img src="{{ $product->image_url }}"
                         id="main-image"
                         class="card-img-top product-detail-img"
                         alt="{{ $product->name }}">

                    @if($product->has_discount)
                    <span class="badge badge-instax-discount fs-6">
                        -{{ $product->discount_percentage }}%
                    </span>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if($product->images->count() > 1)
                <div class="card-body pt-3">
                    <div class="d-flex gap-2 overflow-auto">
                        @foreach($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                             class="instax-thumb"
                             onclick="document.getElementById('main-image').src = this.src">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- PRODUCT INFO --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm instax-card">
                <div class="card-body p-4">

                    {{-- Category --}}
                    <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}"
                       class="instax-badge mb-2 d-inline-block">
                        {{ $product->category->name }}
                    </a>

                    {{-- Title --}}
                    <h2 class="fw-bold text-instax mb-3">
                        {{ $product->name }}
                    </h2>

                    {{-- Price --}}
                    <div class="mb-4">
                        @if($product->has_discount)
                        <small class="text-muted text-decoration-line-through">
                            {{ $product->formatted_original_price }}
                        </small>
                        @endif
                        <div class="fs-3 fw-bold price-instax">
                            {{ $product->formatted_price }}
                        </div>
                    </div>

                    {{-- Stock --}}
                    <div class="mb-4">
                        @if($product->stock > 10)
                        <span class="badge bg-success-subtle text-success">
                            <i class="bi bi-check-circle"></i> Stok tersedia
                        </span>
                        @elseif($product->stock > 0)
                        <span class="badge bg-warning-subtle text-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                            Stok tinggal {{ $product->stock }}
                        </span>
                        @else
                        <span class="badge bg-danger-subtle text-danger">
                            <i class="bi bi-x-circle"></i> Stok habis
                        </span>
                        @endif
                    </div>

                    {{-- Add to Cart --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row g-3 align-items-end">
                            <div class="col-auto">
                                <label class="form-label text-muted">Jumlah</label>
                                <div class="input-group instax-qty">
                                    <button type="button" onclick="decrementQty()">−</button>
                                    <input type="number"
                                           name="quantity"
                                           id="quantity"
                                           value="1"
                                           min="1"
                                           max="{{ $product->stock }}">
                                    <button type="button" onclick="incrementQty()">+</button>
                                </div>
                            </div>

                            <div class="col ">
                                <button type="submit"
                                        class="btn btn-instax btn-lg w-100"
                                        @if($product->stock == 0) disabled @endif>
                                    <i class="bi bi-cart-plus me-2" ></i>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Wishlist --}}
                    @auth
                    <button type="button"
                        onclick="toggleWishlist({{ $product->id }})"
                        class="btn btn-outline-instax mb-4 wishlist-btn-{{ $product->id }}">
                        <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart' }} me-2"></i>
                        {{ auth()->user()->hasInWishlist($product) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                    </button>
                    @endauth

                    <hr>

                    {{-- Description --}}
                    <h6 class="fw-bold text-instax mb-2">Deskripsi Produk</h6>
                    <p class="text-muted">{!! $product->description !!}</p>

                    <div class="row text-muted small mt-3">
                        <div class="col-6">
                            <i class="bi bi-box"></i> Berat: {{ $product->weight }} gram
                        </div>
                        <div class="col-6">
                            <i class="bi bi-tag"></i> SKU: PROD-{{ $product->id }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function incrementQty() {
    const i = document.getElementById('quantity');
    if (+i.value < +i.max) i.value++;
}
function decrementQty() {
    const i = document.getElementById('quantity');
    if (+i.value > 1) i.value--;
}
</script>
@endpush
@endsection

<style>
    /* ===== INSTAX DETAIL PAGE ===== */

.instax-card {
    border-radius: 20px;
}

.product-detail-img {
    height: 420px;
    object-fit: contain;
    background: #f8f9fa;
}

.instax-thumb {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 12px;
    border: 2px solid transparent;
    cursor: pointer;
    transition: 0.3s;
}

.instax-thumb:hover {
    border-color: #6b98a5;
}

.instax-breadcrumb a {
    color: #6b98a5;
    text-decoration: none;
}

.instax-breadcrumb a:hover {
    color: #4a7c8b;
}

.instax-qty {
    border: 2px solid #6b98a5;
    border-radius: 30px;
    overflow: hidden;
}

.instax-qty button {
    background: none;
    border: none;
    padding: 8px 14px;
    color: #6b98a5;
    font-size: 1.2rem;
}

.instax-qty input {
    border: none;
    width: 50px;
    text-align: center;
}


</style>
