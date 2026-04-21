@extends('layouts.app')

@section('title', 'Blog Home')

@push('styles')
<style>
    .loket-blog-page {
        background: #ffffff;
        padding: 2.2rem 0 3.5rem;
    }

    .loket-blog-shell {
        width: min(1180px, calc(100% - 2rem));
        margin: 0 auto;
    }

    .loket-blog-head {
        margin-bottom: 1.25rem;
    }

    .loket-blog-title {
        font-size: 1.9rem;
        font-weight: 800;
        color: #14203b;
        margin-bottom: 0.85rem;
    }

    .loket-blog-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 1.1rem;
        border-bottom: 1px solid #e8edf3;
        padding-bottom: 0.6rem;
    }

    .loket-blog-tab {
        text-decoration: none;
        font-size: 0.92rem;
        font-weight: 700;
        color: #6f7f95;
        position: relative;
        padding-bottom: 0.4rem;
    }

    .loket-blog-tab.active,
    .loket-blog-tab:hover {
        color: #1f4b92;
    }

    .loket-blog-tab.active::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: -0.7rem;
        height: 2px;
        background: #1f4b92;
    }

    .loket-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(260px, 1fr);
        gap: 1.25rem;
        margin-top: 1.1rem;
    }

    .loket-card,
    .loket-side-card {
        background: #ffffff;
        border: 1px solid #ebf0f6;
        border-radius: 12px;
    }

    .loket-card {
        overflow: hidden;
    }

    .loket-feature-img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .loket-feature-body {
        padding: 1rem 1rem 1.15rem;
    }

    .loket-item-title {
        font-size: 1.2rem;
        line-height: 1.35;
        font-weight: 800;
        color: #13284d;
        text-decoration: none;
    }

    .loket-item-title:hover {
        color: #1f4b92;
    }

    .loket-item-excerpt {
        font-size: 0.91rem;
        color: #5f7088;
        margin: 0.45rem 0 0.4rem;
    }

    .loket-item-meta {
        font-size: 0.79rem;
        color: #8996a8;
    }

    .loket-block {
        margin-top: 1.15rem;
    }

    .loket-block h2 {
        font-size: 1.25rem;
        color: #13284d;
        margin-bottom: 0.85rem;
        font-weight: 800;
    }

    .loket-article-list {
        display: grid;
        gap: 0.7rem;
    }

    .loket-article-item {
        border: 1px solid #ebf0f6;
        border-radius: 10px;
        padding: 0.8rem 0.85rem;
        background: #ffffff;
    }

    .loket-article-item .loket-item-title {
        font-size: 1rem;
    }

    .loket-article-item .loket-item-excerpt {
        font-size: 0.86rem;
        margin-top: 0.38rem;
    }

    .loket-side-card {
        padding: 0.95rem;
    }

    .loket-side-title {
        font-size: 0.95rem;
        font-weight: 800;
        color: #14203b;
        margin-bottom: 0.65rem;
    }

    .loket-side-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 0.58rem;
    }

    .loket-side-list a {
        text-decoration: none;
        color: #334d6f;
        font-size: 0.86rem;
        line-height: 1.35;
        font-weight: 600;
    }

    .loket-side-list a:hover {
        color: #1f4b92;
    }

    .loket-load-more {
        text-align: center;
        margin-top: 1rem;
    }

    .loket-load-more a {
        display: inline-block;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 700;
        color: #1f4b92;
        border: 1px solid #cbd8eb;
        border-radius: 999px;
        padding: 0.44rem 1rem;
    }

    .loket-load-more a:hover {
        background: #f5f9ff;
    }

    .loket-footer-links {
        border-top: 1px solid #e8edf3;
        margin-top: 2rem;
        padding-top: 1.5rem;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }

    .loket-footer-group h3 {
        font-size: 0.93rem;
        font-weight: 800;
        color: #13284d;
        margin-bottom: 0.55rem;
    }

    .loket-footer-group ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 0.42rem;
    }

    .loket-footer-group a {
        text-decoration: none;
        color: #5c6f87;
        font-size: 0.82rem;
    }

    .loket-footer-group a:hover {
        color: #1f4b92;
    }

    .loket-copyright {
        margin-top: 1.4rem;
        font-size: 0.78rem;
        color: #8996a8;
    }

    @media (max-width: 992px) {
        .loket-main-grid {
            grid-template-columns: 1fr;
        }

        .loket-footer-links {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 576px) {
        .loket-blog-page {
            padding: 1.35rem 0 2.5rem;
        }

        .loket-blog-title {
            font-size: 1.52rem;
        }

        .loket-blog-tabs {
            gap: 0.8rem;
        }

        .loket-item-title {
            font-size: 1.03rem;
        }

        .loket-footer-links {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<section class="loket-blog-page">
    <div class="loket-blog-shell">
        <header class="loket-blog-head">
            <h1 class="loket-blog-title">Loket Blog</h1>
            <nav class="loket-blog-tabs" aria-label="Blog category">
                <a class="loket-blog-tab active" href="{{ route('blog.home') }}">Blog Home</a>
                <a class="loket-blog-tab" href="#">LOKET X</a>
                <a class="loket-blog-tab" href="#">LOKET Edu</a>
                <a class="loket-blog-tab" href="#">LOKET News</a>
                <a class="loket-blog-tab" href="#">LOKET Screen</a>
                <a class="loket-blog-tab" href="#">LOKET Wiki</a>
                <a class="loket-blog-tab" href="#">LOKET Event</a>
            </nav>
        </header>

        <div class="loket-main-grid">
            <main>
                <section class="loket-block">
                    <h2>Artikel Populer</h2>
                    <article class="loket-card">
                        <img class="loket-feature-img" src="https://placehold.co/1200x675/153D87/ffffff?text=LOKET+Blog+Utama" alt="Artikel populer Loket">
                        <div class="loket-feature-body">
                            <a class="loket-item-title" href="#">JENO &amp; JAEMIN ke Indo, Ini Harga Tiket Fanmeeting NCT JNJM 2026</a>
                            <p class="loket-item-excerpt">Tiket akan mulai dijual pada 29 April 2026. Cek detail harga tiket, kategori kursi, dan jadwal pembelian di sini.</p>
                            <div class="loket-item-meta">17 Apr 2026 - Nandita Alfahira</div>
                        </div>
                    </article>
                </section>

                <section class="loket-block">
                    <h2>Artikel Pilihan</h2>
                    <div class="loket-article-list">
                        <article class="loket-article-item">
                            <a class="loket-item-title" href="#">Promo Event, Bioskop, &amp; Biaya Komisi Tetap Hemat, Bareng LOKET #PastiBisa!</a>
                            <p class="loket-item-excerpt">Rangkuman promo terbaru untuk event creator dan penonton agar aktivitas hiburan makin hemat.</p>
                            <div class="loket-item-meta">02 Apr 2026 - Winda Paramita</div>
                        </article>
                        <article class="loket-article-item">
                            <a class="loket-item-title" href="#">Beragam Diskon &amp; Cashback Nonton Bioskop di LOKET Screen</a>
                            <p class="loket-item-excerpt">Pilihan promo bioskop mingguan dengan penawaran diskon dan cashback dari berbagai metode pembayaran.</p>
                            <div class="loket-item-meta">01 Apr 2026 - Nandita Alfahira</div>
                        </article>
                        <article class="loket-article-item">
                            <a class="loket-item-title" href="#">Ditunggu-tunggu, Ini Harga Tiket Konser EXO Jakarta 2026</a>
                            <p class="loket-item-excerpt">Informasi kategori tiket konser, jadwal rilis, serta panduan pembelian agar tidak kehabisan tiket.</p>
                            <div class="loket-item-meta">27 Mar 2026 - Nandita Alfahira</div>
                        </article>
                    </div>
                </section>

                <section class="loket-block">
                    <h2>Artikel Lainnya</h2>
                    <div class="loket-article-list">
                        <article class="loket-article-item">
                            <a class="loket-item-title" href="#">Diskon Hingga 50% Beli Tiket Bioskop Pakai Indodana PayLater!</a>
                            <div class="loket-item-meta">09 Apr 2026 - Winda Paramita</div>
                        </article>
                        <article class="loket-article-item">
                            <a class="loket-item-title" href="#">Kangen Dao Ming Si CS? Ini Harga Tiket Konser F'Forever di Jakarta!</a>
                            <div class="loket-item-meta">03 Apr 2026 - Winda Paramita</div>
                        </article>
                        <article class="loket-article-item">
                            <a class="loket-item-title" href="#">Jual Tiket Offline Jadi Lebih Terorganisir Pakai Ticketbox</a>
                            <div class="loket-item-meta">01 Apr 2026 - Nandita Alfahira</div>
                        </article>
                        <article class="loket-article-item">
                            <a class="loket-item-title" href="#">Tu, Wa, Ga, Pat! Ini Harga Tiket Konser Project Pop 30 Tahun</a>
                            <div class="loket-item-meta">18 Mar 2026 - Nandita Alfahira</div>
                        </article>
                    </div>
                    <div class="loket-load-more">
                        <a href="#">Lihat Artikel Lainnya</a>
                    </div>
                </section>
            </main>

            <aside>
                <section class="loket-side-card">
                    <h3 class="loket-side-title">Tentang Loket</h3>
                    <ul class="loket-side-list">
                        <li><a href="{{ route('promo.indodana') }}">Biaya</a></li>
                        <li><a href="{{ route('catalog.index') }}">Lihat Event</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Syarat dan Ketentuan</a></li>
                        <li><a href="#">Laporan Kesalahan Sistem</a></li>
                    </ul>
                </section>
                <section class="loket-side-card mt-3">
                    <h3 class="loket-side-title">Rayakan Eventmu</h3>
                    <ul class="loket-side-list">
                        <li><a href="#">Cara Mempersiapkan Event</a></li>
                        <li><a href="#">Cara Membuat Event Lomba</a></li>
                        <li><a href="#">Cara Mempublikasikan Event</a></li>
                        <li><a href="#">Cara Membuat Event Musik</a></li>
                        <li><a href="#">Cara Mengelola Event</a></li>
                        <li><a href="#">Cara Membuat Konsep Acara yang Menarik</a></li>
                        <li><a href="#">Cara Membuat Event di Co-Working Space</a></li>
                    </ul>
                </section>
            </aside>
        </div>

        <footer class="loket-footer-links">
            <section class="loket-footer-group">
                <h3>Lokasi Event</h3>
                <ul>
                    <li><a href="#">Jakarta</a></li>
                    <li><a href="#">Bandung</a></li>
                    <li><a href="#">Yogyakarta</a></li>
                    <li><a href="#">Surabaya</a></li>
                    <li><a href="#">Solo</a></li>
                    <li><a href="#">Medan</a></li>
                    <li><a href="#">Bali</a></li>
                    <li><a href="#">Semua Kota</a></li>
                </ul>
            </section>
            <section class="loket-footer-group">
                <h3>Inspirasi Event</h3>
                <ul>
                    <li><a href="#">Festival</a></li>
                    <li><a href="#">Konser</a></li>
                    <li><a href="#">Olahraga</a></li>
                    <li><a href="#">Workshop &amp; Seminar</a></li>
                    <li><a href="#">Teater &amp; Drama</a></li>
                    <li><a href="#">Atraksi</a></li>
                    <li><a href="#">Semua Kategori</a></li>
                </ul>
            </section>
            <section class="loket-footer-group">
                <h3>Ikuti Kami</h3>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="{{ route('blog.home') }}">Blog</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Kebijakan Cookie</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </section>
            <section class="loket-footer-group">
                <h3>Keamanan dan Privasi</h3>
                <ul>
                    <li><a href="#">ISO 27001</a></li>
                </ul>
            </section>
        </footer>

        <div class="loket-copyright">
            &copy; Loket (PT Global Loket Sejahtera)
        </div>
    </div>
</section>
@endsection
