<?php
namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        $movies = Movie::with('showtimes')->get();

        return view('pages.screen-loket', compact('movies'));
    }
    public function seats($id)
    {
        $showtime = Showtime::with('seats')->findOrFail($id);
        return view('seats', compact('showtime'));
    }

    public function book(Request $request)
    {
        $seats = $request->seats;

        // prevent double booking
        $alreadyTaken = Seat::whereIn('seat_number', $seats)
            ->where('showtime_id', $request->showtime_id)
            ->where('is_taken', true)
            ->exists();

        if ($alreadyTaken) {
            return back()->with('error', 'Seat already taken!');
        }

        // mark seats
        Seat::whereIn('seat_number', $seats)
            ->where('showtime_id', $request->showtime_id)
            ->update(['is_taken' => true]);

        // create booking
        Booking::create([
            'showtime_id' => $request->showtime_id,
            'seats' => json_encode($seats),
            'name' => $request->name
        ]);

        return redirect('/')->with('success', 'Booking successful!');
    }
}