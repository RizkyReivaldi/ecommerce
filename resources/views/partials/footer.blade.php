<style>
    .loket-footer {
        background: #ffffff;
        border-top: 1px solid #e8edf4;
        margin-top: 24px;
        padding: 28px 0 20px;
    }
    .loket-footer-shell {
        width: min(1160px, calc(100% - 2rem));
        margin: 0 auto;
    }
    .loket-footer-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }
    .loket-footer h4 {
        font-size: 15px;
        font-weight: 800;
        color: #1d3552;
        margin-bottom: 10px;
    }
    .loket-footer ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 6px;
    }
    .loket-footer a {
        text-decoration: none;
        color: #5f7088;
        font-size: 13px;
    }
    .loket-footer a:hover {
        color: #245ca5;
    }
    .loket-footer-meta {
        margin-top: 16px;
        border-top: 1px solid #edf2f8;
        padding-top: 12px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 10px;
        font-size: 12px;
        color: #7a8ba1;
    }
    .loket-footer-meta-links {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .loket-footer-meta a {
        color: #5f7088;
    }
    @media (max-width: 860px) {
        .loket-footer-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (max-width: 560px) {
        .loket-footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<footer class="loket-footer">
    <div class="loket-footer-shell">
        <div class="loket-footer-grid">
            <section>
                <h4>Tentang Loket</h4>
                <ul>
                    <li><a href="#">Biaya</a></li>
                    <li><a href="{{ route('catalog.index') }}">Lihat Event</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Syarat dan Ketentuan</a></li>
                    <li><a href="#">Laporan Kesalahan Sistem</a></li>
                </ul>
            </section>

            <section>
                <h4>Rayakan Eventmu</h4>
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
                <h4>Lokasi Event</h4>
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
                <h4>Inspirasi Event</h4>
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
        </div>

        <div class="loket-footer-meta">
            <div>© {{ date('Y') }} Loket (PT Global Loket Sejahtera)</div>
            <div class="loket-footer-meta-links">
                <a href="#">Tentang Kami</a>
                <a href="{{ route('blog.home') }}">Blog</a>
                <a href="#">Karir</a>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Kebijakan Cookie</a>
                <a href="#">Hubungi Kami</a>
            </div>
        </div>
    </div>
</footer>
