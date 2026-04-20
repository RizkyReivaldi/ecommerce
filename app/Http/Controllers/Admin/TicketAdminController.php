<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display admin dashboard with all tickets
     */
    public function dashboard()
    {
        // Stats
        $stats = [
            'total' => Ticket::count(),
            'open' => Ticket::open()->count(),
            'closed' => Ticket::closed()->count(),
            'urgent' => Ticket::where('priority', 'urgent')->count(),
        ];

        // Tickets by status
        $ticketsByStatus = [
            'open' => Ticket::where('status', 'open')->count(),
            'in_progress' => Ticket::where('status', 'in_progress')->count(),
            'pending' => Ticket::where('status', 'pending')->count(),
            'resolved' => Ticket::where('status', 'resolved')->count(),
            'closed' => Ticket::where('status', 'closed')->count(),
        ];

        // Recent tickets
        $recentTickets = Ticket::latest()->take(10)->get();

        // Priority distribution
        $priorityDistribution = [
            'low' => Ticket::where('priority', 'low')->count(),
            'medium' => Ticket::where('priority', 'medium')->count(),
            'high' => Ticket::where('priority', 'high')->count(),
            'urgent' => Ticket::where('priority', 'urgent')->count(),
        ];

        return view('admin.tickets.dashboard', compact('stats', 'ticketsByStatus', 'recentTickets', 'priorityDistribution'));
    }

    /**
     * Display all tickets with admin controls
     */
    public function index(Request $request)
    {
        $query = Ticket::query();

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->has('priority') && $request->priority) {
            $query->where('priority', $request->priority);
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('ticket_number', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            });
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = TicketCategory::all();

        return view('admin.tickets.index', compact('tickets', 'categories'));
    }

    /**
     * Show ticket detail with admin controls
     */
    public function show(Ticket $ticket)
    {
        $replies = $ticket->replies()->paginate(10);
        $categories = TicketCategory::all();

        return view('admin.tickets.show', compact('ticket', 'replies', 'categories'));
    }

    /**
     * Update ticket (admin only)
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,pending,resolved,closed',
            'priority' => 'required|in:low,medium,high,urgent',
            'category_id' => 'nullable|exists:ticket_categories,id',
            'resolution_notes' => 'nullable|string',
        ]);

        $ticket->update($validated);

        // If status is resolved or closed, set resolved_at
        if (in_array($ticket->status, ['resolved', 'closed'])) {
            $ticket->update(['resolved_at' => now()]);
        }

        return redirect()
            ->route('admin.tickets.show', $ticket)
            ->with('success', 'Ticket berhasil diperbarui!');
    }

    /**
     * Add admin reply to ticket
     */
    public function addReply(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'reply' => 'required|string|min:5',
        ]);

        $ticket->replies()->create([
            'user_id' => auth()->id(),
            'reply' => $validated['reply'],
        ]);

        return redirect()
            ->route('admin.tickets.show', $ticket)
            ->with('success', 'Balasan berhasil ditambahkan!');
    }

    /**
     * Bulk update tickets
     */
    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'ticket_ids' => 'required|array',
            'ticket_ids.*' => 'exists:tickets,id',
            'status' => 'nullable|in:open,in_progress,pending,resolved,closed',
            'priority' => 'nullable|in:low,medium,high,urgent',
        ]);

        $updates = [];
        if ($request->status) {
            $updates['status'] = $request->status;
        }
        if ($request->priority) {
            $updates['priority'] = $request->priority;
        }

        if (!empty($updates)) {
            Ticket::whereIn('id', $validated['ticket_ids'])->update($updates);
        }

        return back()->with('success', count($validated['ticket_ids']) . ' ticket(s) berhasil diperbarui!');
    }

    /**
     * Delete ticket (admin only)
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('admin.tickets.index')
            ->with('success', 'Ticket berhasil dihapus!');
    }
}
