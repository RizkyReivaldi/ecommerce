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

                    <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}"
                       class="instax-badge mb-2 d-inline-block">
                        {{ $product->category->name }}
                    </a>

                    <h2 class="fw-bold text-instax mb-3 product-title">
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
                        <span class="badge stock-badge success">
                            <i class="bi bi-check-circle"></i>
                            Stok tersedia ({{ $product->stock }})
                        </span>
                        @elseif($product->stock > 0)
                        <span class="badge stock-badge warning">
                            <i class="bi bi-exclamation-triangle"></i>
                            Sisa {{ $product->stock }}
                        </span>
                        @else
                        <span class="badge stock-badge danger">
                            <i class="bi bi-x-circle"></i>
                            Stok habis
                        </span>
                        @endif
                    </div>

                    {{-- Add to Cart --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row g-3 align-items-end">
                            <div class="col-auto">
                                <label class="form-label qty-label">Jumlah</label>
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

                            <div class="col">
                                <button type="submit"
                                        class="btn btn-instax btn-lg w-100 solid-btn"
                                        @if($product->stock == 0) disabled @endif>
                                    <i class="bi bi-cart-plus me-2"></i>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </form>

                    @auth
                    <button type="button"
                        onclick="toggleWishlist({{ $product->id }})"
                        class="btn btn-outline-instax mb-4 wishlist-btn-{{ $product->id }}">
                        <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart' }} me-2"></i>
                        {{ auth()->user()->hasInWishlist($product) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                    </button>
                    @endauth

                    <hr>

                    <h6 class="fw-bold text-instax mb-2">Deskripsi Produk</h6>
                    <p class="product-desc">{!! $product->description !!}</p>

                    <div class="row small meta-info mt-3">
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


