@extends('layouts.app')

@section('title', 'Jelajah Event')

@section('content')
<style>
    body {
        background: #F5F7FA;
    }

    /* Header Style */
    .loket-topbar {
        background: #1E2937;
        padding: 12px 0;
    }

    .loket-logo {
        font-weight: 900;
        font-size: 1.5rem;
        color: white;
    }

    /* Sidebar */
    .filter-sidebar {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        position: sticky;
        top: 90px;
        border: 1px solid #eee;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .filter-title {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 12px;
        color: #1E2937;
    }

    .form-switch .form-check-input {
        width: 48px;
        height: 24px;
    }

    /* Cards */
    .event-card {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #eee;
        transition: all 0.3s ease;
        background: white;
    }

    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .event-card img {
        height: 180px;
        object-fit: cover;
    }

    .event-info {
        padding: 14px;
    }

    .event-title {
        font-size: 1.05rem;
        font-weight: 600;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .event-date {
        font-size: 0.85rem;
        color: #64748B;
    }

    .event-price {
        font-weight: 700;
        color: #1E2937;
        font-size: 1.1rem;
    }

    .organizer {
        font-size: 0.8rem;
        color: #64748B;
    }
</style>

<div class="container-fluid px-lg-5 py-4">

    <div class="row g-4">

        <!-- SIDEBAR -->
        <aside class="col-lg-3 d-none d-lg-block">
            <div class="filter-sidebar">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Filter</h5>
                    <button class="btn btn-sm text-primary p-0">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </button>
                </div>

                <!-- Online Event -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Event Online</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="onlineToggle">
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <div class="filter-title">Lokasi</div>
                    <input type="text" class="form-control form-control-sm mb-2" placeholder="Cari lokasi...">

                    <div class="location-wrap" style="max-height: 200px; overflow-y: auto;">
                        <a href="#" class="d-block py-1 text-decoration-none text-dark">Semua Lokasi</a>
                        <a href="#" class="d-block py-1 text-decoration-none text-muted">Jakarta</a>
                        <a href="#" class="d-block py-1 text-decoration-none text-muted">Bandung</a>
                        <a href="#" class="d-block py-1 text-decoration-none text-muted">Bali</a>
                        <a href="#" class="d-block py-1 text-decoration-none text-muted">Surabaya</a>
                        <!-- Add more as needed -->
                    </div>
                </div>

                <!-- Other Filters -->
                <div class="mb-3">
                    <div class="filter-title d-flex justify-content-between">
                        Tipe Event <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="filter-title d-flex justify-content-between">
                        Kategori Event <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="filter-title d-flex justify-content-between">
                        Waktu <i class="bi bi-chevron-down"></i>
                    </div>
                </div>

                <!-- Price -->
                <div>
                    <div class="filter-title">Harga</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price" id="berbayar" checked>
                        <label class="form-check-label" for="berbayar">Berbayar</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price" id="gratis">
                        <label class="form-check-label" for="gratis">Gratis</label>
                    </div>
                </div>

            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="col-lg-9">

            <!-- Top Header -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div class="small text-muted">
                    Menampilkan <strong>{{ $products->firstItem() }} - {{ $products->lastItem() }}</strong> 
                    dari <strong>{{ $products->total() }}</strong> event
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="small text-muted">Urutkan:</span>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option value="terdekat">Waktu Mulai (Terdekat)</option>
                        <option value="price_low">Harga Terendah</option>
                        <option value="price_high">Harga Tertinggi</option>
                    </select>
                </div>
            </div>

            <!-- Event Grid -->
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <div class="event-card h-100">
                        @include('partials.product-card-figma', ['product' => $product])
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>

        </main>
    </div>
</div>
@endsection