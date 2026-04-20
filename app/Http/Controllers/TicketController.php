<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of tickets for the authenticated user
     */
    public function index(Request $request)
    {
        $query = Ticket::where('user_id', auth()->id());

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->has('priority') && $request->priority) {
            $query->where('priority', $request->priority);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('ticket_number', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        // Stats for dashboard
        $stats = [
            'total' => Ticket::where('user_id', auth()->id())->count(),
            'open' => Ticket::where('user_id', auth()->id())->open()->count(),
            'closed' => Ticket::where('user_id', auth()->id())->closed()->count(),
            'urgent' => Ticket::where('user_id', auth()->id())->where('priority', 'urgent')->count(),
        ];

        // Get paginated results
        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = TicketCategory::all();

        return view('tickets.index', compact('tickets', 'categories', 'stats'));
    }

    /**
     * Show the form for creating a new ticket
     */
    public function create()
    {
        $categories = TicketCategory::all();
        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created ticket in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'nullable|exists:ticket_categories,id',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        // Generate unique ticket number
        $ticketNumber = 'TKT-' . auth()->id() . '-' . date('YmdHis') . '-' . strtoupper(Str::random(4));

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'ticket_number' => $ticketNumber,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'] ?? null,
            'priority' => $validated['priority'],
            'status' => 'open',
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Ticket berhasil dibuat! Nomor tiket: ' . $ticket->ticket_number);
    }

    /**
     * Display the specified ticket
     */
    public function show(Ticket $ticket)
    {
        // Check authorization
        if ($ticket->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $replies = $ticket->replies()->paginate(10);
        $categories = TicketCategory::all();

        return view('tickets.show', compact('ticket', 'replies', 'categories'));
    }

    /**
     * Show the form for editing the specified ticket
     */
    public function edit(Ticket $ticket)
    {
        // Check authorization
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Can only edit if status is still open
        if (!in_array($ticket->status, ['open', 'pending'])) {
            return redirect()
                ->route('tickets.show', $ticket)
                ->with('error', 'Tidak dapat mengedit ticket dengan status ini');
        }

        $categories = TicketCategory::all();
        return view('tickets.edit', compact('ticket', 'categories'));
    }

    /**
     * Update the specified ticket in storage
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Check authorization
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Can only update if status is still open
        if (!in_array($ticket->status, ['open', 'pending'])) {
            return redirect()
                ->route('tickets.show', $ticket)
                ->with('error', 'Tidak dapat mengubah ticket dengan status ini');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'nullable|exists:ticket_categories,id',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $ticket->update($validated);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Ticket berhasil diperbarui!');
    }

    /**
     * Close the ticket (soft delete)
     */
    public function close(Ticket $ticket)
    {
        // Check authorization
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $ticket->update([
            'status' => 'closed',
            'resolved_at' => now(),
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Ticket berhasil ditutup!');
    }

    /**
     * Add reply to ticket
     */
    public function reply(Request $request, Ticket $ticket)
    {
        // Check authorization
        if ($ticket->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'reply' => 'required|string|min:5',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'reply' => $validated['reply'],
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Balasan berhasil ditambahkan!');
    }

    /**
     * Delete the ticket
     */
    public function destroy(Ticket $ticket)
    {
        // Check authorization
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Can only delete if status is still open
        if ($ticket->status !== 'open') {
            return redirect()
                ->route('tickets.index')
                ->with('error', 'Hanya dapat menghapus ticket dengan status "Open"');
        }

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket berhasil dihapus!');
    }
}
