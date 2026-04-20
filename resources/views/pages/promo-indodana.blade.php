<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Promo Indodana PayLater - LOKET | Cashback & Diskon Tiket Event</title>
  <meta name="description" content="Cashback & diskon tiket event, wahana, bioskop pakai Indodana PayLater di LOKET. Periode Januari 2026. Syarat & ketentuan berlaku.">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #f4f6fa;
      font-family: system-ui, -apple-system, 'Inter', 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
      line-height: 1.5;
      color: #1a2c3e;
      padding: 2rem 1rem;
    }

    /* main container */
    .loket-container {
      max-width: 800px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 28px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.02), 0 2px 6px rgba(0, 0, 0, 0.03);
      overflow: hidden;
    }

    /* typography & components */
    .blog-header {
      padding: 2rem 2rem 1rem 2rem;
      border-bottom: 1px solid #eef2f8;
    }

    .top-badge-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
      flex-wrap: wrap;
      gap: 0.75rem;
    }

    .loket-year-badge {
      font-size: 0.75rem;
      font-weight: 600;
      color: #2c7a4d;
      background: #e8f3ec;
      display: inline-block;
      padding: 0.2rem 0.8rem;
      border-radius: 30px;
      letter-spacing: 0.3px;
    }

    .share-news-row {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .bagikan-link {
      font-size: 0.8rem;
      font-weight: 500;
      color: #3f6b8c;
      background: #f0f4f9;
      padding: 0.25rem 1rem;
      border-radius: 30px;
      text-decoration: none;
      transition: background 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
    }

    .bagikan-link:hover {
      background: #e2eaf2;
    }

    .loket-news-badge {
      font-size: 0.7rem;
      font-weight: 600;
      background: #eef2f8;
      color: #2c5a7a;
      padding: 0.25rem 0.9rem;
      border-radius: 30px;
    }

    h1 {
      font-size: 2rem;
      font-weight: 700;
      line-height: 1.2;
      color: #0b2b3f;
      margin: 0.5rem 0 0.3rem;
      letter-spacing: -0.3px;
    }

    .sk-caption {
      font-size: 0.7rem;
      color: #6c8eae;
      margin-top: 0.25rem;
      margin-bottom: 1rem;
    }

    .author-date {
      font-size: 0.85rem;
      color: #5e7c97;
      border-left: 3px solid #cde0ec;
      padding-left: 0.75rem;
      margin-top: 0.75rem;
    }

    /* section styles - all vertical */
    .promo-section {
      padding: 1.8rem 2rem;
      border-bottom: 1px solid #eef3f9;
    }

    .section-heading {
      font-size: 1.55rem;
      font-weight: 600;
      color: #1e4a6e;
      margin-bottom: 0.25rem;
    }

    .section-subhead {
      font-size: 0.85rem;
      color: #66809e;
      margin-bottom: 1.5rem;
      border-left: 3px solid #dce6f0;
      padding-left: 0.8rem;
    }

    /* force vertical stacking */
    .promo-grid,
    .two-column-grid,
    .related-grid {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .event-card,
    .promo-card,
    .related-card {
      width: 100%;
      background: #ffffff;
      border: 1px solid #e5edf4;
      border-radius: 24px;
      padding: 1.2rem 1.4rem;
      transition: border 0.2s;
    }

    .event-card:hover,
    .promo-card:hover {
      border-color: #cbdde9;
    }

    .event-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1c4d72;
      margin-bottom: 0.5rem;
    }

    .event-bagikan {
      display: inline-block;
      font-size: 0.7rem;
      background: #f0f4f9;
      padding: 0.2rem 0.9rem;
      border-radius: 30px;
      color: #3f6b8c;
      margin: 0.5rem 0 0.75rem;
      text-decoration: none;
    }

    .card-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1c4d72;
      margin-bottom: 0.5rem;
    }

    .card-desc {
      font-size: 0.85rem;
      color: #496f8f;
      margin-bottom: 1rem;
    }

    .feature-list {
      list-style: none;
      margin: 0.75rem 0 0.5rem;
    }

    .feature-list li {
      font-size: 0.8rem;
      color: #2e577a;
      margin-bottom: 0.45rem;
      display: flex;
      align-items: baseline;
      gap: 0.5rem;
    }

    .dot {
      display: inline-block;
      width: 5px;
      height: 5px;
      background-color: #89a9c7;
      border-radius: 50%;
      flex-shrink: 0;
      margin-top: 0.6rem;
    }

    .badge-light {
      background-color: #eef3fa;
      color: #2f6b47;
      font-size: 0.7rem;
      font-weight: 500;
      padding: 0.2rem 0.7rem;
      border-radius: 20px;
      display: inline-block;
      margin-top: 0.5rem;
    }

    .terms-note {
      font-size: 0.7rem;
      color: #6e8eae;
      border-top: 1px solid #ecf3f9;
      margin-top: 1rem;
      padding-top: 0.7rem;
    }

    /* ========== SMALLER CARDS (matching picture reference) ========== */
    .big-cards-wrapper {
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
      margin: 0.5rem 0 0.2rem;
    }

    .big-venue-card {
      background: #ffffff;
      border: 1px solid #e5edf4;
      border-radius: 20px;
      overflow: hidden;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .big-venue-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
      border-color: #cbdde9;
    }

    .card-img-top {
      position: relative;
      width: 100%;
      aspect-ratio: 16 / 9;
      overflow: hidden;
      background-color: #eef2f6;
    }

    .card-img-top img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .card-badge {
      position: absolute;
      top: 0.6rem;
      left: 0.6rem;
      background-color: #dc3545;
      color: white;
      font-size: 0.65rem;
      font-weight: 600;
      padding: 0.2rem 0.7rem;
      border-radius: 2rem;
      letter-spacing: 0.2px;
      z-index: 2;
    }

    .card-badge.green {
      background-color: #1f6e43;
    }

    .card-badge.purple {
      background-color: #6f42c1;
    }

    .card-body-big {
      padding: 0.9rem 1rem 0.6rem 1rem;
    }

    .bagikan-mini {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      font-size: 0.65rem;
      font-weight: 500;
      background: #f0f4f9;
      padding: 0.15rem 0.7rem;
      border-radius: 30px;
      color: #3f6b8c;
      margin-bottom: 0.5rem;
      width: fit-content;
    }

    .venue-card-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: #1c4d72;
      margin-bottom: 0.2rem;
      line-height: 1.3;
    }

    .venue-location-big {
      display: flex;
      align-items: center;
      gap: 0.3rem;
      font-size: 0.7rem;
      color: #6c8eae;
      margin-bottom: 0.4rem;
    }

    .venue-description-big {
      font-size: 0.75rem;
      color: #2e577a;
      line-height: 1.4;
      margin-bottom: 0.6rem;
    }

    .action-link-big {
      display: inline-block;
      font-weight: 600;
      font-size: 0.75rem;
      color: #1f6e43;
      background: #eef5ea;
      padding: 0.25rem 0.9rem;
      border-radius: 2rem;
      text-decoration: none;
      transition: all 0.2s;
      margin: 0.2rem 0 0;
    }

    .action-link-big:hover {
      background: #1f6e43;
      color: white;
    }

    .card-divider-light {
      margin: 0.5rem 1rem 0 1rem;
      border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .card-footer-big {
      padding: 0.6rem 1rem 0.8rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }

    .footer-icon-big {
      width: 28px;
      height: 28px;
      background-color: #f0f4f9;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
      color: #2c7a4d;
    }

    .footer-text-big {
      font-size: 0.7rem;
      font-weight: 500;
      color: #4a6f8f;
    }

    .footer-text-big strong {
      color: #1c4d72;
      font-weight: 700;
    }

    /* hide old venue row */
    .venue-row {
      display: none;
    }

    .cta-text {
      background: #f3f9fe;
      border-radius: 20px;
      padding: 1rem 1.2rem;
      text-align: center;
      margin: 1rem 0 0.5rem;
      font-size: 0.85rem;
      color: #1f4e6e;
    }

    .author-bio {
      background: #fafdff;
      border-radius: 20px;
      border: 1px solid #eaf0f6;
      padding: 1.2rem;
      margin: 1rem 0;
    }

    .author-name {
      font-weight: 700;
      font-size: 1rem;
      color: #1e4a6e;
    }

    .author-desc {
      font-size: 0.75rem;
      color: #54718f;
      margin-top: 0.3rem;
    }

    .article-related {
      margin-top: 1.5rem;
    }

    .related-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #1e4a6e;
      margin-bottom: 1rem;
    }

    .related-card h4 {
      font-size: 1rem;
      font-weight: 700;
      color: #1c4d72;
      margin-bottom: 0.3rem;
    }

    .related-date {
      font-size: 0.7rem;
      color: #6e8eae;
      margin-top: 0.4rem;
    }

    .footer-note {
      padding: 1rem 2rem 1.8rem;
      font-size: 0.7rem;
      color: #819bb9;
      text-align: center;
      border-top: 1px solid #eef3f9;
    }

    @media (max-width: 700px) {
      body {
        padding: 1rem;
      }
      .blog-header, .promo-section, .footer-note {
        padding-left: 1.2rem;
        padding-right: 1.2rem;
      }
      h1 {
        font-size: 1.6rem;
      }
      .venue-card-title {
        font-size: 1rem;
      }
      .card-body-big {
        padding: 0.8rem;
      }
      .card-footer-big {
        padding: 0.5rem 0.8rem 0.7rem;
      }
    }
  </style>
</head>
<body>
<div class="loket-container">
  <!-- header -->
  <div class="blog-header">
    <div class="top-badge-row">
      <div class="loket-year-badge">LOKET 12 Tahun</div>
      <div class="share-news-row">
        <a href="#" class="bagikan-link">Bagikan</a>
        <span class="loket-news-badge">LOKET NEWS</span>
      </div>
    </div>
    <h1>ADA CASHBACK BUAT BELI TIKET PAKAI INDODANA PAYLATER!</h1>
    <div class="sk-caption">S&K berlaku</div>
    <div class="author-date">03 Nov 2025 - Winda Paramita</div>
  </div>

  <!-- 90's intimate -->
  <div class="promo-section">
    <div class="two-column-grid">
      <div class="event-card">
        <div class="event-title">Beli Tiket 90's Intimate 2nd Edition Jakarta</div>
        <a href="#" class="event-bagikan">Bagikan</a>
        <div style="font-size: 0.8rem; color: #2e577a; margin-top: 0.3rem;">Diskon hingga Rp150.000</div>
        <div style="font-size: 0.75rem; color: #6c8eae; margin-top: 0.5rem;">Min. transaksi Rp1.000.000</div>
      </div>
      <div class="event-card">
        <div class="event-title">90's Intimate 2nd Edition Solo</div>
        <a href="#" class="event-bagikan">Bagikan</a>
        <div style="font-size: 0.8rem; color: #2e577a; margin-top: 0.3rem;">Diskon spesial Rp150.000</div>
        <div style="font-size: 0.75rem; color: #6c8eae; margin-top: 0.5rem;">Berlaku hingga 7 Februari 2026</div>
      </div>
    </div>
    <div class="section-subhead" style="margin-top: 1rem;">Promo Tiket 90's Intimate 2nd Edition Jakarta & Solo Indodana PayLater</div>
  </div>

  <!-- Promo Event & Wahana -->
  <div class="promo-section">
    <h2 class="section-heading">Promo Beli Tiket Event & Wahana di LOKET</h2>
    <div class="promo-grid">
      <div class="promo-card">
        <div class="card-title">Diskon Rp150ribu Pakai Indodana PayLater</div>
        <div class="card-desc">Nikmati potongan besar untuk tiket event & wahana favorit.</div>
        <ul class="feature-list">
          <li><span class="dot"></span> Minimal transaksi Rp1.000.000</li>
          <li><span class="dot"></span> Periode 1–31 Januari 2026</li>
          <li><span class="dot"></span> Semua tenor Indodana PayLater</li>
          <li><span class="dot"></span> Tidak dapat digabung promo lain</li>
        </ul>
        <div class="badge-light">Eksklusif Indodana</div>
      </div>
      <div class="promo-card">
        <div class="card-title">Diskon Rp15ribu ke Beragam Event & Wahana Pakai Indodana PayLater!</div>
        <div class="card-desc">Khusus pengguna baru Indodana PayLater.</div>
        <ul class="feature-list">
          <li><span class="dot"></span> Minimal transaksi Rp150.000</li>
          <li><span class="dot"></span> Periode 1–31 Januari 2026</li>
          <li><span class="dot"></span> 1 kali per pengguna, kuota terbatas</li>
        </ul>
      </div>
      <div class="promo-card">
        <div class="card-title">Promo Cicilan 0% Untuk Tenor 3 Bulan dan 6 Bulan</div>
        <div class="card-desc">Bunga 0% untuk pembelian tiket event & wahana di LOKET.</div>
        <ul class="feature-list">
          <li><span class="dot"></span> Minimal transaksi Rp2.000.000</li>
          <li><span class="dot"></span> Periode 1–31 Januari 2026</li>
          <li><span class="dot"></span> Tidak dapat digabung promo lain</li>
          <li><span class="dot"></span> 1x per pengguna, kuota terbatas</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Promo Bioskop -->
  <div class="promo-section">
    <h2 class="section-heading">Promo Beli Tiket Bioskop di LOKET Screen</h2>
    <div class="section-subhead">Baru! Diskon hingga Rp25ribu Bayar Pakai Indodana PayLater</div>
    <div class="promo-grid">
      <div class="promo-card">
        <div class="card-title">Diskon Rp25.000 (Pengguna Baru)</div>
        <div class="card-desc">Minimal transaksi Rp50.000. Berlaku di seluruh bioskop LOKET Screen.</div>
        <ul class="feature-list">
          <li><span class="dot"></span> Periode 1–31 Januari 2026, mulai pukul 10.00 WIB</li>
          <li><span class="dot"></span> Eksklusif Indodana PayLater</li>
          <li><span class="dot"></span> Tidak dapat digabung dengan promo lain</li>
        </ul>
        <div class="terms-note">Kuota terbatas, 1x per transaksi.</div>
      </div>
      <div class="promo-card">
        <div class="card-title">Diskon Rp10.000 (Semua Pengguna)</div>
        <div class="card-desc">Untuk pelanggan Indodana PayLater yang loyal.</div>
        <ul class="feature-list">
          <li><span class="dot"></span> Minimal transaksi Rp50.000</li>
          <li><span class="dot"></span> Periode 1–31 Januari 2026</li>
          <li><span class="dot"></span> Berlaku semua tenor Indodana</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Rekomendasi Wahana Paling Keren! - smaller cards as requested -->
  <div class="promo-section">
    <h2 class="section-heading">Rekomendasi Wahana Paling Keren!</h2>
    <div class="big-cards-wrapper">
      
      <!-- Wahoo Waterworld (compact) -->
      <div class="big-venue-card">
        <div class="card-img-top">
          <img src="https://placehold.co/800x450/2c7a4d/white?text=Wahoo+Waterworld" 
               alt="Wahoo Waterworld Bandung"
               onerror="this.src='https://placehold.co/800x450/e0e7ef/2c3e50?text=Wahoo+Park'">
          <span class="card-badge green">Populer</span>
        </div>
        <div class="card-body-big">
          <div class="bagikan-mini"><i class="bi bi-share-fill"></i> Bagikan</div>
          <div class="venue-card-title">Wahoo Waterworld</div>
          <div class="venue-location-big"><i class="bi bi-geo-alt-fill"></i> Bandung, Jawa Barat</div>
          <div class="venue-description-big">Wahana air kelas internasional yang ada di Bandung, Jawa Barat! Siap-siap buat pengalaman berenang seru.</div>
          <a href="#" class="action-link-big">SIAP-SIAP BUAT BERENANG SERU DI SINI <i class="bi bi-arrow-right-short"></i></a>
        </div>
        <div class="card-divider-light"></div>
        <div class="card-footer-big">
          <div class="footer-icon-big"><i class="bi bi-water"></i></div>
          <div class="footer-text-big"><strong>Wahana Air Premium</strong> • Tiket mulai Rp85.000</div>
        </div>
      </div>

      <!-- Saloka Theme Park (compact) -->
      <div class="big-venue-card">
        <div class="card-img-top">
          <img src="https://placehold.co/800x450/1f6e43/white?text=Saloka+Theme+Park" 
               alt="Saloka Theme Park Jawa Tengah"
               onerror="this.src='https://placehold.co/800x450/e0e7ef/2c3e50?text=Saloka+Park'">
          <span class="card-badge green">Terlaris</span>
        </div>
        <div class="card-body-big">
          <div class="bagikan-mini"><i class="bi bi-share-fill"></i> Bagikan</div>
          <div class="venue-card-title">Saloka Theme Park</div>
          <div class="venue-location-big"><i class="bi bi-geo-alt-fill"></i> Jawa Tengah</div>
          <div class="venue-description-big">Taman rekreasi terbaik & terbesar se-Jawa Tengah! Wahana seru, atraksi budaya, promo spesial Indodana.</div>
          <a href="#" class="action-link-big">JADWALKAN LIBURAN KE SALOKA THEME PARK <i class="bi bi-arrow-right-short"></i></a>
        </div>
        <div class="card-divider-light"></div>
        <div class="card-footer-big">
          <div class="footer-icon-big"><i class="bi bi-tree-fill"></i></div>
          <div class="footer-text-big"><strong>Taman Hiburan Keluarga</strong> • Cashback hingga Rp150rb</div>
        </div>
      </div>

      <!-- Futari no Kimochi no Hon! (compact) -->
      <div class="big-venue-card">
        <div class="card-img-top">
          <img src="https://placehold.co/800x450/6f42c1/white?text=Futari+no+Kimochi+no+Hon" 
               alt="Futari no Kimochi no Hon - Anime Event"
               onerror="this.src='https://placehold.co/800x450/e0e7ef/4a2c6e?text=Anime+Event'">
          <span class="card-badge purple">Event Spesial</span>
        </div>
        <div class="card-body-big">
          <div class="bagikan-mini"><i class="bi bi-share-fill"></i> Bagikan</div>
          <div class="venue-card-title">Futari no Kimochi no Hon!</div>
          <div class="venue-location-big"><i class="bi bi-calendar-event"></i> Jakarta Convention Center • 12-13 Juni 2026</div>
          <div class="venue-description-big">Yasuna (CV: Chinatsu Akasaki), Soonya (CV: Yuki Akiyama) — penampilan eksklusif, meet & greet.</div>
          <div style="font-size: 0.7rem; color: #4a6f8f; margin: 0.2rem 0;"><i class="bi bi-mic"></i> Seiyuu: Chinatsu Akasaki & Yuki Akiyama</div>
          <div style="font-weight: 700; font-size: 0.85rem; color: #1c4d72; margin: 0.2rem 0;">Tiket mulai Rp180.000</div>
          <a href="#" class="action-link-big">PESAN TIKET EVENT <i class="bi bi-ticket-perforated"></i></a>
        </div>
        <div class="card-divider-light"></div>
        <div class="card-footer-big">
          <div class="footer-icon-big"><i class="bi bi-star-fill"></i></div>
          <div class="footer-text-big"><strong>Official Anime Event</strong> • Diskon 15% untuk Indodana</div>
        </div>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="promo-section" style="border-bottom: none;">
    <div class="cta-text">
      Yuk, cek event dan wahana seru lainnya yang wajib kamu datang! Pakai Indodana di sini!
    </div>
  </div>

  <!-- Author + Artikel Terkait -->
  <div class="promo-section" style="border-bottom: none; padding-top: 0;">
    <div class="author-bio">
      <div class="author-name">Winda Paramita</div>
      <div class="author-desc">Winda is a writer at LOKET & LOKET Screen. Her writing consists of events, concerts, and films. With more than 3 years in this field, worry not, she will take you to an interesting journey ahead!</div>
    </div>

    <div class="article-related">
      <div class="related-title">Artikel Terkait</div>
      <div class="related-grid">
        <div class="related-card">
          <h4>JENO & JAEMIN ke Indo, Ini Harga Tiket Fanmeeting NCT JNJM 2026</h4>
          <div class="related-date">Tiket akan mulai dijual pada 29 April 2026, cek harga tiketnya di sini!<br>17 Apr 2026 - Nandita Alfahira</div>
        </div>
        <div class="related-card">
          <h4>Beragam Diskon & Cashback Nonton Bioskop di LOKET Screen</h4>
          <div class="related-date">Ada banyak promo bioskop spesial buat nonton bioskop di bulan Maret!<br>01 Apr 2026 - Nandita Alfahira</div>
        </div>
        <div class="related-card">
          <h4>Ditunggu-tunggu, Ini Harga Tiket Konser EXO Jakarta 2026</h4>
          <div class="related-date">Tambah hari! Konser akan digelar 2 hari 6-7 Juni 2026, cek detail harga tiket konser EXO Jakarta di sini!<br>27 Mar 2026 - Nandita Alfahira</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer disclaimer -->
  <div class="footer-note">
    LOKET berhak membatalkan promo jika terjadi indikasi kecurangan atau pelanggaran ketentuan.<br>
    Promo tidak berlaku untuk pembelian tiket pesawat, hotel, atau produk non-event tertentu. Seluruh promo tidak dapat ditukar menjadi uang tunai.<br>
    Refund pembelian tiket akan mengakibatkan promo hangus (cashback tidak diberikan atau ditarik kembali).<br>
    Kuota promo bersifat terbatas dan dapat berubah sewaktu-waktu. Periode promo dapat diperpanjang atau dihentikan lebih awal berdasarkan kebijakan LOKET dan Indodana.
  </div>
</div>
</body>
</html>