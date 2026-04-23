@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">My Tickets</h2>
            <p class="text-muted mb-0">Kelola dan pantau ticket support Anda</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-lg rounded-pill">
            <i class="bi bi-plus-circle"></i> Create New Ticket
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bg-white rounded-3 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Total Tickets</div>
                        <h3 class="mb-0 fw-bold">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-ticket text-primary fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bg-white rounded-3 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Open Tickets</div>
                        <h3 class="mb-0 fw-bold text-warning">{{ $stats['open'] }}</h3>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-hourglass-split text-warning fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bg-white rounded-3 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Resolved</div>
                        <h3 class="mb-0 fw-bold text-success">{{ $stats['closed'] }}</h3>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle text-success fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card bg-white rounded-3 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Urgent</div>
                        <h3 class="mb-0 fw-bold text-danger">{{ $stats['urgent'] }}</h3>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-exclamation-circle text-danger fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4 p-3">
        <form method="GET" action="{{ route('tickets.index') }}" class="row g-3 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label small fw-semibold">Search</label>
                <input type="text" name="search" class="form-control rounded-2" 
                       placeholder="Cari ticket..." value="{{ request('search') }}">
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold">Status</label>
                <select name="status" class="form-select rounded-2">
                    <option value="">All Status</option>
                    <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold">Priority</label>
                <select name="priority" class="form-select rounded-2">
                    <option value="">All Priority</option>
                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                    <option value="urgent" {{ request('priority') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>

            <div class="col-12 col-md-2">
                <button type="submit" class="btn btn-primary w-100 rounded-2">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Tickets Table --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        @if($tickets->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 fw-semibold">Ticket</th>
                            <th class="px-4 py-3 fw-semibold">Title</th>
                            <th class="px-4 py-3 fw-semibold">Category</th>
                            <th class="px-4 py-3 fw-semibold">Priority</th>
                            <th class="px-4 py-3 fw-semibold">Status</th>
                            <th class="px-4 py-3 fw-semibold">Created</th>
                            <th class="px-4 py-3 fw-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr class="border-bottom">
                            <td class="px-4 py-3">
                                <code class="text-primary fw-semibold">{{ $ticket->ticket_number }}</code>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('tickets.show', $ticket) }}" class="text-dark text-decoration-none fw-semibold">
                                    {{ Str::limit($ticket->title, 40) }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                @if($ticket->category)
                                    <span class="badge bg-light text-dark">{{ $ticket->category->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="{{ $ticket->priority_badge[0] }}">
                                    {{ $ticket->priority_badge[1] }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="{{ $ticket->status_badge[0] }}">
                                    {{ $ticket->status_badge[1] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-muted small">
                                {{ $ticket->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center p-4 border-top">
                <div class="text-muted small">
                    Showing {{ $tickets->firstItem() }} to {{ $tickets->lastItem() }} of {{ $tickets->total() }} results
                </div>
                {{ $tickets->links() }}
            </div>
        @else
            <div class="p-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-inbox" style="font-size: 48px; color: #ddd;"></i>
                </div>
                <h5>No Tickets Yet</h5>
                <p class="text-muted mb-0">Belum ada ticket. Buat ticket baru untuk mendapatkan dukungan.</p>
            </div>
        @endif
    </div>
</div>

<style>
.stat-card {
    border: 1px solid #f0f0f0;
    transition: 0.3s ease;
}

.stat-card:hover {
    box-shadow: 0 6px 16px rgba(0,0,0,0.08) !important;
    transform: translateY(-3px);
}

.stat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
}
</style>
@endsection
