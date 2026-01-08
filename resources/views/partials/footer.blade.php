<footer class="instax-footer mt-5">
    <div class="container py-5">
        <div class="row g-4">

            {{-- Brand --}}
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-brand mb-3">
                    <i class="bi bi-camera-fill me-2"></i>
                    Instax Shop
                </h5>
                <p class="footer-text">
                    Toko kamera Instax terpercaya.
                    Belanja kamera, film, dan aksesoris dengan aman & nyaman.
                </p>

                <div class="footer-social mt-3">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- Menu --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title">Menu</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('catalog.index') }}">Katalog</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>

            {{-- Help --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title">Bantuan</h6>
                <ul class="footer-links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Cara Belanja</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-title">Hubungi Kami</h6>
                <ul class="footer-contact">
                    <li><i class="bi bi-geo-alt"></i> Bandung, Indonesia</li>
                    <li><i class="bi bi-telephone"></i> (022) 123-4567</li>
                    <li><i class="bi bi-envelope"></i> support@instaxshop.com</li>
                </ul>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="footer-copy mb-2 mb-md-0">
                © {{ date('Y') }} Instax Shop. All rights reserved.
            </p>

            <img src="{{ asset('images/payment-methods.png') }}"
                 alt="Payment Methods"
                 class="footer-payments">
        </div>
    </div>
</footer>
