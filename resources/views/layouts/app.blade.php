{{-- ================================================
FILE: resources/views/layouts/app.blade.php
FUNGSI: Master layout untuk halaman customer/publik
================================================ --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', 'Toko Online') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', 'Toko online terpercaya dengan produk berkualitas')">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ================================
    GLOBAL THEME STYLE (SAFE)
    ================================ --}}
    @stack('styles')
    <style>
        /* ===== THEME VARIABLES ===== */
        .theme-wrapper {
            --bg-main: #f8fcfd;
            --bg-glass: rgba(255,255,255,0.65);
            --text-main: #3b5f6b;
            --text-muted: #6b98a5;
            --border-glass: rgba(255,255,255,0.35);
        }

        .theme-wrapper.dark {
            --bg-main: #0f172a;
            --bg-glass: rgba(30,41,59,0.6);
            --text-main: #e2e8f0;
            --text-muted: #94a3b8;
            --border-glass: rgba(255,255,255,0.08);
        }

        /* ===== PAGE BACKGROUND ===== */
        .theme-wrapper {
            min-height: 100vh;
            background: linear-gradient(
                180deg,
                var(--bg-main),
                #ffffff
            );
            transition: background 0.4s ease;
        }

        /* ===== GLASS CARD ===== */
        .glass-card,
        .product-card {
            background: var(--bg-glass);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid var(--border-glass);
            border-radius: 18px;
            transition: 0.35s ease;
        }

        .glass-card:hover,
        .product-card:hover {
            transform: translateY(-6px);
        }

        /* ===== TEXT ADAPTIVE ===== */
        h1, h2, h3, h4, h5,
        .card-title,
        .product-title {
            color: var(--text-main);
        }

        .text-muted {
            color: var(--text-muted) !important;
        }
    </style>
</head>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const toasts = document.querySelectorAll(".instax-toast");

    toasts.forEach(toast => {
        // Auto dismiss
        setTimeout(() => dismissToast(toast), 4500);

        // Manual close
        toast.querySelector(".toast-close")
            .addEventListener("click", () => dismissToast(toast));
    });

    function dismissToast(toast) {
        toast.style.animation = "toast-out 0.35s ease forwards";
        setTimeout(() => toast.remove(), 350);
    }
});
</script>

<body>
    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- FLASH MESSAGES --}}
    <div class="container mt-3">
        @include('partials.flash-messages')
    </div>

    {{-- ================================
    MAIN CONTENT (WRAPPED SAFELY)
    ================================ --}}
    <main class="min-vh-100">
        <div class="theme-wrapper">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    {{-- ================================
    EXISTING SCRIPTS (UNCHANGED)
    ================================ --}}
    @stack('scripts')

    {{-- THEME SWITCHER (ISOLATED & SAFE) --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const wrapper = document.querySelector('.theme-wrapper');
            const toggleBtn = document.getElementById('themeToggle');
            if (!wrapper || !toggleBtn) return;

            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                wrapper.classList.add('dark');
                toggleBtn.innerText = '☀️';
            }

            toggleBtn.addEventListener('click', () => {
                wrapper.classList.toggle('dark');
                const isDark = wrapper.classList.contains('dark');
                toggleBtn.innerText = isDark ? '☀️' : '🌙';
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });
        });
    </script>

    {{-- ================================
    WISHLIST SCRIPT (ORIGINAL)
    ================================ --}}
    <script>
        async function toggleWishlist(productId) {
            try {
                const token = document.querySelector('meta[name="csrf-token"]').content;
                const response = await fetch(`/wishlist/toggle/${productId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                    },
                });

                if (response.status === 401) {
                    window.location.href = "/login";
                    return;
                }

                const data = await response.json();

                if (data.status === "success") {
                    updateWishlistUI(productId, data.added);
                    updateWishlistCounter(data.count);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }

        function updateWishlistUI(productId, isAdded) {
            const buttons = document.querySelectorAll(`.wishlist-btn-${productId}`);
            buttons.forEach(btn => {
                const icon = btn.querySelector("i");
                icon.className = isAdded
                    ? "bi bi-heart-fill text-danger"
                    : "bi bi-heart text-secondary";
            });
        }

        function updateWishlistCounter(count) {
            const badge = document.getElementById("wishlist-count");
            if (badge) {
                badge.innerText = count;
                badge.style.display = count > 0 ? "inline-block" : "none";
            }
        }
    </script>

</body>
</html>
