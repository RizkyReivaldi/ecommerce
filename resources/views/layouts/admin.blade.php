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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- ADD BOOTSTRAP CSS HERE -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Also add Bootstrap Icons (optional but nice) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack('styles')

    <style>
/* FORCE FIX - Override sky effects on admin content */
.admin-main,
.admin-main main,
.container-fluid,
.card,
.table,
.modal-content,
.modal-header,
.modal-body,
.modal-footer {
    background-color: #f8f9fa !important;
    color: #212529 !important;
}

.card-header {
    background-color: #0d6efd !important;
    color: white !important;
}

.card-header h5,
.card-header small {
    color: white !important;
}

.table thead th {
    background-color: #e9ecef !important;
    color: #212529 !important;
}

.table tbody td {
    background-color: white !important;
    color: #212529 !important;
}

/* Fix text visibility */
.text-muted {
    color: #6c757d !important;
}

.fw-bold {
    color: #212529 !important;
}

/* Fix modal visibility */
.modal-content {
    background-color: white !important;
    border: 1px solid #dee2e6 !important;
}

.modal-header {
    background-color: white !important;
    border-bottom: 1px solid #dee2e6 !important;
}

.modal-header h5 {
    color: #212529 !important;
}

.modal-body {
    background-color: white !important;
}

.modal-footer {
    background-color: white !important;
    border-top: 1px solid #dee2e6 !important;
}

/* Fix form inputs */
.form-control,
.form-control:focus {
    background-color: white !important;
    color: #212529 !important;
    border: 1px solid #ced4da !important;
}

.form-label {
    color: #212529 !important;
}

/* Fix badges */
.badge.bg-success {
    background-color: #198754 !important;
    color: white !important;
}

.badge.bg-secondary {
    background-color: #6c757d !important;
    color: white !important;
}

/* Fix pagination */
.pagination .page-link {
    background-color: white !important;
    color: #0d6efd !important;
    border: 1px solid #dee2e6 !important;
}

.pagination .active .page-link {
    background-color: #0d6efd !important;
    color: white !important;
}

.modal {
    z-index: 2000 !important;
}

.modal-backdrop {
    z-index: 1990 !important;
}
    </style>
</head>

<body>

{{-- 🔹 SCROLL PROGRESS --}}
<div id="page-progress"></div>

<div>

    <div class="admin-shell d-flex">
        @include('layouts.partials.sidebar')
        <div class="admin-main flex-fill d-flex flex-column">
            @include('layouts.partials.navbar')

            <main class="min-vh-100 position-relative flex-fill" style="z-index:2">
                <div class="container-fluid py-4">
                    @include('partials.flash-messages')
                    @yield('content')
                </div>
            </main>

            @include('partials.footer')
        </div>
    </div>
</div>




<script>
function forceCleanup() {
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';

    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
}

// Run when modal SHOULD close
document.addEventListener('hidden.bs.modal', forceCleanup);

// 🔥 ALSO run on ANY click on close button
document.addEventListener('click', function (e) {
    if (e.target.matches('[data-bs-dismiss="modal"], .btn-close')) {
        setTimeout(forceCleanup, 200);
    }
});
</script>

@yield('modals') {{-- 🔥 ADD THIS LINE --}}

@stack('scripts')

<!-- Make sure this loads BEFORE your custom scripts -->

</body>
</html>
