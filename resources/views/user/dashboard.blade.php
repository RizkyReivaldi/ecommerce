@extends('layouts.app')

@section('title', 'User Dashboard')

@push('styles')
<style>
.dashboard-sidebar {
    background: linear-gradient(180deg, #0f4ff2 0%, #142ebc 100%);
    border-radius: 32px;
    min-height: 100%;
}
.dashboard-sidebar .profile-card {
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.14);
}
.dashboard-sidebar .nav-link {
    color: rgba(255,255,255,0.88);
}
.dashboard-sidebar .nav-link.active,
.dashboard-sidebar .nav-link:hover {
    color: #fff;
}
.dashboard-sidebar .nav-title {
    color: rgba(255,255,255,0.72);
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    margin-bottom: 1rem;
}
.dashboard-panel {
    min-height: 100%;
}
.dashboard-panel .hero-card {
    background: #f8fbff;
    border: 1px solid #e6ecf6;
}
.dashboard-panel .stats-card {
    transition: transform .25s ease, box-shadow .25s ease;
}
.dashboard-panel .stats-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(15, 47, 136, 0.12);
}
.dashboard-panel .task-card {
    border: 1px solid rgba(13, 110, 253, 0.14);
    background: #fff;
}
.dashboard-panel .task-card:hover {
    box-shadow: 0 18px 44px rgba(13, 110, 253, 0.08);
}
.dashboard-panel .metric-box {
    border-radius: 24px;
    background: #ffffff;
    border: 1px solid #eef3fb;
    transition: transform .25s ease, box-shadow .25s ease;
}
.dashboard-panel .metric-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 34px rgba(13, 110, 253, 0.08);
}
.dashboard-panel .profile-pill {
    border-radius: 999px;
    background: rgba(13, 110, 253, 0.08);
    color: #0d6efd;
}
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-xl-4">
            <div class="card border-0 dashboard-sidebar p-4 text-white shadow-lg h-100 overflow-hidden">
                <div class="profile-card p-4 rounded-4 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-4 bg-white bg-opacity-15 p-3" style="width:68px; height:68px; display:grid; place-items:center;">
                            <i class="bi bi-person-fill fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                            <p class="mb-0 text-white-50">{{ ucfirst($user->role ?? 'User') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="nav-title">Navigation</div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center gap-2 mb-2 active">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('tickets.index') }}" class="nav-link d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-ticket-detailed"></i> Ticket Saya
                        </a>
                        <a href="{{ route('profile.edit') }}" class="nav-link d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-gear"></i> Pengaturan Akun
                        </a>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="nav-title">Akun</div>
                    <div class="list-group list-group-flush text-white-75">
                        <span class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-person-circle"></i> Informasi dasar</span>
                        <span class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-file-earmark-text"></i> Informasi legal</span>
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-bank"></i> Rekening</span>
                    </div>
                </div>

                <div>
                    <div class="nav-title">Mode User</div>
                    <div class="list-group list-group-flush text-white-75">
                        <span class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-person-check"></i> Beralih akun</span>
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-moon-stars"></i> Singkat menu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card border-0 shadow-sm rounded-4 dashboard-panel h-100">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
                        <div>
                            <h1 class="h3 fw-bold mb-1">Dashboard</h1>
                            <p class="text-muted mb-0">Silakan cek status ticket, progress profil, dan fungsi penting di sini.</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ route('tickets.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
                                <i class="bi bi-plus-circle me-2"></i> Buat Ticket Baru
                            </a>
                            <div class="profile-pill px-3 py-2 fw-semibold">{{ $user->name }}</div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="card task-card rounded-4 p-4 h-100">
                                <h6 class="fw-semibold mb-3">Verifikasi Nomor PonselMu</h6>
                                <p class="text-muted mb-3">Pastikan nomor telepon aktif untuk notifikasi instant.</p>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm rounded-pill">Verifikasi</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card task-card rounded-4 p-4 h-100">
                                <h6 class="fw-semibold mb-3">Lengkapi Informasi Dasar</h6>
                                <p class="text-muted mb-3">Isi data profil agar dukungan lebih cepat.</p>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm rounded-pill">Verifikasi</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card task-card rounded-4 p-4 h-100">
                                <h6 class="fw-semibold mb-3">Lengkapi Informasi Legal</h6>
                                <p class="text-muted mb-3">Pastikan dokumen legal terunggah agar proses layanan lancar.</p>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm rounded-pill">Verifikasi</a>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6 col-lg-4">
                            <div class="metric-box p-4 h-100">
                                <small class="text-uppercase text-muted">Ticket Aktif</small>
                                <h3 class="fw-bold mb-1">{{ $stats['open_tickets'] }}</h3>
                                <p class="text-muted mb-0">Saat ini sedang diproses.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="metric-box p-4 h-100">
                                <small class="text-uppercase text-muted">Ticket Selesai</small>
                                <h3 class="fw-bold mb-1">{{ $stats['resolved_tickets'] }}</h3>
                                <p class="text-muted mb-0">Ticket yang sudah terjawab.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="metric-box p-4 h-100">
                                <small class="text-uppercase text-muted">Total Ticket</small>
                                <h3 class="fw-bold mb-1">{{ $stats['total_tickets'] }}</h3>
                                <p class="text-muted mb-0">Semua ticket Anda.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="metric-box p-4 h-100">
                                <small class="text-uppercase text-muted">Ticket Darurat</small>
                                <h3 class="fw-bold mb-1">{{ $stats['urgent_tickets'] }}</h3>
                                <p class="text-muted mb-0">Urgensi tinggi yang butuh respon cepat.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="metric-box p-4 h-100">
                                <small class="text-uppercase text-muted">Profil Lengkap</small>
                                <h3 class="fw-bold mb-1">80%</h3>
                                <p class="text-muted mb-0">Lengkapi profil agar fitur optimal.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="metric-box p-4 h-100">
                                <small class="text-uppercase text-muted">Shortcut</small>
                                <h3 class="fw-bold mb-1">3 Aksi</h3>
                                <p class="text-muted mb-0">Akses cepat ke fitur favorit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h5 class="fw-semibold mb-1">Ticket Terbaru</h5>
                                    <p class="text-muted mb-0">Ringkasan ticket paling terbaru dari akun Anda.</p>
                                </div>
                                <a href="{{ route('tickets.index') }}" class="text-decoration-none fw-semibold">Lihat Semua</a>
                            </div>

                            @if($recentTickets->isEmpty())
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted mt-3">Belum ada ticket. Buat ticket baru untuk mulai mendapatkan bantuan.</p>
                                </div>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach($recentTickets as $ticket)
                                        <a href="{{ route('tickets.show', $ticket) }}" class="list-group-item list-group-item-action dashboard-ticket-item d-flex justify-content-between align-items-center px-3 py-4 rounded-4 mb-2 border-0 bg-white shadow-sm">
                                            <div>
                                                <div class="fw-semibold">{{ Str::limit($ticket->title, 60) }}</div>
                                                <small class="text-muted">{{ $ticket->ticket_number }} · {{ $ticket->created_at->format('d M Y') }}</small>
                                            </div>
                                            <span class="badge {{ $ticket->status_badge[0] }} rounded-pill">{{ $ticket->status_badge[1] }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
