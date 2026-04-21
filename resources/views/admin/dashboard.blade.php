@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
.dashboard-card {
    transition: transform .25s ease, box-shadow .25s ease;
}
.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
}
.access-toolbar {
    border-radius: 32px;
    background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    border: 1px solid #e5ecfb;
}
.access-filter {
    border-radius: 999px;
}
.status-pill {
    border-radius: 999px;
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
}
.table-access tbody tr:hover {
    background: #f8fbff;
}
.dashboard-topbar {
    min-height: 120px;
    border-radius: 32px;
    background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    border: 1px solid #e5ecfb;
}
.dashboard-tag {
    border-radius: 999px;
    background: rgba(13, 110, 253, 0.08);
    color: #0d6efd;
}
</style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 dashboard-card access-toolbar p-4">
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                        <div>
                            <h2 class="fw-bold mb-1">Kelola akses</h2>
                            <p class="text-muted mb-0">Kelola pengguna, peran, dan status di sistem dengan cepat.</p>
                        </div>
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <button type="button" class="btn btn-outline-primary rounded-pill px-4 py-2">Pengguna</button>
                            <a href="{{ route('admin.tickets.dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2">Undang +</a>
                            <span class="dashboard-tag px-3 py-2">{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="row align-items-center mt-4 g-3">
                        <div class="col-md-6">
                            <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                                <input type="search" class="form-control border-0" placeholder="Cari nama, email, atau peran">
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="badge bg-primary bg-opacity-10 text-primary status-pill me-2">Peran</span>
                            <span class="badge bg-success bg-opacity-10 text-success status-pill">Status</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 dashboard-card p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0 table-access">
                            <thead>
                                <tr class="text-secondary small text-uppercase">
                                    <th style="width: 32px;"><input type="checkbox"></th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Event</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div class="fw-semibold">{{ $user->name }}</div>
                                            <small class="text-muted">{{ $user->role ? ucfirst($user->role) : 'User' }}</small>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role ? ucfirst($user->role) : 'Guest' }}</td>
                                        <td>{{ $user->tickets_count }} Event</td>
                                        <td>
                                            <span class="badge rounded-pill {{ $user->email_verified_at ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary bg-opacity-10 text-secondary' }}">
                                                {{ $user->email_verified_at ? 'Aktif' : 'Menunggu' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">Belum ada pengguna untuk ditampilkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 dashboard-card p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h6 class="fw-semibold mb-2">Status Event</h6>
                            <p class="text-muted mb-0">Ringkasan status tiket dan event di sistem.</p>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Aktif</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-fill">
                            <div class="small text-uppercase text-muted">Event sedang aktif</div>
                            <h3 class="fw-bold mt-2">{{ $users->sum('tickets_count') }}</h3>
                        </div>
                        <div class="text-end">
                            <span class="text-muted">Update terakhir</span>
                            <div class="fw-semibold">Hari ini</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
