<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Loket - Platform Event & Tiket</title>
    <!-- Bootstrap 5 CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts (optional) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
     @include('partials.navbar')
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #ffffff;
        }
        /* Global link */
        a {
            text-decoration: none;
        }
        /* Custom scrollbars for horizontal sliders (modern) */
        .loket-scroll, .creator-scroll, .product-scroll {
            scroll-behavior: smooth;
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
        .loket-scroll::-webkit-scrollbar, .creator-scroll::-webkit-scrollbar, .product-scroll::-webkit-scrollbar {
            height: 6px;
        }
        .loket-scroll::-webkit-scrollbar-track, .creator-scroll::-webkit-scrollbar-track, .product-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .loket-scroll::-webkit-scrollbar-thumb, .creator-scroll::-webkit-scrollbar-thumb, .product-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        /* Banner Carousel */
        .banner-slide-img {
            height: 380px;
            object-fit: cover;
        }
        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 70%);
            pointer-events: none;
        }
        .carousel-caption {
            bottom: 25%;
            z-index: 2;
        }
        @media (max-width: 768px) {
            .banner-slide-img {
                height: 280px;
            }
            .carousel-caption h2 {
                font-size: 1.4rem;
            }
        }
        /* LOKET CARD (event card) */
        .loket-card {
            min-width: 260px;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            transition: all 0.25s ease;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .loket-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(0,0,0,0.15);
        }
        .loket-img-wrapper {
            height: 160px;
            overflow: hidden;
            background: #f8f9fc;
        }
        .loket-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .loket-card:hover .loket-img-wrapper img {
            transform: scale(1.05);
        }
        .loket-title {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.3;
            color: #0a1c3a;
        }
        .loket-date {
            font-size: 12px;
            color: #6c757d;
            margin-top: 6px;
        }
        .loket-price {
            font-weight: 800;
            color: #0d6efd;
            margin-top: 6px;
            font-size: 15px;
        }
        .loket-organizer {
            font-size: 12px;
            color: #7e8493;
            margin-top: 4px;
        }
        /* Poster card (LOKET screen) */
        .loket-poster-card {
            min-width: 180px;
            height: 260px;
            border-radius: 20px;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 12px 24px -12px rgba(0,0,0,0.2);
            transition: all 0.25s ease;
            cursor: pointer;
            background: #eef2ff;
        }
        .loket-poster-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .loket-poster-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 36px -12px rgba(0,0,0,0.25);
        }
        .loket-poster-card:hover img {
            transform: scale(1.04);
        }
        /* PROMO BANNER (Loket Creator) */
        .loket-promo-banner {
            background: linear-gradient(115deg, #fef9e6 0%, #fff2e0 100%);
            border-radius: 28px;
            padding: 24px 32px;
            position: relative;
            border: 1px solid rgba(255,106,0,0.2);
        }
        .loket-promo-logo {
            font-size: 22px;
            font-weight: 800;
            background: #1e2f5e;
            padding: 6px 14px;
            border-radius: 40px;
            color: white;
        }
        .loket-promo-logo span {
            color: #ff9f4a;
            font-weight: 800;
        }
        .loket-pill {
            background: #ff6a00;
            color: white;
            padding: 6px 16px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: -0.2px;
        }
        .loket-big {
            font-size: 42px;
            font-weight: 800;
            color: #0d6efd;
            line-height: 1;
        }
        .loket-hashtag {
            font-weight: 700;
            background: rgba(0,0,0,0.04);
            padding: 6px 16px;
            border-radius: 40px;
            color: #2c3e66;
        }
        @media (max-width: 760px) {
            .loket-promo-banner {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }
            .loket-big {
                font-size: 34px;
            }
        }
        /* Top 3 Best Seller */
        .top-rank-item {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(2px);
            border-radius: 20px;
            padding: 12px 16px;
            transition: 0.2s;
        }
        .rank-number {
            font-size: 56px;
            font-weight: 800;
            color: rgba(255,255,255,0.3);
            -webkit-text-stroke: 2px #ffd966;
            text-stroke: 2px #ffd966;
            line-height: 1;
        }
        .rank-banner {
            width: 180px;
            height: 80px;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
        .rank-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* Category Cards */
        .category-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 16px 8px;
            text-align: center;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            border: 1px solid #f0f2f5;
            display: block;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.08);
            border-color: #e0e7ff;
        }
        .category-img {
            width: 70px;
            height: 70px;
            margin: 0 auto 12px;
            border-radius: 60px;
            overflow: hidden;
            background: #f8fafc;
        }
        .category-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .category-name {
            font-weight: 600;
            font-size: 13px;
            color: #1e293b;
        }
        /* Creator Logo Circle */
        .creator-logo-card {
            min-width: 100px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
        }
        .creator-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
            background: white;
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
            border: 2px solid white;
        }
        .creator-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .creator-name {
            font-size: 12px;
            font-weight: 500;
            margin-top: 10px;
            color: #1e2a47;
        }
        /* Custom slider buttons (carousel) */
        .custom-slider-btn {
            width: 44px !important;
            height: 44px !important;
            background-color: white !important;
            border-radius: 60px !important;
            border: 1px solid #dee2e6 !important;
            opacity: 1 !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            box-shadow: 0 6px 14px rgba(0,0,0,0.08) !important;
        }
        .custom-slider-btn i {
            font-size: 1.5rem;
            color: #0d6efd;
        }
        .support-illustration i {
            font-size: 70px;
            opacity: 0.3;
        }
        /* section soft background */
        .section-soft {
            background: #fbfdff;
        }
    </style>
</head>
<body>

    <!-- The homepage content (without navbar & footer as requested) -->
    <main>

        {{-- 1. Main Banner Carousel --}}
        <section class="homepage-banner py-4">
            <div class="container">
                <div id="homepageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-4 overflow-hidden shadow-sm">
                        <!-- dynamic using dummy data to match style -->
                        <div class="carousel-item active">
                            <div class="banner-slide position-relative">
                                <img src="https://picsum.photos/id/104/1600/500" class="d-block w-100 banner-slide-img" alt="Event Konser">
                                <div class="banner-overlay"></div>
                                <div class="carousel-caption text-start text-white p-4 p-md-5">
                                    <span class="badge bg-warning text-dark mb-3">HOT EVENT</span>
                                    <h2 class="fw-bold">Konser Musicland 2025</h2>
                                    <p class="lead mb-3">Jakarta, 15-16 Maret 2025</p>
                                    <a href="#" class="btn btn-light btn-lg rounded-pill px-4">Pesan Tiket</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner-slide position-relative">
                                <img src="https://picsum.photos/id/15/1600/500" class="d-block w-100 banner-slide-img" alt="Seminar">
                                <div class="banner-overlay"></div>
                                <div class="carousel-caption text-start text-white p-4 p-md-5">
                                    <span class="badge bg-primary mb-3">Featured</span>
                                    <h2 class="fw-bold">Future Fest 2025</h2>
                                    <p class="lead mb-3">Startup & Innovation Summit</p>
                                    <a href="#" class="btn btn-light btn-lg rounded-pill">Lihat Produk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        {{-- 2. Featured Events (Scroll) --}}
        <section class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/29/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Jakarta Fair 2025</h6><div class="loket-date">10 Apr 2025</div><div class="loket-price">Rp125.000</div><div class="loket-organizer">Loket Official</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/96/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">DWP 2025 Djakarta Warehouse</h6><div class="loket-date">12 Des 2025</div><div class="loket-price">Rp850.000</div><div class="loket-organizer">Ismaya Live</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/22/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">We The Fest 2025</h6><div class="loket-date">20 Jul 2025</div><div class="loket-price">Rp1.200.000</div><div class="loket-organizer">WTF Production</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/169/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Pestapora 2025</h6><div class="loket-date">5 Sep 2025</div><div class="loket-price">Rp350.000</div><div class="loket-organizer">Pestapora</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/42/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Bali Blues Festival</h6><div class="loket-date">28 Jun 2025</div><div class="loket-price">Rp275.000</div><div class="loket-organizer">Bali Events</div></div></div>
                </div>
            </div>
        </section>  
        <section class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/29/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Jakarta Fair 2025</h6><div class="loket-date">10 Apr 2025</div><div class="loket-price">Rp125.000</div><div class="loket-organizer">Loket Official</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/96/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">DWP 2025 Djakarta Warehouse</h6><div class="loket-date">12 Des 2025</div><div class="loket-price">Rp850.000</div><div class="loket-organizer">Ismaya Live</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/22/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">We The Fest 2025</h6><div class="loket-date">20 Jul 2025</div><div class="loket-price">Rp1.200.000</div><div class="loket-organizer">WTF Production</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/169/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Pestapora 2025</h6><div class="loket-date">5 Sep 2025</div><div class="loket-price">Rp350.000</div><div class="loket-organizer">Pestapora</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/42/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Bali Blues Festival</h6><div class="loket-date">28 Jun 2025</div><div class="loket-price">Rp275.000</div><div class="loket-organizer">Bali Events</div></div></div>
                </div>
            </div>
        </section>  
        <section class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/29/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Jakarta Fair 2025</h6><div class="loket-date">10 Apr 2025</div><div class="loket-price">Rp125.000</div><div class="loket-organizer">Loket Official</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/96/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">DWP 2025 Djakarta Warehouse</h6><div class="loket-date">12 Des 2025</div><div class="loket-price">Rp850.000</div><div class="loket-organizer">Ismaya Live</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/22/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">We The Fest 2025</h6><div class="loket-date">20 Jul 2025</div><div class="loket-price">Rp1.200.000</div><div class="loket-organizer">WTF Production</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/169/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Pestapora 2025</h6><div class="loket-date">5 Sep 2025</div><div class="loket-price">Rp350.000</div><div class="loket-organizer">Pestapora</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/42/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Bali Blues Festival</h6><div class="loket-date">28 Jun 2025</div><div class="loket-price">Rp275.000</div><div class="loket-organizer">Bali Events</div></div></div>
                </div>
            </div>
        </section>  
        <section class="py-4">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/29/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Jakarta Fair 2025</h6><div class="loket-date">10 Apr 2025</div><div class="loket-price">Rp125.000</div><div class="loket-organizer">Loket Official</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/96/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">DWP 2025 Djakarta Warehouse</h6><div class="loket-date">12 Des 2025</div><div class="loket-price">Rp850.000</div><div class="loket-organizer">Ismaya Live</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/22/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">We The Fest 2025</h6><div class="loket-date">20 Jul 2025</div><div class="loket-price">Rp1.200.000</div><div class="loket-organizer">WTF Production</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/169/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Pestapora 2025</h6><div class="loket-date">5 Sep 2025</div><div class="loket-price">Rp350.000</div><div class="loket-organizer">Pestapora</div></div></div>
                    <div class="loket-card"><div class="loket-img-wrapper"><img src="https://picsum.photos/id/42/400/200" alt="event"></div><div class="p-3"><h6 class="loket-title">Bali Blues Festival</h6><div class="loket-date">28 Jun 2025</div><div class="loket-price">Rp275.000</div><div class="loket-organizer">Bali Events</div></div></div>
                </div>
            </div>
        </section>  
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // optional: smooth interactions
        document.querySelectorAll('.carousel').forEach(carousel => {
            new bootstrap.Carousel(carousel, { interval: 5000, wrap: true });
        });
    </script>
</body>
</html>