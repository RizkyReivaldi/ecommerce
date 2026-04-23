    @extends('layouts.app')
    @section('content')

    {{-- pricing.blade.php --}}
    {{-- Place this section between your navbar and footer --}}

    <section class="pricing-section py-5">
        <div class="container">
            {{-- Header --}}
            <div class="text-center mb-5 position-relative">

    <!-- Confetti elements -->
    <div class="confetti-wrapper mx-auto">
        <div class="confetti c1"></div>
        <div class="confetti c2"></div>
        <div class="confetti c3"></div>
        <div class="confetti c4"></div>
        <div class="confetti c5"></div>

        <!-- TEXT -->
        <h1 class="display-5 fw-bold mb-3 gradient-text">
            Sukseskan Event Kamu Bersama LOKET
        </h1>
        <p class="lead text-muted">
            Beragam paket berlangganan untuk event creator
        </p>
    </div>

</div>

            {{-- Biaya Penjualan Tiket --}}
            <div class="row g-4 mb-5">
                <div class="col-12 text-center mb-3">
                    <h2 class="h3">Biaya Penjualan Tiket</h2>
                </div>
                
                {{-- Card Metode Pembayaran 1 --}}
                <div class="col-md-6">
                    <div class="glass-card glow h-100 p-3">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">GoPay, GoPay Later, ShopeePay, Shopee PayLater, LinkAja, dan Kartu Kredit</span>
                            </div>
                            <div style="font-size: 42px; font-weight: 700; color: #6366F1;">3,5%</div>
                            <div class="text-muted">x Total Penjualan</div>
                        </div>
                    </div>
                </div>

                {{-- Card Metode Pembayaran 2 --}}
                <div class="col-md-6">
                    <div class="glass-card glow h-100 p-3">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">VA BCA, Indomaret, Bank Transfer, dan Lainnya</span>
                            </div>
                            <div class="display-6 fw-bold text-success mb-2">3,5%</div>
                            <div class="text-muted">x Total Penjualan</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Catatan Biaya --}}
            <div class="alert alert-light border rounded-3 mb-5 p-4">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Total Sales = Total Tiket Terjual x Harga Tiket</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Biaya sudah termasuk PPN</li>
                    <li><i class="bi bi-info-circle-fill text-primary me-2"></i> PB1 (pajak hiburan) menjadi tanggung jawab event creator</li>
                </ul>
            </div>

            {{-- Kalkulator Pendapatan Event --}}
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="calculator-box overflow-hidden">
                        <div class="card-header bg-dark text-white text-center py-3">
                            <h3 class="h5 mb-0">Kalkulator Pendapatan Event</h3>
                            <p class="small text-white-50 mb-0">Hitung pendapatan event dan biaya komisi secara instan</p>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                {{-- Input Area --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="display: block; margin-bottom: 8px;">Kategori Tiket</label>
                                    
                                    {{-- FIXED: Forced inline flexbox to keep buttons beside the input --}}
                                    <div style="display: flex; align-items: stretch; width: 160px; margin-bottom: 0.5rem; border-radius: 8px; overflow: hidden; border: 2px solid #0d6efd;">
                                        <button type="button" id="decrementTicket" style="background: #0d6efd; color: white; border: none; width: 45px; font-weight: bold; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0;">−</button>
                                        
                                        <input type="number" id="ticketQty" value="94" step="1" min="1" style="flex: 1; min-width: 0; border: none; text-align: center; margin: 0; border-radius: 0; font-weight: 600; font-size: 16px; outline: none; padding: 8px 0;">
                                        
                                        <button type="button" id="incrementTicket" style="background: #0d6efd; color: white; border: none; width: 45px; font-weight: bold; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0;">+</button>
                                    </div>
                                    <small class="text-muted d-block mb-3">Mau tambah tiket? Cukup tekan tombol di samping</small>
                                    
                                    <label class="form-label fw-semibold">Harga per Tiket (Rp)</label>
                                    <input type="number" class="form-control" id="ticketPrice" value="50000" step="5000" style="max-width: 200px;">
                                    
                                    <div class="mt-3">
                                        <label class="form-label fw-semibold">Model Komisi</label>
                                        <p class="small text-muted">Untuk menggunakan model komisi dibayarkan ke pembeli pada pengaturan event, silakan hubungi tim support kami di <a href="mailto:support@loket.com">support@loket.com</a></p>
                                    </div>
                                </div>

                                {{-- Result Area --}}
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4" style="background: #F8FAFC;">
                                        <h5 class="fw-bold mb-3">Rincian Pendapatan</h5>
                                        <p class="small text-muted">Rangkuman penjualan, biaya, dan pendapatan</p>
                                        
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Total Penjualan Tiket</span>
                                            <span id="totalSales">Rp 4.700.000</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2 text-danger">
                                            <span>Biaya Penjualan Tiket (3,5%)</span>
                                            <span id="totalFee">-Rp 164.500</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between fw-bold">
                                            <span>Total yang kamu terima</span>
                                            <span id="netAmount">Rp 4.535.500</span>
                                        </div>
                                        <p class="small text-muted mt-2 mb-0">Perkiraan total setelah biaya penjualan tiket</p>
                                        
                                        <div class="mt-3 pt-2 border-top">
                                            <div class="row text-center small">
                                                <div class="col-4">
                                                    <span class="d-block fw-bold">Kategori Tiket</span>
                                                    <span>1</span>
                                                </div>
                                                <div class="col-4">
                                                    <span class="d-block fw-bold">Jumlah Tiket</span>
                                                    <span id="displayQty">94</span>
                                                </div>
                                                <div class="col-4">
                                                    <span class="d-block fw-bold">Biaya</span>
                                                    <span>3,5%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Simulasi Biaya --}}
            <div class="p-4 rounded-4" style="background: rgba(255,255,255,0.6); backdrop-filter: blur(10px);">
                <div class="card-body p-4">
                    <h4 class="h5 fw-bold mb-3">Simulasi Biaya</h4>
                    <ul class="list-unstyled mb-3">
                        <li class="mb-2">• Event Creator akan dikenakan LOKET Service Fee sebesar: <strong>3.5% * total nominal transaksi</strong></li>
                        <li class="mb-2">• Jika event dibatalkan, LOKET memiliki kebijakan untuk tetap memberlakukan Service Fee sebesar 3,5% atas transaksi yang telah dilakukan kepada Event Creator.</li>
                    </ul>
                    <div class="alert alert-secondary mt-3">
                        <strong>Contoh kasus:</strong><br>
                        Eve membuat event 'Natal bersama Eve' dengan harga tiket Rp100.000.<br>
                        Case 1: Moo membeli 3 tiket, maka:<br>
                        - Moo akan membayar sebesar <strong>Rp300.000</strong><br>
                        - Eve akan dikenakan fee sebesar <strong>Rp10.500</strong>
                    </div>
                </div>
            </div>

            {{-- Fitur Tambahan --}}
            <div class="row g-4 text-center mt-4">
                <div class="col-md-3 col-6">
                    <div class="p-3">
                        <i class="bi bi-credit-card-2-front fs-1 text-primary"></i>
                        <p class="mb-0 mt-2 fw-semibold">Metode pembayaran beragam</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3">
                        <i class="bi bi-ticket-perforated fs-1 text-primary"></i>
                        <p class="mb-0 mt-2 fw-semibold">Distribusi tiket kemana saja</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3">
                        <i class="bi bi-check2-square fs-1 text-primary"></i>
                        <p class="mb-0 mt-2 fw-semibold">Fitur check-in</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3">
                        <i class="bi bi-tags fs-1 text-primary"></i>
                        <p class="mb-0 mt-2 fw-semibold">Buat promo suka-suka</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qtyInput = document.getElementById('ticketQty');
            const priceInput = document.getElementById('ticketPrice');
            const totalSalesSpan = document.getElementById('totalSales');
            const totalFeeSpan = document.getElementById('totalFee');
            const netAmountSpan = document.getElementById('netAmount');
            const displayQty = document.getElementById('displayQty');
            
            const feeRate = 0.035;
            
            function formatRupiah(amount) {
                return 'Rp ' + amount.toLocaleString('id-ID');
            }
            
            function calculate() {
                let qty = parseInt(qtyInput.value) || 0;
                let price = parseInt(priceInput.value) || 0;
                
                let total = qty * price;
                let fee = total * feeRate;
                let net = total - fee;
                
                totalSalesSpan.innerText = formatRupiah(total);
                totalFeeSpan.innerText = '- ' + formatRupiah(fee);
                netAmountSpan.innerText = formatRupiah(net);
                displayQty.innerText = qty;
            }
            
            qtyInput.addEventListener('input', calculate);
            priceInput.addEventListener('input', calculate);
            
            document.getElementById('incrementTicket').addEventListener('click', function() {
                qtyInput.value = parseInt(qtyInput.value) + 1;
                calculate();
            });
            
            document.getElementById('decrementTicket').addEventListener('click', function() {
                let newVal = parseInt(qtyInput.value) - 1;
                if (newVal >= 1) qtyInput.value = newVal;
                calculate();
            });
            
            calculate();
        });
            /* ===== LOKET STYLE GRADIENT BACKGROUND ===== */
    .pricing-section {
        position: relative;
        background: linear-gradient(180deg, #F8FAFC 0%, #EEF2FF 100%);
        overflow: hidden;
    }

    /* Gradient blobs */
    .pricing-section::before,
    .pricing-section::after {
        content: "";
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        filter: blur(120px);
        opacity: 0.5;
        z-index: 0;
    }

    .pricing-section::before {
        background: #6366F1; /* Indigo */
        top: -150px;
        left: -150px;
    }

    .pricing-section::after {
        background: #22C55E; /* Green */
        bottom: -150px;
        right: -150px;
    }

    /* Keep content above blur */
    .pricing-section .container {
        position: relative;
        z-index: 2;
    }

    /* ===== GLASS CARD EFFECT ===== */
    .glass-card {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-radius: 18px;
        border: 1px solid rgba(255,255,255,0.4);
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
    }

    /* ===== GLOW EFFECT (very Loket-like) ===== */
    .glow {
        position: relative;
    }

    .glow::before {
        content: "";
        position: absolute;
        inset: -2px;
        border-radius: inherit;
        background: linear-gradient(120deg, #6366F1, #22C55E);
        opacity: 0;
        z-index: -1;
        transition: opacity 0.3s ease;
        filter: blur(12px);
    }

    .glow:hover::before {
        opacity: 0.6;
    }

    /* ===== PREMIUM CALCULATOR LOOK ===== */
    .calculator-box {
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(16px);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.5);
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
    }

    /* ===== HEADER GRADIENT TEXT ===== */
    .gradient-text {
        background: linear-gradient(90deg, #6366F1, #22C55E);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* ===== BUTTON POLISH ===== */
    .btn-outline-secondary {
        border: 1px solid #E2E8F0;
        background: #fff;
    }

    .btn-outline-secondary:hover {
        background: #EEF2FF;
    }

    /* ===== ICON GLOW ===== */
    .icon-glow {
        background: linear-gradient(135deg, #6366F1, #22C55E);
        color: white;
        border-radius: 12px;
        padding: 12px;
        display: inline-block;
        box-shadow: 0 8px 20px rgba(99,102,241,0.3);
    }
    /* ===== CONFETTI BACKGROUND ===== */
    .confetti-wrapper {
        position: relative;
        display: inline-block;
        padding: 40px 20px;
    }

    .confetti-wrapper::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -1;
    }

    /* Confetti pieces */
    .confetti {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.7;
        animation: float 8s ease-in-out infinite alternate;
    }

    /* Individual colors & positions */
    .confetti.c1 {
        width: 120px;
        height: 120px;
        background: #6366F1;
        top: -30px;
        left: -40px;
    }

    .confetti.c2 {
        width: 100px;
        height: 100px;
        background: #22C55E;
        top: 20px;
        right: -40px;
    }

    .confetti.c3 {
        width: 80px;
        height: 80px;
        background: #F59E0B;
        bottom: -20px;
        left: 20%;
    }

    .confetti.c4 {
        width: 90px;
        height: 90px;
        background: #EC4899;
        bottom: -30px;
        right: 10%;
    }

    .confetti.c5 {
        width: 60px;
        height: 60px;
        background: #3B82F6;
        top: 50%;
        left: 60%;
    }

    /* Floating animation */
    @keyframes float {
        from {
            transform: translateY(0px) scale(1);
        }
        to {
            transform: translateY(-20px) scale(1.05);
        }
    }

    </script>
    @endpush

    @push('styles')
    <style>
        body {
    font-family: Inter, sans-serif;
    background: #f6f8fb;
    margin: 0;
    color: #1a1a1a;
}

/* LAYOUT */
.container {
    width: 90%;
    max-width: 1100px;
    margin: auto;
}

.container.small {
    max-width: 800px;
}

/* HERO */
.hero {
    background: linear-gradient(135deg, #0d6efd, #00b4ff);
    padding: 100px 20px;
    color: white;
}

.hero h1 {
    font-size: 40px;
    line-height: 1.3;
}

.hero p {
    margin-top: 10px;
    opacity: 0.9;
}

/* SECTION */
.section {
    padding: 70px 0;
}

.section.gray {
    background: #f2f4f7;
}

/* TITLES */
.title {
    text-align: center;
    margin-bottom: 40px;
}

/* CARD */
.card {
    background: white;
    border-radius: 14px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
}

/* ROW */
.row {
    display: flex;
    align-items: center;
}

.between {
    justify-content: space-between;
}

/* PRICE */
.price-box h2 {
    font-size: 36px;
    color: #0d6efd;
}

/* NOTES */
.notes {
    text-align: center;
    margin-top: 20px;
    color: #555;
}

/* CALCULATOR */
.calculator {
    margin-top: 20px;
}

/* SWITCH */
.switch {
    display: flex;
    margin-bottom: 20px;
}

.switch button {
    flex: 1;
    padding: 12px;
    border: none;
    background: #eaeaea;
    cursor: pointer;
}

.switch .active {
    background: #0d6efd;
    color: white;
}

/* FORM */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* BUTTON */
.btn {
    margin-top: 20px;
    width: 100%;
    padding: 14px;
    background: #0d6efd;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.btn:hover {
    background: #0b5ed7;
}

/* RESULT */
.result {
    margin-top: 20px;
}

.result div {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.strong {
    font-weight: bold;
}

/* MOBILE */
@media(max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }

    .hero h1 {
        font-size: 28px;
    }
}
        .pricing-section {
            background: #F8FAFC;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        /* Titles */
        .pricing-section h1 {
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .pricing-section p.lead {
            color: #64748B;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
            background: #fff;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        }

        /* Badge style */
        .badge {
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 999px;
        }

        /* Calculator */
        .card-header {
            background: #0F172A !important;
            border: none;
        }

        .card-header h3 {
            font-weight: 600;
        }

        .bg-light {
            background: #F1F5F9 !important;
        }

        /* Inputs */
        .form-control {
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            padding: 10px 14px;
        }

        .form-control:focus {
            border-color: #6366F1;
            box-shadow: 0 0 0 2px rgba(99,102,241,0.1);
        }

        /* Buttons small counter */
        .input-group-sm .btn {
            border-radius: 8px;
        }

        /* Notes section */
        .alert-light {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
        }

        /* Simulasi box */
        .alert-secondary {
            background: #F1F5F9;
            border: none;
            border-radius: 12px;
        }

        /* Icons section */
        .bi {
            color: #6366F1 !important;
        }

        /* Divider style */
        hr {
            border-color: #E2E8F0;
        }

        /* Remove ugly number arrows */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button {
            opacity: 0.6;
        }
    </style>
    @endpush


    @endsection