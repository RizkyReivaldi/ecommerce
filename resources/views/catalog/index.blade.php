@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')

<div class="instax-page-bg">
    <div class="container py-4">
        <div class="row g-4">

            {{-- FILTER (Desktop Sidebar) --}}
            <aside class="col-lg-3 d-none d-lg-block fade-up">
                <div class="instax-filter p-3 shadow-sm">

                    <h6 class="fw-semibold mb-3">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </h6>

                    <form action="{{ route('catalog.index') }}" method="GET">

                        {{-- keep query --}}
                        @foreach(request()->except('stock_min') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        {{-- Category --}}
                        <div class="mb-4">
                            <small class="fw-semibold text-muted">Kategori</small>

                            @foreach($categories as $category)
                            <div class="form-check mt-2">
                                <input class="form-check-input"
                                    type="radio"
                                    name="category"
                                    value="{{ $category->slug }}"
                                    {{ request('category') == $category->slug ? 'checked' : '' }}
                                    onchange="this.form.submit()">

                                <label class="form-check-label d-flex justify-content-between w-100">
                                    <span>{{ $category->name }}</span>
                                    <small>{{ $category->products_count }}</small>
                                </label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Price --}}
                        <div class="mb-4">
                            <small class="fw-semibold text-muted">Harga</small>
                            <div class="d-flex gap-2 mt-2">
                                <input type="number"
                                    class="form-control form-control-sm"
                                    name="min_price"
                                    placeholder="Min"
                                    value="{{ request('min_price') }}">

                                <input type="number"
                                    class="form-control form-control-sm"
                                    name="max_price"
                                    placeholder="Max"
                                    value="{{ request('max_price') }}">
                            </div>
                        </div>

                        {{-- STOCK BAR --}}
                        <div class="mb-4">
                            <small class="fw-semibold text-muted d-flex justify-content-between">
                                <span>Minimal Stok</span>
                                <span id="stockValue">
                                    {{ request('stock_min', 1) }}
                                </span>
                            </small>

                            <input type="range"
                                class="form-range mt-2"
                                min="1"
                                max="100"
                                step="1"
                                name="stock_min"
                                value="{{ request('stock_min', 1) }}"
                                oninput="document.getElementById('stockValue').innerText = this.value">

                            <button class="btn instax-btn btn-sm w-100 mt-2">
                                Terapkan
                            </button>
                        </div>

                        {{-- Discount --}}
                        <div class="form-check">
                            <input class="form-check-input"
                                type="checkbox"
                                name="on_sale"
                                value="1"
                                {{ request('on_sale') ? 'checked' : '' }}
                                onchange="this.form.submit()">

                            <label class="form-check-label">
                                Diskon
                            </label>
                        </div>

                    </form>
                </div>
            </aside>

            {{-- PRODUCT LIST --}}
            <main class="col-lg-9">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-3 fade-up">
                    <div>
                        <h5 class="mb-0 fw-semibold text-instax">
                            @if(request('q'))
                                "{{ request('q') }}"
                            @elseif(request('category'))
                                {{ $categories->firstWhere('slug', request('category'))?->name }}
                            @else
                                Semua Produk
                            @endif
                        </h5>
                        <small class="text-muted">
                            {{ $products->total() }} produk
                        </small>
                    </div>

                    {{-- SORT --}}
                    <select class="form-select form-select-sm w-auto instax-select"
                            onchange="location.href=this.value">

                        <option value="{{ request()->fullUrlWithQuery(['sort'=>'newest']) }}"
                            {{ request('sort') === 'newest' || !request('sort') ? 'selected' : '' }}>
                            Terbaru
                        </option>

                        <option value="{{ request()->fullUrlWithQuery(['sort'=>'name_asc']) }}"
                            {{ request('sort') === 'name_asc' ? 'selected' : '' }}>
                            Nama A → Z
                        </option>

                        <option value="{{ request()->fullUrlWithQuery(['sort'=>'price_asc']) }}"
                            {{ request('sort') === 'price_asc' ? 'selected' : '' }}>
                            Harga ↑
                        </option>

                        <option value="{{ request()->fullUrlWithQuery(['sort'=>'price_desc']) }}"
                            {{ request('sort') === 'price_desc' ? 'selected' : '' }}>
                            Harga ↓
                        </option>

                    </select>
                </div>

                {{-- Grid --}}
                @if($products->count())
                <div class="row g-3">
                    @foreach($products as $i => $product)
                    <div class="col-6 col-md-4 col-lg-3 fade-up"
                        style="transition-delay: {{ $i * 0.06 }}s">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                    @endforeach
                </div>

                <div class="mt-4 fade-up">
                    {{ $products->links() }}
                </div>
                @else
                <div class="text-center py-5 text-muted fade-up">
                    <i class="bi bi-box fs-1"></i>
                    <p class="mt-3">Produk tidak tersedia</p>
                </div>
                @endif

            </main>
        </div>
    </div>
</div>

{{-- SCROLL OBSERVER --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.fade-up')
        .forEach(el => observer.observe(el));
});
</script>

@endsection
