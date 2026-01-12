<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Toko Online') - {{ config('app.name') }}</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>

{{-- 🔹 SCROLL PROGRESS BAR --}}
<div id="page-progress"></div>

<div class="theme-wrapper" id="themeWrapper">

    {{-- 🌌 SKY SYSTEM --}}
    <div id="sky-effects">

        {{-- ☀️ DAY --}}
        <div class="sky-layer sky-day active">
            <div class="sun-rays"></div>
            <div class="cloud-layer clouds-back"  data-depth="0.15"></div>
            <div class="cloud-layer clouds-mid"   data-depth="0.35"></div>
            <div class="cloud-layer clouds-front" data-depth="0.6"></div>
        </div>

        {{-- 🌅 SUNSET --}}
        <div class="sky-layer sky-sunset"></div>

        {{-- 🌙 NIGHT --}}
        <div class="sky-layer sky-night">
            <canvas id="starfield"></canvas>
            <div class="nebula"></div>
            <div class="moon"></div>
        </div>

    </div>

    @include('partials.navbar')

    <main class="min-vh-100 position-relative" style="z-index:2">
        @yield('content')
    </main>

    @include('partials.footer')
</div>

{{-- =====================================================
   THEME + SKY ENGINE (PERFORMANCE SAFE)
===================================================== --}}
@stack('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('themeWrapper');
    const toggle  = document.getElementById('themeToggle');

    const day     = document.querySelector('.sky-day');
    const sunset  = document.querySelector('.sky-sunset');
    const night   = document.querySelector('.sky-night');

    function clearSky() {
        day?.classList.remove('active');
        sunset?.classList.remove('active');
        night?.classList.remove('active');
    }

    function setSky(mode) {
        clearSky();
        document.querySelector('.sky-' + mode)?.classList.add('active');
    }

    function applyTheme(theme, save = true) {
        wrapper.classList.toggle('dark', theme === 'dark');
        setSky(theme === 'dark' ? 'night' : 'day');
        toggle && (toggle.textContent = theme === 'dark' ? '☀️' : '🌙');
        save && localStorage.setItem('theme', theme);
    }

    function autoThemeByTime() {
        if (localStorage.getItem('theme')) return;
        const h = new Date().getHours();
        if (h >= 6 && h < 17) setSky('day');
        else if (h >= 17 && h < 19) setSky('sunset');
        else {
            wrapper.classList.add('dark');
            setSky('night');
        }
    }

    const saved = localStorage.getItem('theme');
    saved ? applyTheme(saved, false) : autoThemeByTime();

    toggle?.addEventListener('click', () => {
        applyTheme(wrapper.classList.contains('dark') ? 'light' : 'dark');
    });

    setInterval(autoThemeByTime, 60000);
});
</script>

{{-- =====================================================
   ☁️ CLOUD PARALLAX (DEPTH BASED, GPU SAFE)
===================================================== --}}
<script>
(() => {
    const layers = document.querySelectorAll('.cloud-layer');
    let lastY = window.scrollY;

    window.addEventListener('scroll', () => {
        const y = window.scrollY;
        const delta = y - lastY;
        lastY = y;

        layers.forEach(layer => {
            const depth = parseFloat(layer.dataset.depth || 0.3);
            layer.style.transform = `translate3d(0, ${y * depth}px, 0)`;
        });
    }, { passive: true });
})();
</script>

{{-- =====================================================
   🌌 STARFIELD (STRONG TWINKLE)
===================================================== --}}
<script>
(() => {
    const canvas = document.getElementById('starfield');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let w, h, stars = [];

    function resize() {
        w = canvas.width = window.innerWidth;
        h = canvas.height = window.innerHeight;
        stars = Array.from({ length: Math.floor(w * h / 8000) }, () => ({
            x: Math.random() * w,
            y: Math.random() * h,
            r: Math.random() * 1.8 + 0.3,
            a: Math.random(),
            s: Math.random() * 0.04 + 0.01
        }));
    }

    function draw() {
        ctx.clearRect(0,0,w,h);
        for (const s of stars) {
            s.a += s.s;
            if (s.a > 1 || s.a < 0) s.s *= -1;

            ctx.beginPath();
            ctx.arc(s.x, s.y, s.r, 0, Math.PI*2);
            ctx.fillStyle = `rgba(255,255,255,${s.a})`;
            ctx.fill();
        }
        requestAnimationFrame(draw);
    }

    window.addEventListener('resize', resize);
    resize();
    draw();
})();
</script>










{{-- bootstrap jangan di ganggu --}}

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
                console.error(error);
            }
        }

        function updateWishlistUI(productId, isAdded) {
            const buttons = document.querySelectorAll(`.wishlist-btn-${productId}`);

            buttons.forEach(btn => {
                const icon = btn.querySelector("i");
                if (isAdded) {
                    icon.classList.remove("bi-heart");
                    icon.classList.add("bi-heart-fill", "text-danger");
                } else {
                    icon.classList.remove("bi-heart-fill", "text-danger");
                    icon.classList.add("bi-heart");
                }
            });
        }

        function updateWishlistCounter(count) {
            const badge = document.getElementById("wishlist-count");
            if (!badge) return;

            badge.innerText = count;
            badge.style.display = count > 0 ? "inline-block" : "none";
        }
    </script>

    {{-- THEME TOGGLE --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
                const html = document.documentElement;
                const toggleBtn = document.getElementById("themeToggle");
                const icon = document.getElementById("themeIcon");

                if (!toggleBtn) return;

                const savedTheme = localStorage.getItem("theme") || "light";
                setTheme(savedTheme);

                toggleBtn.addEventListener("click", () => {
                    const newTheme = html.getAttribute("data-theme") === "dark" ? "light" : "dark";
                    setTheme(newTheme);
                });

                function setTheme(theme) {
                    html.setAttribute("data-theme", theme);
                    localStorage.setItem("theme", theme);

                    if (theme === "dark") {
                        icon.classList.replace("bi-moon-stars-fill", "bi-sun-fill");
                    } else {
                        icon.classList.replace("bi-sun-fill", "bi-moon-stars-fill");
                    }
                }
            });
    </script>


{{-- =====================================================
   ⚡ PERFORMANCE HINTS
===================================================== --}}
<style>
#sky-effects,
.cloud-layer,
.nebula,
#starfield {
    will-change: transform, opacity;
}
</style>

</body>
</html>
