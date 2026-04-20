@extends('layouts.admin')

@section('title', 'Ticket Detail - Admin - ' . $ticket->ticket_number)

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-start mb-4 gap-3 flex-wrap">
        <div>
            <h2 class="fw-bold mb-1">{{ $ticket->title }}</h2>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <code class="text-primary fw-semibold">{{ $ticket->ticket_number }}</code>
                <span class="text-muted">•</span>
                <small class="text-muted">From {{ $ticket->user->name }}</small>
                <span class="text-muted">•</span>
                <small class="text-muted">{{ $ticket->created_at->format('d M Y H:i') }}</small>
            </div>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-light rounded-2">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Main Content --}}
        <div class="col-lg-8">
            {{-- Ticket Info Card --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-4">
                        <i class="bi bi-info-circle"></i> Ticket Information
                    </h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-2">Status</small>
                            <span class="{{ $ticket->status_badge[0] }} fs-6">
                                {{ $ticket->status_badge[1] }}
                            </span>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block mb-2">Priority</small>
                            <span class="{{ $ticket->priority_badge[0] }} fs-6">
                                {{ $ticket->priority_badge[1] }}
                            </span>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block mb-2">Category</small>
                            @if($ticket->category)
                                <span class="badge bg-light text-dark">{{ $ticket->category->name }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block mb-2">Created By</small>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $ticket->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($ticket->user->name) }}" 
                                     alt="{{ $ticket->user->name }}" 
                                     class="rounded-circle" 
                                     width="24" height="24">
                                <span>{{ $ticket->user->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description Card --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">Description</h5>
                    <div class="bg-light rounded-2 p-3" style="white-space: pre-wrap;">
                        {{ $ticket->description }}
                    </div>

                    @if($ticket->resolution_notes)
                        <hr>
                        <h5 class="fw-semibold mb-3">Resolution Notes</h5>
                        <div class="bg-success bg-opacity-10 rounded-2 p-3 border-start border-4 border-success" style="white-space: pre-wrap;">
                            {{ $ticket->resolution_notes }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Conversation --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-4">Conversation ({{ $ticket->replies()->count() }})</h5>

                    @if($replies->count() > 0)
                        <div class="replies-container mb-4">
                            @foreach($replies as $reply)
                            <div class="reply-item mb-3 pb-3 border-bottom">
                                <div class="d-flex gap-3">
                                    <img src="{{ $reply->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($reply->user->name) }}" 
                                         alt="{{ $reply->user->name }}" 
                                         class="rounded-circle" 
                                         width="40" height="40">

                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <strong class="d-block">{{ $reply->user->name }}</strong>
                                                <small class="text-muted">{{ $reply->created_at->format('d M Y H:i') }}</small>
                                            </div>
                                            @if($reply->user->isAdmin())
                                                <span class="badge bg-danger">Admin</span>
                                            @endif
                                        </div>
                                        <div class="bg-light rounded-2 p-2">
                                            {!! nl2br(e($reply->reply)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($replies->hasPages())
                            <div class="mb-4">
                                {{ $replies->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">No replies yet. Add your response below.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Admin Reply Form --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">Add Admin Reply</h5>
                    <form action="{{ route('admin.tickets.addReply', $ticket) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <textarea name="reply" 
                                      class="form-control rounded-2 @error('reply') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Type your response..."
                                      required></textarea>
                            @error('reply')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary rounded-2">
                            <i class="bi bi-send"></i> Send Reply
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Admin Control Panel (Sidebar) --}}
        <div class="col-lg-4">
            {{-- Update Status & Priority --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-4">
                        <i class="bi bi-gear"></i> Admin Controls
                    </h5>

                    <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" class="d-grid gap-3">
                        @csrf
                        @method('PATCH')

                        {{-- Status Select --}}
                        <div>
                            <label class="form-label small fw-semibold">Update Status</label>
                            <select name="status" class="form-select rounded-2">
                                <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="pending" {{ $ticket->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        {{-- Priority Select --}}
                        <div>
                            <label class="form-label small fw-semibold">Update Priority</label>
                            <select name="priority" class="form-select rounded-2">
                                <option value="low" {{ $ticket->priority === 'low' ? 'selected' : '' }}>🟢 Low</option>
                                <option value="medium" {{ $ticket->priority === 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                <option value="high" {{ $ticket->priority === 'high' ? 'selected' : '' }}>🔴 High</option>
                                <option value="urgent" {{ $ticket->priority === 'urgent' ? 'selected' : '' }}>⚫ Urgent</option>
                            </select>
                        </div>

                        {{-- Category Select --}}
                        <div>
                            <label class="form-label small fw-semibold">Category</label>
                            <select name="category_id" class="form-select rounded-2">
                                <option value="">No Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Resolution Notes --}}
                        <div>
                            <label class="form-label small fw-semibold">Resolution Notes</label>
                            <textarea name="resolution_notes" 
                                      class="form-control rounded-2"
                                      rows="3"
                                      placeholder="Add internal notes...">{{ $ticket->resolution_notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary rounded-2 mt-2">
                            <i class="bi bi-check-circle"></i> Update Ticket
                        </button>
                    </form>
                </div>
            </div>

            {{-- Danger Zone --}}
            <div class="card border-0 shadow-sm rounded-3 border-danger">
                <div class="card-body p-4">
                    <h5 class="fw-semibold text-danger mb-3">
                        <i class="bi bi-exclamation-triangle"></i> Danger Zone
                    </h5>

                    <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-2" onclick="return confirm('Are you sure? This action cannot be undone!')">
                            <i class="bi bi-trash"></i> Delete Ticket
                        </button>
                    </form>
                </div>
            </div>

            {{-- Timeline --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">Timeline</h5>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <small class="text-muted">Created</small>
                                <p class="mb-0 small">{{ $ticket->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-marker bg-{{ $ticket->status === 'closed' || $ticket->status === 'resolved' ? 'success' : 'secondary' }}"></div>
                            <div class="timeline-content">
                                <small class="text-muted">Last Updated</small>
                                <p class="mb-0 small">{{ $ticket->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        @if($ticket->resolved_at)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <small class="text-muted">Resolved</small>
                                <p class="mb-0 small">{{ $ticket->resolved_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 20px;
}

.timeline-item {
    position: relative;
    padding-bottom: 20px;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -14px;
    top: 20px;
    height: calc(100% - 20px);
    width: 2px;
    background: #dee2e6;
}

.timeline-marker {
    position: absolute;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    left: -18px;
    top: 4px;
}

.timeline-content {
    padding-left: 10px;
}
</style>
@endsection
