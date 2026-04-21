@extends('layouts.app')

@section('title', 'LOKET X')

@push('styles')
<style>
    .loket-x-page {
        background: #ffffff;
        padding: 2.2rem 0 3.5rem;
    }

    .loket-x-shell {
        width: min(980px, calc(100% - 2rem));
        margin: 0 auto;
    }

    .loket-x-head {
        margin-bottom: 1.1rem;
    }

    .loket-x-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 1.1rem;
        border-bottom: 1px solid #e8edf3;
        padding-bottom: 0.6rem;
        margin-bottom: 1rem;
    }

    .loket-x-tab {
        text-decoration: none;
        font-size: 0.92rem;
        font-weight: 700;
        color: #6f7f95;
        position: relative;
        padding-bottom: 0.4rem;
    }

    .loket-x-tab.active,
    .loket-x-tab:hover {
        color: #1f4b92;
    }

    .loket-x-tab.active::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: -0.7rem;
        height: 2px;
        background: #1f4b92;
    }

    .loket-x-title {
        font-size: 2rem;
        font-weight: 800;
        color: #14203b;
        margin-bottom: 0.5rem;
    }

    .loket-x-list {
        display: grid;
        gap: 0.8rem;
    }

    .loket-x-item {
        border: 1px solid #e9eef5;
        border-radius: 12px;
        background: #fff;
        padding: 0.95rem 1rem;
    }

    .loket-x-item a {
        font-size: 1rem;
        line-height: 1.4;
        font-weight: 800;
        color: #13284d;
        text-decoration: none;
    }

    .loket-x-item a:hover {
        color: #1f4b92;
    }

    .loket-x-excerpt {
        font-size: 0.88rem;
        color: #5f7088;
        margin-top: 0.35rem;
    }

    .loket-x-meta {
        font-size: 0.79rem;
        color: #8996a8;
        margin-top: 0.38rem;
    }

    .loket-x-source {
        margin-top: 1rem;
        font-size: 0.82rem;
        color: #72839a;
    }

    .loket-x-source a {
        color: #1f4b92;
        text-decoration: none;
        font-weight: 700;
    }

    .loket-x-footer {
        border-top: 1px solid #e8edf3;
        margin-top: 1.4rem;
        padding-top: 1.3rem;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }

    .loket-x-footer h3 {
        font-size: 0.93rem;
        font-weight: 800;
        color: #13284d;
        margin-bottom: 0.55rem;
    }

    .loket-x-footer ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 0.4rem;
    }

    .loket-x-footer a {
        text-decoration: none;
        color: #5c6f87;
        font-size: 0.82rem;
    }

    .loket-x-footer a:hover {
        color: #1f4b92;
    }

    .loket-x-copy {
        margin-top: 1rem;
        font-size: 0.78rem;
        color: #8996a8;
    }

    @media (max-width: 576px) {
        .loket-x-page {
            padding: 1.4rem 0 2.6rem;
        }

        .loket-x-title {
            font-size: 1.6rem;
        }

        .loket-x-footer {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
@include('partials.promo-navbar')
<section class="loket-x-page">
    <div class="loket-x-shell">

        <div class="loket-x-list">
            <article class="loket-x-item">
                <a href="#">How to Claim Event Tickets with Ticket Transfer on LOKET X</a>
                <p class="loket-x-excerpt">No hassle! Follow these steps and receive your favorite event tickets easily.</p>
                <div class="loket-x-meta">17 Nov 2025 - Nandita Alfahira</div>
            </article>
            <article class="loket-x-item">
                <a href="#">Cara Terima Tiket Event Pakai Transfer Tiket di LOKET X</a>
                <p class="loket-x-excerpt">Gak ribet! Ikuti semua caranya di sini dan kamu bisa terima tiket event favorit.</p>
                <div class="loket-x-meta">17 Nov 2025 - Nandita Alfahira</div>
            </article>
            <article class="loket-x-item">
                <a href="#">How to Send Tickets with the Ticket Transfer on LOKET X</a>
                <p class="loket-x-excerpt">Can’t make it to the event? Now you can transfer your ticket to someone close to you.</p>
                <div class="loket-x-meta">17 Nov 2025 - Nandita Alfahira</div>
            </article>
            <article class="loket-x-item">
                <a href="#">Cara Kirim Tiket Event Pakai Transfer Tiket di LOKET X</a>
                <p class="loket-x-excerpt">Gak bisa datang ke event? Tenang, sekarang kamu bisa kirim tiket ke orang terdekat.</p>
                <div class="loket-x-meta">17 Nov 2025 - Nandita Alfahira</div>
            </article>
            <article class="loket-x-item">
                <a href="#">Ticket Transfer on LOKET X, a Safe Way to Share the Fun</a>
                <p class="loket-x-excerpt">A safer way to share your event ticket when you can’t attend.</p>
                <div class="loket-x-meta">17 Nov 2025 - Nandita Alfahira</div>
            </article>
            <article class="loket-x-item">
                <a href="#">Transfer Tiket di LOKET X, Solusi Aman Berbagi Momen Seru!</a>
                <p class="loket-x-excerpt">Tiba-tiba gak bisa datang? Transfer tiket jadi solusi aman berbagi momen.</p>
                <div class="loket-x-meta">17 Nov 2025 - Nandita Alfahira</div>
            </article>
            <article class="loket-x-item">
                <a href="#">Split Tiket di LOKET X, Inovasi Baru Kemudahan Nonton Event!</a>
                <p class="loket-x-excerpt">Punya banyak tiket di satu event? Sekarang kamu bisa split tiket dengan mudah.</p>
                <div class="loket-x-meta">11 Jul 2025 - Nandita Alfahira</div>
            </article>
            <article class="loket-x-item">
                <a href="#">Baru! Kini Tiket LOKET Ada di Aplikasi LOKET X</a>
                <p class="loket-x-excerpt">Tiket aman dalam genggaman, LOKET X hadir untuk kamu.</p>
                <div class="loket-x-meta">11 Jan 2024 - Winda Paramita</div>
            </article>
            <article class="loket-x-item">
                <a href="#">Tiketmu Makin Aman! Cek FAQ LOKET X di Sini</a>
                <p class="loket-x-excerpt">Cek FAQ Loket X di sini.</p>
                <div class="loket-x-meta">22 Des 2023 - Winda Paramita</div>
            </article>
        </div>

        <footer class="loket-x-footer">
            <section>
                <h3>Tentang Loket</h3>
                <ul>
                    <li><a href="#">Biaya</a></li>
                    <li><a href="{{ route('catalog.index') }}">Lihat Event</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Syarat dan Ketentuan</a></li>
                    <li><a href="#">Laporan Kesalahan Sistem</a></li>
                </ul>
            </section>
            <section>
                <h3>Rayakan Eventmu</h3>
                <ul>
                    <li><a href="#">Cara Mempersiapkan Event</a></li>
                    <li><a href="#">Cara Membuat Event Lomba</a></li>
                    <li><a href="#">Cara Mempublikasikan Event</a></li>
                    <li><a href="#">Cara Membuat Event Musik</a></li>
                    <li><a href="#">Cara Mengelola Event</a></li>
                    <li><a href="#">Cara Membuat Konsep Acara yang Menarik</a></li>
                    <li><a href="#">Cara Membuat Event di Co-Working Space</a></li>
                </ul>
            </section>
            <section>
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
            <section>
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
        </footer>
        <div class="loket-x-copy">&copy; Loket (PT Global Loket Sejahtera)</div>
    </div>
</section>
@endsection
