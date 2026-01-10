{{-- ================================================
FILE: resources/views/layouts/app.blade.php
FUNGSI: Master layout customer / publik
================================================ --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Toko Online') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', 'Toko online terpercaya')">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
<div class="theme-wrapper" id="themeWrapper">

    {{-- 🌌 SKY SYSTEM --}}
    <div id="sky-effects">
        <div class="sky-layer sky-sunrise"></div>
        <div class="sky-layer sky-day active"></div>
        <div class="sky-layer sky-night"></div>

        <div class="cloud-layer clouds-back"></div>
        <div class="cloud-layer clouds-mid"></div>
        <div class="cloud-layer clouds-front"></div>

        <div class="sun-rays"></div>
        <div class="moon"></div>
        <div class="stars"></div>
    </div>

    @include('partials.navbar')

    <div class="container mt-3">
        @include('partials.flash-messages')
    </div>

    <main class="min-vh-100 position-relative" style="z-index:2">
        @yield('content')
    </main>

    @include('partials.footer')
</div>

{{-- ================= TOAST ================= --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".instax-toast").forEach(toast => {
        setTimeout(() => toast.remove(), 4500);
    });
});
</script>

{{-- ============ THEME + SKY ENGINE ============ --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('themeWrapper');
    const toggle = document.getElementById('themeToggle');

    const skies = {
        sunrise: document.querySelector('.sky-sunrise'),
        day: document.querySelector('.sky-day'),
        night: document.querySelector('.sky-night'),
    };

    function setSky(mode) {
        Object.values(skies).forEach(s => s?.classList.remove('active'));
        skies[mode]?.classList.add('active');
    }

    function autoThemeByTime() {
        const hour = new Date().getHours();

        if (hour >= 5 && hour < 8) {
            wrapper.classList.remove('dark');
            setSky('sunrise');
        } else if (hour >= 8 && hour < 18) {
            wrapper.classList.remove('dark');
            setSky('day');
        } else {
            wrapper.classList.add('dark');
            setSky('night');
        }
    }

    autoThemeByTime();

    toggle?.addEventListener('click', () => {
        wrapper.classList.toggle('dark');
        const dark = wrapper.classList.contains('dark');
        setSky(dark ? 'night' : 'day');
        localStorage.setItem('theme', dark ? 'dark' : 'light');
        toggle.innerText = dark ? '☀️' : '🌙';
    });
});
</script>

{{-- ============ SHOOTING STARS ============ --}}
<script>
setInterval(() => {
    const wrapper = document.getElementById('themeWrapper');
    if (!wrapper.classList.contains('dark')) return;

    const star = document.createElement('div');
    star.className = 'shooting-star';
    star.style.top = Math.random() * 40 + '%';
    star.style.left = Math.random() * 40 + '%';
    document.getElementById('sky-effects').appendChild(star);

    setTimeout(() => star.remove(), 1400);
}, 6000);
</script>

@stack('scripts')
</body>
</html>
