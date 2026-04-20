@extends('layouts.app')

@section('title', 'Ticket Detail - ' . $ticket->ticket_number)

@section('content')
<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-start mb-4 gap-3 flex-wrap">
        <div>
            <h2 class="fw-bold mb-1">{{ $ticket->title }}</h2>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <code class="text-primary fw-semibold">{{ $ticket->ticket_number }}</code>
                <span class="text-muted">•</span>
                <small class="text-muted">Created {{ $ticket->created_at->format('d M Y H:i') }}</small>
            </div>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            @if(in_array($ticket->status, ['open', 'pending']))
                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-outline-primary rounded-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            @endif

            @if(in_array($ticket->status, ['open', 'in_progress', 'pending']))
                <form action="{{ route('tickets.close', $ticket) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-outline-success rounded-2" onclick="return confirm('Yakin ingin menutup ticket ini?')">
                        <i class="bi bi-check-circle"></i> Close
                    </button>
                </form>
            @endif

            <a href="{{ route('tickets.index') }}" class="btn btn-light rounded-2">
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
                    <h5 class="fw-semibold mb-3">Ticket Information</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Status</small>
                                <span class="{{ $ticket->status_badge[0] }} fs-6">
                                    {{ $ticket->status_badge[1] }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Priority</small>
                                <span class="{{ $ticket->priority_badge[0] }} fs-6">
                                    {{ $ticket->priority_badge[1] }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <small class="text-muted d-block mb-1">Category</small>
                                @if($ticket->category)
                                    <span class="badge bg-light text-dark">{{ $ticket->category->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <small class="text-muted d-block mb-1">Created By</small>
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

            {{-- Replies Section --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-4">Replies ({{ $ticket->replies()->count() }})</h5>

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
                                            @if(auth()->id() === $reply->user_id)
                                                <span class="badge bg-info">You</span>
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

                        {{-- Pagination for Replies --}}
                        @if($replies->hasPages())
                            <div class="mb-4">
                                {{ $replies->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">Belum ada balasan. Tunggu respons dari tim support kami.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Add Reply Form --}}
            @if(in_array($ticket->status, ['open', 'in_progress', 'pending']))
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">Add Reply</h5>
                    <form action="{{ route('tickets.reply', $ticket) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <textarea name="reply" 
                                      class="form-control rounded-2 @error('reply') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Tulis balasan Anda..."
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
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            {{-- Quick Actions --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">Actions</h5>

                    <div class="d-grid gap-2">
                        @if(in_array($ticket->status, ['open', 'pending']))
                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-outline-primary rounded-2">
                                <i class="bi bi-pencil"></i> Edit Ticket
                            </a>
                        @endif

                        @if($ticket->status !== 'closed')
                            <form action="{{ route('tickets.close', $ticket) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success w-100 rounded-2" onclick="return confirm('Yakin?')">
                                    <i class="bi bi-check-circle"></i> Close Ticket
                                </button>
                            </form>
                        @endif

                        @if($ticket->status === 'open')
                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100 rounded-2" onclick="return confirm('Yakin? Action ini tidak dapat dibatalkan!')">
                                    <i class="bi bi-trash"></i> Delete Ticket
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Timeline/Status --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">Timeline</h5>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <small class="text-muted">Created</small>
                                <p class="mb-0">{{ $ticket->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-marker bg-{{ $ticket->status === 'closed' || $ticket->status === 'resolved' ? 'success' : 'secondary' }}"></div>
                            <div class="timeline-content">
                                <small class="text-muted">Last Updated</small>
                                <p class="mb-0">{{ $ticket->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        @if($ticket->resolved_at)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <small class="text-muted">Resolved</small>
                                <p class="mb-0">{{ $ticket->resolved_at->format('d M Y H:i') }}</p>
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
