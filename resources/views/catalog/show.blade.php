@extends('layouts.app')

@section('title', $product->name)

@section('content')
<style>
    body { background: #f8f9fc; }

    /* Hero Section (unchanged) */
    .product-hero {
        position: relative;
        min-height: 420px;
        background: linear-gradient(180deg, rgba(15,23,42,0.55), rgba(15,23,42,0.9)),
                    url('{{ $product->image_url }}') center/cover no-repeat;
        color: #ffffff;
    }

    .product-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15,23,42,0.08), rgba(15,23,42,0.9));
    }

    .product-hero .hero-inner {
        position: relative;
        z-index: 1;
        padding: 80px 0 60px;
    }

    .product-hero .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.12);
        border-radius: 999px;
        padding: 0.75rem 1rem;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .product-hero .hero-meta {
        margin-top: 1.5rem;
        gap: 1rem;
        display: flex;
        flex-wrap: wrap;
    }

    .product-hero .hero-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.12);
        border-radius: 999px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
    }

    /* Detail & Card Styles */
    .product-details,
    .ticket-card {
        border-radius: 28px;
        background: #ffffff;
        box-shadow: 0 30px 70px rgba(15,23,42,0.08);
    }

    .product-details {
        padding: 32px;
    }

    /* Sticky Ticket Card (Loket Style) */
    .ticket-card {
        padding: 28px;
        position: sticky;
        top: 100px;
        transition: all 0.2s ease;
    }

    /* Section Navigation */
    .section-nav {
        background: white;
        border-radius: 60px;
        padding: 8px;
        margin-bottom: 32px;
        display: inline-flex;
        flex-wrap: wrap;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .section-nav .nav-link-custom {
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s;
        background: transparent;
    }
    .section-nav .nav-link-custom:hover {
        background: #f1f5f9;
        color: #0f172a;
    }
    .section-nav .nav-link-custom.active {
        background: #0f172a;
        color: white;
    }

    /* Section styling */
    .info-section {
        scroll-margin-top: 100px;
        margin-bottom: 48px;
    }
    .info-section h3 {
        font-weight: 800;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 3px solid #00aa5e;
        display: inline-block;
    }

    /* Ticket Row (inside "Tiket" section) */
    .ticket-row {
        padding: 1rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .ticket-row:last-child {
        border-bottom: none;
    }
    .ticket-info h6 {
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    .ticket-price {
        font-weight: 700;
        color: #0f172a;
    }
    .ticket-stock {
        font-size: 0.7rem;
        color: #64748b;
    }

    /* Quantity selector inside ticket section (optional, but keep consistent) */
    .quantity-selector {
        display: inline-flex;
        align-items: center;
        border: 1px solid #e2e8f0;
        border-radius: 40px;
        background: white;
    }
    .quantity-selector button {
        background: none;
        border: none;
        width: 32px;
        height: 32px;
        font-size: 1.2rem;
        font-weight: 600;
        color: #334155;
        border-radius: 40px;
    }
    .quantity-selector button:hover {
        background: #f1f5f9;
    }
    .quantity-selector input {
        width: 45px;
        text-align: center;
        border: none;
        font-weight: 600;
        background: transparent;
        padding: 0;
        margin: 0;
    }
    .ticket-subtotal {
        font-weight: 700;
        text-align: right;
        color: #0f172a;
    }

    /* Total Row in right card */
    .total-row {
        background: #f8fafc;
        border-radius: 20px;
        padding: 1rem;
        margin: 1.5rem 0;
    }
    .total-label {
        font-weight: 600;
        color: #1e293b;
    }
    .total-price {
        font-size: 1.6rem;
        font-weight: 800;
        color: #0f172a;
    }
    .btn-buy {
        background: #00aa5e;
        border: none;
        border-radius: 60px;
        padding: 14px 0;
        font-weight: 700;
        font-size: 1rem;
        transition: 0.2s;
    }
    .btn-buy:hover {
        background: #008c4d;
        transform: translateY(-2px);
    }
    .btn-buy:disabled {
        background: #cbd5e1;
        cursor: not-allowed;
    }

    .info-row {
        border-bottom: 1px solid #f1f5f9;
        padding: 0.9rem 0;
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        color: #64748b;
        font-size: 0.9rem;
    }
    .tag-list .badge {
        background: #f8fafc;
        color: #334155;
        font-weight: 600;
        padding: 0.5rem 1rem;
    }

    @media (max-width: 991px) {
        .ticket-card {
            position: relative;
            top: 0;
            margin-top: 2rem;
        }
        .section-nav {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="product-hero">
    <div class="container hero-inner">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="hero-badge mb-4">{{ $product->category->name ?? 'Event' }}</div>
                <h1 class="display-5 fw-bold">{{ $product->name }}</h1>
                <div class="hero-meta mt-4">
                    <span><i class="bi bi-geo-alt-fill"></i> {{ $product->location ?? 'Online Event' }}</span>
                    <span><i class="bi bi-calendar-event"></i> {{ $product->event_date ? \Carbon\Carbon::parse($product->event_date)->translatedFormat('d F Y') : 'TBA' }}</span>
                    <span><i class="bi bi-clock"></i> {{ $product->event_time ?? '15:00 - 16:00 WIB' }}</span>
                </div>
                <p class="lead text-white-75 mt-4">{{ Str::limit(strip_tags($product->description), 140) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row gx-4 gy-5">
        <div class="col-xl-8">
            {{-- In-page navigation (anchor links) --}}
            <div class="section-nav" id="page-nav">
                <a href="#deskripsi" class="nav-link-custom">Deskripsi</a>
                <a href="#tiket" class="nav-link-custom">Tiket</a>
                <a href="#syarat" class="nav-link-custom">Syarat & Ketentuan</a>
            </div>

            <div class="product-details">
                {{-- DESKRIPSI SECTION --}}
                <div id="deskripsi" class="info-section">
                    <h3>Deskripsi Event</h3>
                    <div class="text-muted">{!! $product->description !!}</div>
                </div>

                {{-- TIKET SECTION --}}
                <div id="tiket" class="info-section">
                    <h3>Pilihan Tiket</h3>
                    @php
                        $ticketTypes = isset($product->tickets) && $product->tickets->count() ? $product->tickets : collect([
                            (object) [
                                'id' => $product->id,
                                'name' => 'Tiket Reguler',
                                'price' => $product->price,
                                'stock' => $product->stock ?? 100,
                                'formatted_price' => $product->formatted_price,
                            ]
                        ]);
                    @endphp

                    @foreach($ticketTypes as $ticket)
                        <div class="ticket-row" data-ticket-id="{{ $ticket->id }}" data-price="{{ $ticket->price }}" data-max-stock="{{ $ticket->stock }}">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="ticket-info">
                                        <h6>{{ $ticket->name }}</h6>
                                        <div class="ticket-price">{{ number_format($ticket->price, 0, ',', '.') }}</div>
                                        <div class="ticket-stock">Stok tersisa: {{ $ticket->stock }}</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="quantity-selector">
                                        <button type="button" class="qty-minus" data-id="{{ $ticket->id }}">−</button>
                                        <input type="number" name="tickets[{{ $ticket->id }}]" class="ticket-qty" data-id="{{ $ticket->id }}" value="0" min="0" max="{{ $ticket->stock }}" step="1">
                                        <button type="button" class="qty-plus" data-id="{{ $ticket->id }}">+</button>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="ticket-subtotal" id="subtotal-{{ $ticket->id }}">Rp0</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- SYARAT & KETENTUAN SECTION --}}
                <div id="syarat" class="info-section">
                    <h3>Syarat dan Ketentuan</h3>
                    <ol class="text-muted">
                        <li>Tiket tidak dapat dibatalkan atau dikembalikan.</li>
                        <li>Link akses event akan dikirim maksimal H-1 melalui email.</li>
                        <li>Pastikan data pemesanan sesuai identitas.</li>
                        <li>Event dapat berubah jadwalnya dengan pemberitahuan via email.</li>
                    </ol>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2 tag-list">
                    <span class="badge rounded-pill">Rekrutmen</span>
                    <span class="badge rounded-pill">Multinasional</span>
                    <span class="badge rounded-pill">Startup</span>
                    <span class="badge rounded-pill">TipsKarir</span>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: TICKET CARD (unchanged functionality) --}}
        <div class="col-xl-4">
            <div class="ticket-card">
                <div class="ticket-header">
                    <h5>Ringkasan Pembelian</h5>
                    <p>Jumlah tiket yang dipilih akan muncul di sini</p>
                </div>

                <form id="ticket-order-form" action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <div id="ticket-list-container">
                        {{-- Hidden inputs will be populated by JS? Actually we already have inputs inside #tiket section --}}
                        {{-- But to make the form work, we need to ensure those inputs are inside the form or we replicate them. --}}
                        {{-- For simplicity, we'll keep the existing inputs inside the form (they are already inside the product-details section, but outside the form). --}}
                        {{-- Better: move the quantity inputs inside this form? But the user wants the ticket list visible in the main column. --}}
                        {{-- We'll use JavaScript to synchronize or we'll duplicate hidden fields. --}}
                        {{-- To avoid complexity, I'll add hidden inputs here that get updated by JS. --}}
                        <div id="hidden-ticket-fields"></div>
                    </div>

                    <div class="total-row d-flex justify-content-between align-items-center">
                        <span class="total-label">Total yang harus dibayar</span>
                        <span class="total-price" id="grand-total">Rp0</span>
                    </div>

                    <button type="submit" class="btn btn-buy w-100 text-white" id="buy-button" disabled>
                        <i class="bi bi-ticket-perforated me-2"></i> Beli Tiket
                    </button>
                </form>

                <hr class="my-4">

                <div class="info-row d-flex justify-content-between align-items-center">
                    <span class="info-label">Lokasi</span>
                    <strong>{{ $product->location ?? 'Online Event' }}</strong>
                </div>
                <div class="info-row d-flex justify-content-between align-items-center">
                    <span class="info-label">Tanggal & Waktu</span>
                    <strong>{{ $product->event_date ? \Carbon\Carbon::parse($product->event_date)->translatedFormat('d F Y') : '23 Mei 2026' }} • {{ $product->event_time ?? '15:00 WIB' }}</strong>
                </div>
                <div class="info-row d-flex justify-content-between align-items-center">
                    <span class="info-label">Diselenggarakan oleh</span>
                    <strong>{{ $product->organizer ?? optional(auth()->user())->name ?? 'LOKET' }}</strong>
                </div>

                <hr class="my-4">

                <div>
                    <div class="small text-muted mb-3">Bagikan Event</div>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-success"><i class="bi bi-whatsapp fs-4"></i></a>
                        <a href="#" class="text-primary"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-info"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-instagram fs-4"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recommended Events --}}
    <div class="mt-5">
        <h3 class="fw-bold mb-4">Event Untuk Kamu</h3>
        <div class="row g-4">
            @foreach($recommended as $rec)
                <div class="col-md-3 col-6">
                    <a href="{{ route('catalog.show', $rec->slug) }}" class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="{{ $rec->image_url }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $rec->name }}">
                            <div class="card-body">
                                <h6 class="fw-semibold">{{ $rec->name }}</h6>
                                <small class="text-muted">{{ $rec->formatted_price }}</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format Rupiah
        function formatRupiah(amount) {
            return 'Rp' + new Intl.NumberFormat('id-ID').format(amount);
        }

        // Update all subtotals and grand total
        function updateTotals() {
            let grandTotal = 0;
            document.querySelectorAll('.ticket-row').forEach(row => {
                const ticketId = row.dataset.ticketId;
                const price = parseInt(row.dataset.price);
                const qtyInput = row.querySelector('.ticket-qty');
                let qty = parseInt(qtyInput.value) || 0;
                const maxStock = parseInt(row.dataset.maxStock);
                if (qty > maxStock) qty = maxStock;
                if (qty < 0) qty = 0;
                qtyInput.value = qty;
                const subtotal = price * qty;
                const subtotalElem = document.getElementById(`subtotal-${ticketId}`);
                if (subtotalElem) subtotalElem.innerText = formatRupiah(subtotal);
                grandTotal += subtotal;
            });
            document.getElementById('grand-total').innerText = formatRupiah(grandTotal);
            const buyBtn = document.getElementById('buy-button');
            if (grandTotal <= 0) {
                buyBtn.disabled = true;
                buyBtn.innerHTML = '<i class="bi bi-cart-x me-2"></i> Pilih tiket terlebih dahulu';
            } else {
                buyBtn.disabled = false;
                buyBtn.innerHTML = '<i class="bi bi-ticket-perforated me-2"></i> Beli Tiket';
            }
            // Also update hidden fields inside the form for submission
            updateHiddenFields();
        }

        // Create hidden inputs inside the form so that selected tickets are submitted
        function updateHiddenFields() {
            const hiddenContainer = document.getElementById('hidden-ticket-fields');
            if (!hiddenContainer) return;
            hiddenContainer.innerHTML = '';
            document.querySelectorAll('.ticket-row').forEach(row => {
                const ticketId = row.dataset.ticketId;
                const qtyInput = row.querySelector('.ticket-qty');
                const qty = parseInt(qtyInput.value) || 0;
                if (qty > 0) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `tickets[${ticketId}]`;
                    hiddenInput.value = qty;
                    hiddenContainer.appendChild(hiddenInput);
                }
            });
        }

        // Attach event listeners
        function attachEvents() {
            document.querySelectorAll('.qty-plus').forEach(btn => {
                btn.removeEventListener('click', handlePlus);
                btn.addEventListener('click', handlePlus);
            });
            document.querySelectorAll('.qty-minus').forEach(btn => {
                btn.removeEventListener('click', handleMinus);
                btn.addEventListener('click', handleMinus);
            });
            document.querySelectorAll('.ticket-qty').forEach(input => {
                input.removeEventListener('change', handleInputChange);
                input.addEventListener('change', handleInputChange);
            });
        }

        function handlePlus(e) {
            const ticketId = e.currentTarget.dataset.id;
            const row = document.querySelector(`.ticket-row[data-ticket-id="${ticketId}"]`);
            const input = row.querySelector('.ticket-qty');
            let val = parseInt(input.value) || 0;
            const max = parseInt(row.dataset.maxStock);
            if (val < max) {
                input.value = val + 1;
                updateTotals();
            }
        }

        function handleMinus(e) {
            const ticketId = e.currentTarget.dataset.id;
            const row = document.querySelector(`.ticket-row[data-ticket-id="${ticketId}"]`);
            const input = row.querySelector('.ticket-qty');
            let val = parseInt(input.value) || 0;
            if (val > 0) {
                input.value = val - 1;
                updateTotals();
            }
        }

        function handleInputChange(e) {
            let val = parseInt(e.target.value) || 0;
            const row = e.target.closest('.ticket-row');
            const max = parseInt(row.dataset.maxStock);
            if (val > max) val = max;
            if (val < 0) val = 0;
            e.target.value = val;
            updateTotals();
        }

        attachEvents();
        updateTotals();

        // Smooth scroll for anchor links and active state
        const navLinks = document.querySelectorAll('.section-nav .nav-link-custom');
        const sections = ['deskripsi', 'tiket', 'syarat'];

        function setActiveLink() {
            let current = '';
            for (let section of sections) {
                const element = document.getElementById(section);
                if (element) {
                    const rect = element.getBoundingClientRect();
                    if (rect.top <= 150 && rect.bottom >= 150) {
                        current = section;
                        break;
                    }
                }
            }
            navLinks.forEach(link => {
                const href = link.getAttribute('href').substring(1);
                if (href === current) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        window.addEventListener('scroll', setActiveLink);
        setActiveLink();

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const target = document.getElementById(targetId);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Form validation
        const form = document.getElementById('ticket-order-form');
        form.addEventListener('submit', function(e) {
            let totalQty = 0;
            document.querySelectorAll('.ticket-qty').forEach(input => {
                totalQty += parseInt(input.value) || 0;
            });
            if (totalQty === 0) {
                e.preventDefault();
                alert('Silakan pilih minimal 1 tiket terlebih dahulu.');
                return false;
            }
            return true;
        });
    });
</script>
@endsection