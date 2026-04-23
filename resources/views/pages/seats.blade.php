@extends('layouts.app')

@section('content')

<h2>{{ $showtime->movie->title }}</h2>

<form method="POST" action="/book">
@csrf

<input type="hidden" name="showtime_id" value="{{ $showtime->id }}">

<div class="seats">
@foreach($showtime->seats as $seat)
    <label>
        <input type="checkbox" name="seats[]" value="{{ $seat->seat_number }}"
        {{ $seat->is_taken ? 'disabled' : '' }}>
        {{ $seat->seat_number }}
    </label>
@endforeach
</div>

<input type="text" name="name" placeholder="Your Name" required>

<button type="submit">Book Now</button>

</form>

@endsection