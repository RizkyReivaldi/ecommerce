@extends('layouts.admin')

@section('title', 'All Tickets - Admin')

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">All Support Tickets</h2>
            <p class="text-muted mb-0">Manage and respond to user support tickets</p>
        </div>
        <a href="{{ route('admin.tickets.dashboard') }}" class="btn btn-primary rounded-pill">
            <i class="bi bi-bar-chart"></i> Dashboard
        </a>
    </div>

    {{-- Filters --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4 p-3">
        <form method="GET" action="{{ route('admin.tickets.index') }}" class="row g-3 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label small fw-semibold">Search</label>
                <input type="text" name="search" class="form-control rounded-2" 
                       placeholder="Search by ticket #, title, or user..." value="{{ request('search') }}">
            </div>

            <div class="col-12 col-md-2">
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

            <div class="col-12 col-md-2">
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
                <label class="form-label small fw-semibold">Category</label>
                <select name="category" class="form-select rounded-2">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
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
                            <th class="px-4 py-3 fw-semibold">Ticket #</th>
                            <th class="px-4 py-3 fw-semibold">Title</th>
                            <th class="px-4 py-3 fw-semibold">User</th>
                            <th class="px-4 py-3 fw-semibold">Priority</th>
                            <th class="px-4 py-3 fw-semibold">Status</th>
                            <th class="px-4 py-3 fw-semibold">Category</th>
                            <th class="px-4 py-3 fw-semibold">Created</th>
                            <th class="px-4 py-3 fw-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr class="border-bottom align-middle">
                            <td class="px-4 py-3">
                                <code class="text-primary fw-semibold">{{ $ticket->ticket_number }}</code>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-dark text-decoration-none fw-semibold">
                                    {{ Str::limit($ticket->title, 35) }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $ticket->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($ticket->user->name) }}" 
                                         alt="{{ $ticket->user->name }}" 
                                         class="rounded-circle" 
                                         width="28" height="28">
                                    <span>{{ Str::limit($ticket->user->name, 15) }}</span>
                                </div>
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
                            <td class="px-4 py-3">
                                @if($ticket->category)
                                    <span class="badge bg-light text-dark">{{ $ticket->category->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-muted small">
                                {{ $ticket->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-eye"></i> View
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
                <h5>No Tickets Found</h5>
                <p class="text-muted mb-0">There are no tickets matching your criteria.</p>
            </div>
        @endif
    </div>
</div>
@endsection
