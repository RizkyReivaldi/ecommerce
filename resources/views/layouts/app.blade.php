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

{{-- 🔹 SCROLL PROGRESS --}}
<div id="page-progress"></div>

<div class="theme-wrapper" id="themeWrapper">

    {{-- 🌌 SKY SYSTEM --}}
    <div id="sky-effects">
        <div class="sky-layer sky-day active">
            <div class="sun-rays"></div>
            <div class="cloud-layer clouds-back"  data-depth="0.15"></div>
            <div class="cloud-layer clouds-mid"   data-depth="0.35"></div>
            <div class="cloud-layer clouds-front" data-depth="0.6"></div>
        </div>

        <div class="sky-layer sky-sunset"></div>

        <div class="sky-layer sky-night">
            <canvas id="starfield"></canvas>
            <div class="nebula"></div>
            <div class="moon"></div>
        </div>
    </div>

    @hasSection('navbar')
        @yield('navbar')
    @else
        @include('partials.navbar')
    @endif

    <main class="min-vh-100 position-relative" style="z-index:2">
        @yield('content')
    </main>

    @include('partials.footer')
</div>

{{-- =====================================================
   🌗 THEME + AUTO SKY
===================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('themeWrapper');
    const toggle  = document.getElementById('themeToggle');
    const moon    = document.querySelector('.moon');

    const layers = {
        day: document.querySelector('.sky-day'),
        sunset: document.querySelector('.sky-sunset'),
        night: document.querySelector('.sky-night')
    };

    function setSky(type) {
        Object.values(layers).forEach(l => l?.classList.remove('active'));
        layers[type]?.classList.add('active');
    }

    /* ============================
       🌗 DRAG MOON SYSTEM
    ============================ */

    let dragging = false;

    function updateByPosition(x) {
        if (!moon) return;

        const w = window.innerWidth;
        const p = Math.min(Math.max(x / w, 0), 1);

        moon.style.left = `${p * 100}%`;

        if (p < 0.35) {
            wrapper?.classList.remove('dark');
            setSky('day');
            toggle && (toggle.textContent = '🌙');
            localStorage.setItem('theme', 'light');
        }
        else if (p < 0.6) {
            wrapper?.classList.remove('dark');
            setSky('sunset');
            toggle && (toggle.textContent = '🌗');
        }
        else {
            wrapper?.classList.add('dark');
            setSky('night');
            toggle && (toggle.textContent = '☀️');
            localStorage.setItem('theme', 'dark');
        }
    }

    moon?.addEventListener('mousedown', e => {
        dragging = true;
        moon.classList.add('dragging');
        e.preventDefault();
    });

    window.addEventListener('mousemove', e => {
        if (!dragging) return;
        updateByPosition(e.clientX);
    });

    window.addEventListener('mouseup', () => {
        dragging = false;
        moon?.classList.remove('dragging');
    });

    /* TOUCH SUPPORT */
    moon?.addEventListener('touchstart', () => {
        dragging = true;
        moon.classList.add('dragging');
    }, { passive: true });

    window.addEventListener('touchmove', e => {
        if (!dragging) return;
        updateByPosition(e.touches[0].clientX);
    }, { passive: true });

    window.addEventListener('touchend', () => {
        dragging = false;
        moon?.classList.remove('dragging');
    });

    /* INITIAL STATE */
    const saved = localStorage.getItem('theme');
    if (saved === 'dark') {
        moon && (moon.style.left = '75%');
        wrapper?.classList.add('dark');
        setSky('night');
        toggle && (toggle.textContent = '☀️');
    } else {
        moon && (moon.style.left = '25%');
        setSky('day');
        toggle && (toggle.textContent = '🌙');
    }

    /* BUTTON STILL WORKS */
    toggle?.addEventListener('click', () => {
        const dark = wrapper?.classList.toggle('dark');
        setSky(dark ? 'night' : 'day');
        toggle.textContent = dark ? '☀️' : '🌙';
        moon && (moon.style.left = dark ? '75%' : '25%');
        localStorage.setItem('theme', dark ? 'dark' : 'light');
    });
});
</script>

{{-- =====================================================
   ☁️ CLOUD PARALLAX
===================================================== --}}
<script>
(() => {
    const layers = document.querySelectorAll('.cloud-layer');
    window.addEventListener('scroll', () => {
        const y = window.scrollY;
        layers.forEach(layer => {
            const d = parseFloat(layer.dataset.depth || 0.3);
            layer.style.transform = `translate3d(0, ${y * d}px, 0)`;
        });
    }, { passive: true });
})();
</script>

{{-- =====================================================
   🌌 STARFIELD
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
            ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
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

{{-- =====================================================
   🔔 TOAST + ❤️ WISHLIST + 🛒 CART (NO RELOAD)
===================================================== --}}
<script>
/* ================= TOAST ================= */

function showToast(text) {
    const toast = document.createElement('div');
    toast.className = 'toast-instax';
    toast.textContent = text;
    document.body.appendChild(toast);

    requestAnimationFrame(() => toast.classList.add('show'));

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 2000);
}

/* ================= BADGE UPDATE ================= */

function updateBadge(id, delta) {
    const badge = document.getElementById(id);
    if (!badge) return;

    let count = parseInt(badge.textContent || '0') + delta;

    if (count <= 0) {
        badge.textContent = '0';
        badge.style.display = 'none';
    } else {
        badge.textContent = count;
        badge.style.display = 'inline-block';
    }
}

/* ================= WISHLIST ================= */

async function toggleWishlist(productId, btn) {
    const icon = btn.querySelector('i');
    icon.classList.add('pop');

    const res = await fetch(`/wishlist/toggle/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    });

    if (res.status === 401) {
        location.href = '/login';
        return;
    }

    const data = await res.json();

    if (data.added) {
        icon.classList.replace('bi-heart', 'bi-heart-fill');
        showToast('❤️ Ditambahkan ke wishlist');
        updateBadge('wishlist-count', +1);
    } else {
        icon.classList.replace('bi-heart-fill', 'bi-heart');
        showToast('💔 Dihapus dari wishlist');
        updateBadge('wishlist-count', -1);
    }

    setTimeout(() => icon.classList.remove('pop'), 300);
}

/* ================= CART ================= */

async function addToCart(productId) {
    showToast('🛒 Ditambahkan ke keranjang');

    const res = await fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: document.getElementById(`qty-${productId}`)?.value || 1
        })
    });

    if (res.ok) {
        updateBadge('cart-count', +1);
    }
}

/* ================= QTY ================= */

function changeQty(id, step) {
    const input = document.getElementById(`qty-${id}`);
    if (!input) return;

    let v = parseInt(input.value) + step;
    input.value = Math.max(1, Math.min(input.max || 99, v));
}
</script>


{{-- =====================================================
   ⚡ PERFORMANCE
===================================================== --}}
<style>
#sky-effects,
.cloud-layer,
.nebula,
#starfield {
    will-change: transform, opacity;
}
</style>

@stack('scripts')
</body>
</html>
