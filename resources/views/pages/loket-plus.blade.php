@extends('layouts.app')

@section('title', 'Loket Plus')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/loket-plus.css') }}">
@endpush

@section('content')

<style>/* --------------------------------------------
   LOKET PLUS - MAIN STYLESHEET
   (No emojis, only Font Awesome / text)
----------------------------------------------- */

/* ----- RESET & GLOBAL ----- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    background: #ffffff;
    color: #1a1e2b;
    line-height: 1.5;
    scroll-behavior: smooth;
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
}

a {
    text-decoration: none;
    transition: all 0.25s ease;
}

section {
    padding: 80px 0;
}

h1, h2, h3 {
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.02em;
}

h2 {
    font-size: 2.25rem;
    margin-bottom: 1rem;
}

.section-subhead {
    font-size: 1.125rem;
    color: #4b5565;
    max-width: 640px;
    margin-bottom: 3rem;
}

.grid-3 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

@media (max-width: 768px) {
    section {
        padding: 60px 0;
    }
    h2 {
        font-size: 1.875rem;
    }
    .container {
        padding: 0 20px;
    }
}

/* ----- BUTTONS & LINKS ----- */
.btn-primary {
    background: #facc15;
    color: #0f172a;
    padding: 14px 32px;
    border-radius: 60px;
    font-weight: 700;
    font-size: 1rem;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: 0.2s;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    border: none;
    cursor: pointer;
}

.btn-primary:hover {
    background: #ffdd44;
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

.btn-outline-light {
    background: transparent;
    border: 1.5px solid rgba(255,255,255,0.5);
    color: white;
    padding: 14px 28px;
    border-radius: 60px;
    font-weight: 600;
    transition: 0.2s;
}

.btn-outline-light:hover {
    background: rgba(255,255,255,0.1);
    border-color: white;
}

.btn-secondary {
    background: #1e293b;
    color: white;
    padding: 12px 28px;
    border-radius: 60px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: 0.2s;
}

.btn-secondary:hover {
    background: #0f172a;
    transform: translateY(-2px);
}

/* ----- HERO SECTION ----- */
.hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e2a3e 100%);
    color: white;
    padding: 100px 0 90px;
    position: relative;
    overflow: hidden;
}

.hero .container {
    position: relative;
    z-index: 2;
}

.hero-badge {
    display: inline-block;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(4px);
    padding: 6px 16px;
    border-radius: 40px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 1.5rem;
    letter-spacing: 0.3px;
}

.hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.25rem;
    max-width: 800px;
}

.hero-highlight {
    color: #facc15;
    border-bottom: 2px solid #facc15;
    display: inline-block;
}

.hero-desc {
    font-size: 1.2rem;
    color: #e2e8f0;
    max-width: 600px;
    margin-bottom: 2rem;
}

.hero-cta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    align-items: center;
}

/* ----- PROTECTION CARDS (LOKET Protection) ----- */
.protection-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: space-between;
    margin-top: 1rem;
}

.protection-card {
    background: #f8fafc;
    border-radius: 32px;
    padding: 2rem 1.8rem;
    flex: 1;
    min-width: 200px;
    text-align: center;
    transition: all 0.2s ease;
    border: 1px solid #eef2f6;
}

.protection-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    border-color: #facc1550;
}

.protection-icon {
    font-size: 2.5rem;
    color: #facc15;
    margin-bottom: 1.2rem;
}

.protection-card h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.protection-card p {
    color: #2d3a4b;
    font-weight: 500;
}

.badge-sub {
    font-size: 0.85rem;
    color: #5b6e8c;
    margin-top: 0.75rem;
    display: block;
}

/* ----- PROMO CARDS ----- */
.promo-card {
    background: white;
    border-radius: 28px;
    padding: 1.8rem;
    box-shadow: 0 12px 28px -8px rgba(0,0,0,0.05);
    border: 1px solid #edf2f7;
    transition: all 0.2s;
}

.promo-card:hover {
    border-color: #facc1550;
    box-shadow: 0 20px 30px -12px rgba(0,0,0,0.08);
}

.promo-badge {
    background: #fef9e3;
    color: #b45309;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 700;
    display: inline-block;
    margin-bottom: 1rem;
}

.promo-card h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.promo-detail {
    font-size: 0.9rem;
    color: #2c3e50;
    margin: 1rem 0;
}

.promo-expiry {
    font-size: 0.8rem;
    color: #dc2626;
    font-weight: 600;
    margin-top: 1rem;
}

/* ----- BUNDLING STEPS ----- */
.bundling-steps {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2rem;
    margin: 3rem 0 2rem;
}

.step-item {
    background: #f1f5f9;
    border-radius: 40px;
    padding: 1.5rem 2rem;
    text-align: center;
    flex: 1;
    min-width: 180px;
    font-weight: 600;
}

.step-number {
    background: #0f172a;
    color: white;
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 60px;
    margin-bottom: 1rem;
    font-weight: 800;
}

/* ----- FAQ SECTION ----- */
.faq-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    max-width: 900px;
    margin-top: 2rem;
}

.faq-item {
    background: #f9fafc;
    border-radius: 24px;
    padding: 1.2rem 1.8rem;
    border: 1px solid #eef2f8;
}

.faq-question {
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 12px;
}

.faq-question i {
    color: #facc15;
    font-size: 1.2rem;
}

.faq-answer {
    color: #334155;
    padding-left: 2rem;
    line-height: 1.6;
}

/* ----- FOOTER ----- */
.footer {
    background: #0b1120;
    color: #cbd5e6;
    padding: 48px 0 32px;
    border-top: 1px solid #1f2a3e;
}

.footer a {
    color: #facc15;
}

.footer-links {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: space-between;
    align-items: center;
}

/* ----- UTILITIES ----- */
.text-center {
    text-align: center;
}
.mt-4 {
    margin-top: 2rem;
}
</style>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>LOKET Plus | Beli Tiket Event + Proteksi + Hotel Sekaligus</title>
    <meta name="description" content="Dapatkan tiket event dengan harga terbaik, perlindungan ekstra dari berbagai risiko, serta pilihan akomodasi nyaman agar pengalaman event-mu lebih aman dan menyenangkan.">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <div class="hero-badge">
            <i class="fas fa-crown"></i> Layanan Premium LOKET
        </div>
        <h1>
            Beli Tiket Event, <span class="hero-highlight">Proteksi</span> + Hotel <br>
            dalam Satu Platform
        </h1>
        <p class="hero-desc">
            Dapatkan tiket dengan harga terbaik, perlindungan ekstra dari berbagai risiko, 
            serta pilihan akomodasi nyaman agar pengalaman event-mu lebih aman dan menyenangkan.
        </p>
        <div class="hero-cta">
            <a href="https://www.loket.com/loket-plus?utm_source=Organic&utm_medium=Hashtag" class="btn-primary" target="_blank" rel="noopener noreferrer">
                <i class="fas fa-ticket-alt"></i> Cek Tiket & Promo
            </a>
            <a href="#protection" class="btn-outline-light">
                <i class="fas fa-shield-alt"></i> Pelajari Proteksi
            </a>
        </div>
    </div>
</section>

<!-- PROTECTION SECTION (LOKET Protection) -->
<section id="protection">
    <div class="container">
        <div class="text-center">
            <h2><i class="fas fa-shield-alt"></i> LOKET Protection</h2>
            <p class="section-subhead">Beli tiket tenang, nikmati event dengan aman. Tiketmu tetap terlindungi meski event batal, sakit, atau hal tak terduga lainnya.</p>
        </div>
        <div class="protection-grid">
            <div class="protection-card">
                <div class="protection-icon"><i class="fas fa-calendar-times"></i></div>
                <h3>Event Batal</h3>
                <p>10% penggantian tiket</p>
                <span class="badge-sub">Maks. Rp1.000.000</span>
            </div>
            <div class="protection-card">
                <div class="protection-icon"><i class="fas fa-hospital-user"></i></div>
                <h3>Sakit & Rawat Inap</h3>
                <p>Klaim hingga Rp10.000.000</p>
                <span class="badge-sub">untuk rawat inap</span>
            </div>
            <div class="protection-card">
                <div class="protection-icon"><i class="fas fa-luggage-cart"></i></div>
                <h3>Perlindungan Lainnya</h3>
                <p>Kecelakaan, kehilangan barang pribadi, santunan kebakaran.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="https://www.loket.com/blog/proteksi-pembeli-tiket/?utm_source=loket-plus&utm_medium=referral" class="btn-secondary" target="_blank">Syarat & Ketentuan Klaim <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- PROMO SECTION (exclusive promotions) -->
<section style="background: #fefcf5;">
    <div class="container">
        <div class="text-center">
            <h2><i class="fas fa-tags"></i> Promo Eksklusif</h2>
            <p class="section-subhead">Pakai metode pembayaran favorit & dapatkan diskon menarik hingga cicilan 0%.</p>
        </div>
        <div class="grid-3">
            <!-- promo 1 -->
            <div class="promo-card">
                <div class="promo-badge"><i class="fas fa-credit-card"></i> PayLater</div>
                <h3>Diskon Rp150rb</h3>
                <div class="promo-detail">Min. transaksi Rp1.000.000 (semua pengguna)</div>
                <div class="promo-expiry"><i class="far fa-clock"></i> Berakhir 1 Mei 2026</div>
                <div><small>Pakai Indodana PayLater • Halaman Pembayaran</small></div>
            </div>
            <!-- promo 2 -->
            <div class="promo-card">
                <div class="promo-badge"><i class="fas fa-percent"></i> Cicilan 0%</div>
                <h3>Cicilan 0%</h3>
                <div class="promo-detail">Min. transaksi Rp500.000 (tenor 3 atau 6 bulan)</div>
                <div class="promo-expiry"><i class="far fa-clock"></i> Berakhir 1 Mei 2026</div>
                <div><small>Indodana • Semua pengguna</small></div>
            </div>
            <!-- promo 3 -->
            <div class="promo-card">
                <div class="promo-badge"><i class="fab fa-shopee"></i> Shopee App</div>
                <h3>Diskon 5%*</h3>
                <div class="promo-detail">Maks. diskon Rp100.000, min. transaksi Rp300.000</div>
                <div class="promo-expiry"><i class="far fa-clock"></i> Berakhir 1 Mei 2026</div>
                <div><small>No promo code • Applied on Shopee App</small></div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="https://www.loket.com/loket-plus?utm_source=Organic&utm_medium=Hashtag" class="btn-primary" target="_blank">Lihat Semua Promo <i class="fas fa-gift"></i></a>
        </div>
    </div>
</section>

<!-- ACCOMMODATION + TICKET BUNDLING -->
<section>
    <div class="container">
        <div class="text-center">
            <h2><i class="fas fa-hotel"></i> Tiket + Akomodasi dalam Satu Paket</h2>
            <p class="section-subhead">Bingung cari hotel & transportasi buat nonton event di luar kota? Tenang, di LOKET Plus semua beres dalam satu paket praktis.</p>
        </div>
        <div class="bundling-steps">
            <div class="step-item"><div class="step-number">1</div> Pilih Event & Tiket Bundling</div>
            <div class="step-item"><div class="step-number">2</div> Lakukan Pembayaran Sekali Transaksi</div>
            <div class="step-item"><div class="step-number">3</div> Pembelian Berhasil! Tinggal Datang & Seru-seruan</div>
        </div>
        <div class="protection-grid" style="margin-top: 2rem;">
            <div class="protection-card" style="background:#ffffff;">
                <i class="fas fa-hotel" style="font-size:2rem; color:#facc15;"></i>
                <h3 style="margin-top:1rem;">Tiket Event + Hotel</h3>
                <p>Dapatkan paket lengkap termasuk penginapan dan shuttle/transportasi.</p>
            </div>
            <div class="protection-card" style="background:#ffffff;">
                <i class="fas fa-tshirt" style="font-size:2rem; color:#facc15;"></i>
                <h3 style="margin-top:1rem;">Merchandise & Akses Khusus</h3>
                <p>Fasilitas tambahan seperti parkir prioritas dan akses eksklusif.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ SECTION -->
<section style="background:#f9fbfd;">
    <div class="container">
        <div class="text-center">
            <h2><i class="fas fa-question-circle"></i> Pertanyaan Umum</h2>
            <p class="section-subhead">Tentang LOKET Plus, Protection, dan layanan bundling.</p>
        </div>
        <div class="faq-grid">
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-question-circle"></i> Apa itu LOKET Plus?</div>
                <div class="faq-answer">LOKET Plus adalah layanan tambahan dari LOKET yang dirancang untuk memberikan pengalaman lebih praktis, nyaman, dan bernilai. Mencakup LOKET Bundling, LOKET Promo, dan LOKET Protection.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-shield-virus"></i> Apa saja cakupan LOKET Protection?</div>
                <div class="faq-answer">Perlindungan untuk tiket & keamanan diri: risiko pembatalan event, kerusakan barang pribadi, kecelakaan, hingga perlindungan selama di wahana/event. Premi fleksibel sesuai kebutuhan.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-boxes"></i> Bagaimana cara kerja LOKET Bundling?</div>
                <div class="faq-answer">Kerja sama antara LOKET, promotor, agen perjalanan & hotel memungkinkan pembeli mendapatkan tiket event + fasilitas tambahan (hotel, shuttle, merchandise) dalam satu paket praktis.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-ticket-alt"></i> Apakah promo bisa didapatkan tanpa kode voucher?</div>
                <div class="faq-answer">Beberapa promo seperti diskon Indodana atau cicilan 0% langsung apply di halaman pembayaran. Ada juga yang perlu menyalin kode — cek detail promo di website LOKET.</div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container footer-links">
        <div>© {{ date('Y') }} LOKET Plus • Beli Tiket Lebih Aman</div>
        <div>
            <a href="https://www.loket.com/loket-plus?utm_source=Organic&utm_medium=Hashtag" target="_blank"><i class="fas fa-external-link-alt"></i> Kunjungi LOKET Plus</a> &nbsp;|&nbsp;
            <a href="https://www.loket.com/blog/proteksi-pembeli-tiket/?utm_source=loket-plus&utm_medium=referral" target="_blank">Syarat & Ketentuan</a>
        </div>
    </div>
</footer>

</body>
</html>