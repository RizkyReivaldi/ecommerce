<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_tickets' => Ticket::where('user_id', $user->id)->count(),
            'open_tickets' => Ticket::where('user_id', $user->id)->whereIn('status', ['open', 'in_progress', 'pending'])->count(),
            'resolved_tickets' => Ticket::where('user_id', $user->id)->whereIn('status', ['resolved', 'closed'])->count(),
            'urgent_tickets' => Ticket::where('user_id', $user->id)->where('priority', 'urgent')->count(),
        ];

        $recentTickets = Ticket::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('user', 'stats', 'recentTickets'));
    }
}
