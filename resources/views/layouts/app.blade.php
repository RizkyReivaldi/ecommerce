<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack('styles')
</head>

<body>

{{-- 🔹 SCROLL PROGRESS --}}
<div id="page-progress"></div>

<div class="theme-wrapper" id="themeWrapper">
@php
    $cartCount = auth()->check()
        ? (auth()->user()->cart?->items()->count() ?? 0)
        : 0;

    $wishlistCount = auth()->check()
        ? auth()->user()->wishlists()->count()
        : 0;

    $createEventRoute = auth()->check()
        ? route('catalog.create')
        : route('login');
@endphp

{{-- Desktop Navbar --}}
    @hasSection('navbar')
        @yield('navbar')
    @else
        <div class="d-none d-lg-block">
            @include('partials.navbar-desktop')
        </div>
        <div class="d-lg-none">
            @include('partials.navbar-mobile')
        </div>
    @endif

    <main class="min-vh-100 position-relative" style="z-index:2">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')
</div>




@stack('scripts')
</body>
</html>
