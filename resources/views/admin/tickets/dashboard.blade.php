@extends('layouts.admin')

@section('title', 'Ticket Management - Admin')

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            <i class="bi bi-ticket-detailed"></i> Support Ticket Management
        </h2>
        <p class="text-muted mb-0">Kelola semua support tickets dari user</p>
    </div>

    {{-- Stats Row --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bg-white rounded-3 p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Total Tickets</div>
                        <h3 class="mb-0 fw-bold">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-ticket fs-5 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bg-white rounded-3 p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Open Tickets</div>
                        <h3 class="mb-0 fw-bold text-warning">{{ $stats['open'] }}</h3>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-hourglass-split fs-5 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bg-white rounded-3 p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Resolved</div>
                        <h3 class="mb-0 fw-bold text-success">{{ $stats['closed'] }}</h3>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle fs-5 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bg-white rounded-3 p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Urgent</div>
                        <h3 class="mb-0 fw-bold text-danger">{{ $stats['urgent'] }}</h3>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-exclamation-circle fs-5 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left: Charts & Distribution --}}
        <div class="col-lg-6">
            {{-- Status Distribution --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4 dashboard-card">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-4">
                        <i class="bi bi-pie-chart text-primary"></i> Status Distribution
                    </h5>

                    <div class="d-grid gap-3">
                        @foreach($ticketsByStatus as $status => $count)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge p-2 {{ $status === 'open' ? 'bg-primary' : ($status === 'in_progress' ? 'bg-warning' : ($status === 'pending' ? 'bg-info' : ($status === 'resolved' ? 'bg-success' : 'bg-secondary'))) }}"></span>
                                <span class="text-capitalize">{{ str_replace('_', ' ', $status) }}</span>
                            </div>
                            <strong>{{ $count }}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Priority Distribution --}}
            <div class="card border-0 shadow-sm rounded-4 dashboard-card">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-4">
                        <i class="bi bi-exclamation-triangle text-warning"></i> Priority Distribution
                    </h5>

                    <div class="d-grid gap-3">
                        @foreach($priorityDistribution as $priority => $count)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                @if($priority === 'low')
                                    <span class="badge p-2 bg-success"></span> 🟢 Low
                                @elseif($priority === 'medium')
                                    <span class="badge p-2 bg-warning"></span> 🟡 Medium
                                @elseif($priority === 'high')
                                    <span class="badge p-2 bg-danger"></span> 🔴 High
                                @else
                                    <span class="badge p-2 bg-dark"></span> ⚫ Urgent
                                @endif
                            </div>
                            <strong>{{ $count }}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Recent Tickets --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 dashboard-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-semibold mb-0">
                            <i class="bi bi-clock-history text-info"></i> Recent Tickets
                        </h5>
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                            View All
                        </a>
                    </div>

                    <div class="d-grid gap-2">
                        @forelse($recentTickets->take(8) as $ticket)
                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="list-group-item list-group-item-action rounded-4 p-3 border-0 bg-body-secondary dashboard-ticket-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong class="d-block">{{ Str::limit($ticket->title, 50) }}</strong>
                                    <small class="text-muted">
                                        {{ $ticket->ticket_number }} • 
                                        <i class="bi bi-person"></i> {{ $ticket->user->name }}
                                    </small>
                                </div>
                                <span class="badge {{ $ticket->status_badge[0] }} ms-2">
                                    {{ $ticket->status_badge[1] }}
                                </span>
                            </div>
                        </a>
                        @empty
                        <p class="text-muted text-center py-4 mb-0">No tickets yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.stat-card {
    transition: 0.3s ease;
    border: 1px solid #f0f0f0 !important;
}

.stat-card:hover {
    box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
    transform: translateY(-4px);
}

.stat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
}

.dashboard-ticket-item {
    transition: transform .2s ease, background-color .2s ease;
}

.dashboard-ticket-item:hover {
    transform: translateX(3px);
    background-color: #eef6ff;
}
</style>
@endpush
@endsection
