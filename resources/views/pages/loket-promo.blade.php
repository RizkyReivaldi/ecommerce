<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promo Indodana - LOKET</title>
  <meta name="description" content="Ada cashback buat beli tiket pakai Indodana PayLater di LOKET.">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
      background: #fbfbfb;
      color: #20344e;
      line-height: 1.6;
    }
    .topbar {
      background: #12244d;
      color: #fff;
      position: sticky;
      top: 0;
      z-index: 20;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .topbar-inner {
      max-width: 1200px;
      margin: 0 auto;
      padding: 14px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
    }
    .logo { font-weight: 800; font-size: 24px; letter-spacing: 0.3px; }
    .menu { display: flex; gap: 16px; font-size: 13px; flex-wrap: wrap; }
    .menu a { color: #dce7ff; text-decoration: none; }
    .menu a:hover { color: #fff; }
    .hero {
      background: #12244d;
    }
    .hero-inner {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
    }
    .hero-left {
      padding: 60px 38px;
      background: linear-gradient(140deg, #003899 0%, #0049cc 100%);
      color: #fff;
      position: relative;
      overflow: hidden;
    }
    .hero-left::before,
    .hero-left::after {
      content: "";
      position: absolute;
      border-radius: 999px;
      pointer-events: none;
    }
    .hero-left::before {
      width: 250px;
      height: 250px;
      right: -90px;
      top: -90px;
      background: rgba(255, 255, 255, 0.09);
      filter: blur(6px);
    }
    .hero-left::after {
      width: 220px;
      height: 220px;
      left: -70px;
      bottom: -70px;
      background: rgba(34, 137, 255, 0.22);
      filter: blur(6px);
    }
    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border: 1px solid rgba(255, 255, 255, 0.35);
      background: rgba(255, 255, 255, 0.18);
      border-radius: 999px;
      padding: 6px 12px;
      font-size: 13px;
      margin-bottom: 26px;
      position: relative;
      z-index: 1;
    }
    .hero h1 {
      font-size: clamp(30px, 4vw, 60px);
      line-height: 1.08;
      color: #fff;
      font-weight: 800;
      position: relative;
      z-index: 1;
    }
    .hero-note {
      margin-top: 26px;
      color: rgba(255, 255, 255, 0.82);
      font-size: 14px;
      position: relative;
      z-index: 1;
    }
    .hero-right {
      background: #0a1a3f;
      padding: 28px;
      color: #fff;
    }
    .hero-badges {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .hepi {
      background: #ffd84d;
      color: #17305a;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 24px;
      font-weight: 800;
      transform: rotate(-3deg);
    }
    .indodana {
      background: #fff;
      color: #2a415f;
      border-radius: 8px;
      padding: 9px 12px;
      font-weight: 700;
      font-size: 16px;
    }
    .promo-badge {
      border-radius: 12px;
      padding: 12px 14px;
      margin-bottom: 10px;
      color: #fff;
    }
    .promo-badge.green { background: linear-gradient(90deg, #4caf50, #388e3c); }
    .promo-badge.blue { background: linear-gradient(90deg, #2f79ff, #1148b6); }
    .promo-badge .title { font-size: 18px; font-weight: 800; line-height: 1.2; }
    .promo-badge .sub { font-size: 13px; opacity: 0.9; margin-top: 2px; }
    .special {
      margin-top: 18px;
      border-top: 1px solid rgba(255, 255, 255, 0.14);
      padding-top: 14px;
      text-align: right;
      font-size: 13px;
    }
    .special .label {
      background: #ff3f3f;
      padding: 3px 8px;
      border-radius: 999px;
      font-size: 10px;
      font-weight: 700;
      margin-right: 6px;
    }
    .page {
      max-width: 1100px;
      margin: 34px auto 70px;
      padding: 0 14px;
      display: grid;
      grid-template-columns: 72px 1fr;
      gap: 16px;
    }
    .share {
      position: sticky;
      top: 90px;
      height: fit-content;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      color: #7a8ba1;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .share-btn {
      width: 36px;
      height: 36px;
      display: inline-block;
      border-radius: 999px;
      text-align: center;
      line-height: 36px;
      font-weight: 700;
      text-decoration: none;
      color: #fff;
      font-size: 13px;
    }
    .fb { background: #2f62d6; }
    .tw { background: #1da1f2; }
    .ln { background: #97a6ba; }
    .article {
      background: #fff;
      border: 1px solid #e8edf4;
      border-radius: 18px;
      padding: 28px;
    }
    .news-tag {
      color: #245ca5;
      font-size: 13px;
      font-weight: 700;
      margin-bottom: 8px;
    }
    .article h1 {
      font-size: clamp(28px, 3.6vw, 44px);
      line-height: 1.2;
      color: #152955;
      margin-bottom: 8px;
    }
    .meta {
      font-size: 14px;
      color: #687d95;
      border-bottom: 1px solid #edf2f8;
      padding-bottom: 14px;
      margin-bottom: 18px;
    }
    .article p { color: #415b78; margin-bottom: 12px; }
    .article-banner {
      width: 100%;
      border-radius: 12px;
      border: 1px solid #e2eaf4;
      margin-bottom: 14px;
      display: block;
    }
    .cta {
      text-align: center;
      margin: 20px 0 12px;
    }
    .cta a {
      display: inline-block;
      background: #245ca5;
      color: #fff;
      text-decoration: none;
      font-weight: 700;
      padding: 11px 18px;
      border-radius: 999px;
    }
    .section {
      margin-top: 26px;
      border: 1px solid #e4ecf6;
      border-radius: 16px;
      padding: 18px;
      background: #fbfdff;
    }
    .section h2 {
      font-size: 28px;
      color: #152955;
      margin-bottom: 12px;
      line-height: 1.2;
    }
    .section h3 {
      font-size: 21px;
      color: #1b3f68;
      margin: 16px 0 8px;
      line-height: 1.3;
    }
    .btn-row {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 10px;
      margin: 12px 0;
    }
    .btn-mini {
      text-align: center;
      text-decoration: none;
      background: #245ca5;
      color: #fff;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
      padding: 10px 12px;
    }
    .section ol {
      margin-left: 20px;
      color: #445f7d;
      font-size: 14px;
    }
    .section ol li { margin-bottom: 6px; }
    .cinema {
      background: #121824;
      color: #ecf3ff;
    }
    .cinema h2, .cinema h3 { color: #fff; }
    .cinema h3 { color: #ffd55f; }
    .cinema ol { color: #cad6ea; }
    .cards2 {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 14px;
      margin-top: 10px;
    }
    .card2 {
      background: #fff;
      border: 1px solid #e8eef6;
      border-radius: 14px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }
    .img {
      width: 100%;
      aspect-ratio: 16 / 9;
      object-fit: cover;
      background: #e8f0fb;
    }
    .card2 .txt { padding: 14px; }
    .card2 h4 { color: #152955; font-size: 20px; margin-bottom: 6px; }
    .card2 p { color: #58708d; font-size: 14px; }
    .outline-btn {
      margin-top: 12px;
      border: 1px solid #245ca5;
      color: #245ca5;
      font-size: 12px;
      font-weight: 700;
      border-radius: 10px;
      text-align: center;
      padding: 9px 10px;
    }
    .author-box {
      margin-top: 18px;
      border: 1px solid #e5ebf3;
      border-radius: 14px;
      background: #fff;
      padding: 14px;
    }
    .related {
      margin-top: 10px;
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 12px;
    }
    .rel {
      border: 1px solid #e8edf4;
      border-radius: 12px;
      overflow: hidden;
      background: #fff;
    }
    .rel .img { aspect-ratio: 4 / 3; }
    .rel .txt { padding: 10px; }
    .rel .date { font-size: 12px; color: #7a8ba1; margin-bottom: 4px; }
    .rel h5 { font-size: 14px; line-height: 1.4; color: #1d3552; }
    .loket-footer {
      background: #ffffff;
      border-top: 1px solid #e8edf4;
      margin-top: 24px;
      padding: 26px 0 20px;
    }
    .loket-footer-shell {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 14px;
    }
    .loket-footer-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 16px;
    }
    .loket-footer h4 {
      font-size: 15px;
      color: #1d3552;
      margin-bottom: 10px;
      font-weight: 800;
    }
    .loket-footer ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: grid;
      gap: 6px;
    }
    .loket-footer a {
      font-size: 13px;
      color: #5f7088;
      text-decoration: none;
    }
    .loket-footer a:hover {
      color: #245ca5;
    }
    .loket-footer-meta {
      border-top: 1px solid #edf2f8;
      margin-top: 16px;
      padding-top: 12px;
      display: flex;
      justify-content: space-between;
      gap: 10px;
      flex-wrap: wrap;
      font-size: 12px;
      color: #7a8ba1;
    }
    .loket-footer-meta-links {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
    .loket-footer-meta a {
      color: #5f7088;
      text-decoration: none;
    }
    @media (max-width: 1024px) {
      .page { grid-template-columns: 1fr; }
      .share { display: none; }
    }
    @media (max-width: 900px) {
      .hero-inner { grid-template-columns: 1fr; }
    }
    @media (max-width: 760px) {
      .menu { display: none; }
      .article { padding: 18px; }
      .section h2 { font-size: 24px; }
      .section h3 { font-size: 19px; }
      .btn-row, .cards2, .related { grid-template-columns: 1fr; }
      .loket-footer-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
@include('partials.promo-navbar')

<section class="hero">
  <div class="hero-inner">
    <div class="hero-left">
      <div class="hero-tag"><strong>LOKET</strong><span>12 Tahun</span></div>
      <h1>ADA CASHBACK BUAT BELI TIKET PAKAI INDODANA PAYLATER!</h1>
      <div class="hero-note">*S&amp;K berlaku</div>
    </div>
    <div class="hero-right">
      <div class="hero-badges">
        <div class="hepi">HEPI!</div>
        <div class="indodana">Indodana PayLater</div>
      </div>
      <div class="promo-badge green">
        <div class="title">DISKON EVENT &amp; WAHANA S.D Rp150rb</div>
        <div class="sub">Min. transaksi Rp1jt</div>
      </div>
      <div class="promo-badge blue">
        <div class="title">CICILAN 0%</div>
        <div class="sub">Min. transaksi Rp2jt, tenor 3 &amp; 6 bulan</div>
      </div>
      <div class="promo-badge green">
        <div class="title">DISKON EVENT &amp; WAHANA S.D Rp15rb</div>
        <div class="sub">Min. transaksi Rp150rb</div>
      </div>
      <div class="special">
        <span class="label">PROMO SPESIAL</span> 90's Intimate - Diskon Rp150rb
      </div>
    </div>
  </div>
</section>

<main class="page">
  <aside class="share">
    <span>Bagikan</span>
    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.loket.com/blog/promo-indodana" target="_blank" rel="noopener noreferrer" class="share-btn fb">f</a>
    <a href="https://x.com/intent/post?url=https://www.loket.com/blog/promo-indodana&text=Ada%20Cashback%20Buat%20Beli%20Tiket%20Pakai%20Indodana%20PayLater!" target="_blank" rel="noopener noreferrer" class="share-btn tw">t</a>
    <a href="https://www.loket.com/blog/promo-indodana" target="_blank" rel="noopener noreferrer" class="share-btn ln">ln</a>
  </aside>

  <article class="article">
    <div class="news-tag">LOKET NEWS</div>
    <h1>Ada Cashback Buat Beli Tiket Pakai Indodana PayLater!</h1>
    <div class="meta">03 Nov 2025 - Winda Paramita</div>
    <img class="article-banner" src="{{ asset('images/promo-indodana-hero.svg') }}" alt="Banner promo Indodana">

    <p>
      Kabar gembira buat kamu yang suka nonton konser, main ke wahana, atau nonton bioskop.
      Sekarang beli tiket di LOKET bisa lebih hemat pakai <strong>Indodana PayLater</strong>.
    </p>
    <p>
      Ada diskon sampai Rp150.000 untuk event dan wahana, promo bioskop LOKET Screen,
      dan cicilan 0% tenor 3 serta 6 bulan.
    </p>
    <div class="cta"><a href="https://www.loket.com/event" target="_blank" rel="noopener noreferrer">Beli tiket di sini</a></div>

    <section class="section">
      <h2>Promo Spesial 90's Intimate 2nd Edition</h2>
      <div class="btn-row">
        <a href="https://www.loket.com/event" target="_blank" rel="noopener noreferrer" class="btn-mini">Beli Tiket 90's Intimate Jakarta</a>
        <a href="https://www.loket.com/event" target="_blank" rel="noopener noreferrer" class="btn-mini">Beli Tiket 90's Intimate Solo</a>
      </div>
      <h3>Syarat &amp; Ketentuan</h3>
      <ol>
        <li>Diskon Rp150.000 dengan minimum transaksi Rp1.000.000.</li>
        <li>Berlaku untuk pembayaran menggunakan Indodana PayLater.</li>
        <li>Berlaku untuk 90's Intimate 2nd Edition Jakarta dan Solo.</li>
        <li>Tidak dapat digabungkan dengan promo lain.</li>
        <li>Kuota promo terbatas.</li>
      </ol>
    </section>

    <section class="section">
      <h2>Promo Beli Tiket Event &amp; Wahana di LOKET</h2>
      <h3>Diskon Rp150ribu Pakai Indodana PayLater</h3>
      <ol>
        <li>Diskon Rp150.000, minimum transaksi Rp1.000.000.</li>
        <li>Berlaku untuk pembelian event dan wahana.</li>
        <li>Periode promo 1-31 Januari 2026.</li>
      </ol>

      <h3>Diskon Rp15ribu ke Beragam Event &amp; Wahana</h3>
      <ol>
        <li>Diskon Rp15.000, minimum transaksi Rp150.000.</li>
        <li>Berlaku untuk pengguna baru.</li>
        <li>Tenor 3, 6, dan 12 bulan.</li>
      </ol>

      <h3>Promo Cicilan 0% Untuk Tenor 3 Bulan dan 6 Bulan</h3>
      <ol>
        <li>Minimum transaksi Rp2.000.000.</li>
        <li>Khusus pembayaran Indodana PayLater.</li>
        <li>Kuota promo terbatas.</li>
      </ol>
    </section>

    <section class="section cinema">
      <h2>Promo Beli Tiket Bioskop di LOKET Screen</h2>
      <h3>Baru! Diskon hingga Rp25ribu Bayar Pakai Indodana PayLater</h3>
      <ol>
        <li>Diskon Rp25ribu untuk pengguna baru.</li>
        <li>Diskon Rp10ribu untuk pengguna setia.</li>
        <li>Minimum transaksi Rp50.000.</li>
        <li>Periode promo 1-31 Januari 2026.</li>
      </ol>
    </section>

    <section class="section">
      <h2>Rekomendasi Wahana Paling Keren!</h2>
      <div class="cards2">
        <div class="card2">
          <img class="img" src="{{ asset('images/promo-wahoo.svg') }}" alt="Wahoo Waterworld">
          <div class="txt">
            <h4>Wahoo Waterworld</h4>
            <p>Wahana air kelas internasional yang ada di Bandung, Jawa Barat.</p>
            <div class="outline-btn">SIAP-SIAP BUAT BERENANG SERU DI SINI</div>
          </div>
        </div>
        <div class="card2">
          <img class="img" src="{{ asset('images/promo-saloka.svg') }}" alt="Saloka Theme Park">
          <div class="txt">
            <h4>Saloka Theme Park</h4>
            <p>Taman rekreasi terbaik &amp; terbesar se-Jawa Tengah.</p>
            <div class="outline-btn">JADWALKAN LIBURAN KE SALOKA THEME PARK</div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <h2>Penulis</h2>
      <div class="author-box">
        <strong>Winda Paramita</strong>
        <p>Content Writer di LOKET yang membahas event, konser, dan promo.</p>
      </div>

      <h3>Artikel Terkait</h3>
      <div class="related">
        <div class="rel">
          <img class="img" src="{{ asset('images/promo-related.svg') }}" alt="Artikel 1">
          <div class="txt">
            <div class="date">17 Apr 2026</div>
            <h5>JENO &amp; JAEMIN ke Indo, Ini Harga Tiket Fanmeeting NCT JNJM 2026</h5>
          </div>
        </div>
        <div class="rel">
          <img class="img" src="{{ asset('images/promo-related.svg') }}" alt="Artikel 2">
          <div class="txt">
            <div class="date">01 Apr 2026</div>
            <h5>Beragam Diskon &amp; Cashback Nonton Bioskop di LOKET Screen</h5>
          </div>
        </div>
        <div class="rel">
          <img class="img" src="{{ asset('images/promo-related.svg') }}" alt="Artikel 3">
          <div class="txt">
            <div class="date">27 Mar 2026</div>
            <h5>Ditunggu-tunggu, Ini Harga Tiket Konser EXO Jakarta 2026</h5>
          </div>
        </div>
      </div>
    </section>
  </article>
</main>
@include('partials.footer')
</body>
</html>