<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Footer dari Screenshot | LOKET Modern Footer</title>
    <style>
        /* Reset & base styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f7f9fc;
            font-family: system-ui, -apple-system, 'Segoe UI', 'Inter', 'Helvetica Neue', sans-serif;
            line-height: 1.45;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* simple demo content — mirip preview artikel dari screenshot (optional) */
        .demo-preview {
            max-width: 1280px;
            margin: 2rem auto 1rem;
            padding: 0 1.5rem;
        }
        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1rem;
        }
        .event-card {
            background: white;
            border-radius: 20px;
            padding: 1.25rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03), 0 1px 2px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef2f9;
            transition: 0.2s;
        }
        .event-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a2c3e;
            margin-bottom: 0.5rem;
        }
        .event-card .date {
            font-size: 0.75rem;
            color: #5f7f9e;
            letter-spacing: 0.3px;
            margin-bottom: 0.4rem;
        }
        .event-card .price {
            font-weight: 700;
            color: #1d4e89;
            font-size: 0.9rem;
            margin: 0.5rem 0 0.25rem;
        }
        .event-card .badge {
            background: #eef3fc;
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 500;
            color: #245ca5;
        }
        hr {
            margin: 1rem 0;
            border: none;
            border-top: 1px solid #e2e8f0;
        }

        /* ========= FOOTER RESMI (berdasarkan screenshot) ========= */
        .loket-footer-screenshot {
            background: #ffffff;
            border-top: 1px solid #e6edf4;
            margin-top: 2.5rem;
            padding: 2.5rem 0 1.5rem;
            width: 100%;
        }

        .footer-container {
            width: min(1240px, calc(100% - 2rem));
            margin: 0 auto;
        }

        /* 4 kolom grid */
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 2rem 1.8rem;
            margin-bottom: 2rem;
        }

        .footer-col h4 {
            font-size: 0.9rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #1a344f;
            margin-bottom: 1.1rem;
            position: relative;
            display: inline-block;
        }

        .footer-col ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .footer-col li {
            line-height: 1.3;
        }

        .footer-col a {
            text-decoration: none;
            color: #5b6f8c;
            font-size: 0.85rem;
            transition: color 0.2s, text-decoration 0.2s;
            display: inline-block;
        }

        .footer-col a:hover {
            color: #1d6fae;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        /* security & contact row (Keamanan dan Privasi | Iducti Kami) */
        .security-contact-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0 0.75rem;
            border-top: 1px solid #edf2f8;
            margin-top: 0.5rem;
        }
        .security-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            color: #2c4c6e;
            background: #f8fafd;
            padding: 0.3rem 0.9rem;
            border-radius: 40px;
        }
        .security-badge span {
            font-size: 1rem;
        }
        .contact-link {
            font-size: 0.8rem;
            background: transparent;
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
            transition: background 0.2s;
        }
        .contact-link a {
            text-decoration: none;
            color: #1d6fae;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .contact-link a:hover {
            color: #0f4a75;
            text-decoration: underline;
        }

        /* bottom links dengan bullets • */
        .footer-bottom-nav {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem 1.2rem;
            padding: 1.2rem 0 0.8rem;
            border-top: 1px solid #edf2f8;
            margin-top: 0.75rem;
            font-size: 0.75rem;
        }
        .footer-bottom-nav a {
            text-decoration: none;
            color: #5b6f8c;
            transition: color 0.2s;
        }
        .footer-bottom-nav a:hover {
            color: #1d6fae;
            text-decoration: underline;
        }
        .separator-dot {
            color: #b9c4d4;
            font-weight: 300;
            user-select: none;
        }

        /* copyright */
        .footer-copyright {
            text-align: center;
            font-size: 0.7rem;
            color: #7b8ba3;
            padding: 1rem 0 0.5rem;
            border-top: 1px solid #edf2f8;
            margin-top: 0.5rem;
        }

        /* responsive */
        @media (max-width: 900px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.8rem;
            }
            .security-contact-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 560px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .footer-bottom-nav {
                justify-content: flex-start;
                gap: 0.5rem 0.8rem;
            }
            .footer-container {
                width: calc(100% - 1.5rem);
            }
            .footer-col h4 {
                margin-bottom: 0.7rem;
            }
        }

        /* additional subtle hover */
        .footer-col a:focus-visible, .footer-bottom-nav a:focus-visible {
            outline: 2px solid #1d6fae;
            outline-offset: 2px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<!-- Bagian preview untuk konteks (mirip dengan card di screenshot, agar footer terlihat natural) -->

<!-- ========== FOOTER (berdasarkan gambar screenshot) ========== -->
<footer class="loket-footer-screenshot" aria-label="Footer utama LOKET">
    <div class="footer-container">
        <!-- 4 kolom utama sesuai deskripsi -->
        <div class="footer-grid">
            <!-- Kolom 1: Berteru LOKET -->
            <div class="footer-col">
                <h4>Berteru LOKET</h4>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>

            <!-- Kolom 2: Event Creator -->
            <div class="footer-col">
                <h4>Event Creator</h4>
                <ul>
                    <li><a href="#">Biaya</a></li>
                    <li><a href="#">Buat Event</a></li>
                    <li><a href="#">Buku Panduan Creator</a></li>
                    <li><a href="#">LOKÉT Crafter</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Dukungan -->
            <div class="footer-col">
                <h4>Dukungan</h4>
                <ul>
                    <li><a href="#">Pusat Bantuan</a></li>
                    <li><a href="#">Syarat dan Ketentuan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Keputusan Keamanan &amp; Privasi</a></li>
                    <li><a href="#">Kebijakan Cookies</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Produk -->
            <div class="footer-col">
                <h4>Produk</h4>
                <ul>
                    <li><a href="#">LOKÉT X</a></li>
                    <li><a href="#">LOKÉT Screen</a></li>
                    <li><a href="#">LOKÉT Plus</a></li>
                </ul>
            </div>
        </div>

        <!-- Baris Keamanan & Privasi + Iducti Kami (sesuai screenshot) -->
        <div class="security-contact-row">
            <div class="security-badge">
                <span>🔒</span> Keamanan dan Privasi
            </div>
            <div class="contact-link">
                <a href="#">
                    <span>📞</span> Iducti Kami
                </a>
            </div>
        </div>

        <!-- Baris tautan dengan bullet • (Tentang LOKET • Blog • Kebijakan Privasi ...) -->
        <div class="footer-bottom-nav">
            <a href="#">Tentang LOKET</a>
            <span class="separator-dot">•</span>
            <a href="#">Blog</a>
            <span class="separator-dot">•</span>
            <a href="#">Kebijakan Privasi</a>
            <span class="separator-dot">•</span>
            <a href="#">Kebijakan Cookies</a>
            <span class="separator-dot">•</span>
            <a href="#">Hubungi Kami</a>
        </div>

        <!-- Hak cipta sesuai screenshot -->
        <div class="footer-copyright">
            © 2026 Loket (PT Global Loket Sejahtera)
        </div>
    </div>
</footer>

<!-- optional: membuat tahun dinamis (jika diperlukan, tapi screenshot menggunakan 2026) -->
<script>
    // biarkan statis 2026 agar persis dengan screenshot, namun jika ingin update bisa diaktifkan
    // (tidak mengganggu karena screenshot asli menunjukkan 2026)
    console.log("Footer screenshot LOKET — semua tautan dan bagian telah sesuai dengan gambar");
</script>
</body>
</html>