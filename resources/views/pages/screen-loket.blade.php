@extends('layouts.app')

@section('title', 'Loket Screen')

@section('content')

<style>
/* GENERAL */
body {
    font-family: 'Inter', sans-serif;
    background: #fff;
}

/* HERO (less flashy) */
.hero {
    height: 90vh;
    background: linear-gradient(180deg, #0f2235, #132f4c);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
}

.hero h1 {
    font-size: 2.8rem;
    font-weight: 700;
}

.hero span {
    color: #4cc9ff;
}

.hero p {
    opacity: 0.8;
}

/* BUTTON */
.btn {
    margin-top: 20px;
    padding: 12px 26px;
    border-radius: 30px;
    background: #2ea8ff;
    color: white;
    border: none;
    cursor: pointer;
}

/* MOVIE SLIDER */
.movies {
    padding: 60px 20px;
}

.movies h2 {
    margin-bottom: 20px;
}

.movie-row {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    padding-bottom: 10px;
}

.movie-card {
    min-width: 140px;
    border-radius: 10px;
    overflow: hidden;
    background: #eee;
    cursor: pointer;
    transition: 0.2s;
}

.movie-card:hover {
    transform: scale(1.05);
}

.movie-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.movie-title {
    padding: 8px;
    font-size: 0.9rem;
}

/* SEAT PICKER */
.seat-section {
    padding: 60px 20px;
    text-align: center;
}

.screen {
    margin: 0 auto 20px;
    width: 60%;
    height: 30px;
    background: #ccc;
    border-radius: 50px;
    font-size: 12px;
    line-height: 30px;
}

.seats {
    display: grid;
    grid-template-columns: repeat(8, 30px);
    gap: 10px;
    justify-content: center;
}

.seat {
    width: 30px;
    height: 30px;
    background: #dcdcdc;
    border-radius: 6px;
    cursor: pointer;
}

.seat.selected {
    background: #2ea8ff;
}

.seat.taken {
    background: #999;
    cursor: not-allowed;
}

/* LESS FLASHY CARDS */
.card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}
</style>

{{-- HERO --}}
<section class="hero">
    <div class="hero-content">
        <h1>No More Antre,<br><span>Now More Easy</span></h1>
        <p>Pesan tiket bioskop tanpa ribet. Pilih kursi, bayar cepat, langsung nonton.</p>
        <button class="btn">Download App</button>
    </div>
</section>


<section class="movies">
    <h2>Now Showing</h2>

    <div class="movie-row">

        @if(isset($movies) && $movies->count())

            @foreach($movies as $movie)
                <div class="movie-card">
                    <img src="{{ $movie->poster ?? 'https://via.placeholder.com/200x300' }}">
                    <div class="movie-title">{{ $movie->title }}</div>

                    @foreach($movie->showtimes as $show)
                        <a href="/seats/{{ $show->id }}" class="btn">
                            {{ $show->time }}
                        </a>
                    @endforeach
                </div>
            @endforeach

        @else
            <p>No movies available</p>
        @endif

    </div>
</section>


<section class="seat-section">
    <h2>Select Your Seat</h2>

    <div class="screen">SCREEN</div>

    <div class="seats" id="seats">
        @for ($i = 1; $i <= 40; $i++)
            <div class="seat {{ rand(0,5) == 1 ? 'taken' : '' }}"></div>
        @endfor
    </div>
</section>




{{-- FEATURES --}}
<section class="features">
    <h2>Why Loket Screen?</h2>

    <div class="feature-grid">
        <div class="card">
            <h3>Effortless Booking</h3>
            <p>Pilih film dan kursi dalam hitungan detik.</p>
        </div>

        <div class="card">
            <h3>Best Deals</h3>
            <p>Promo eksklusif setiap minggu.</p>
        </div>

        <div class="card">
            <h3>Top Cinemas</h3>
            <p>CGV, FLIX, Cinepolis tersedia.</p>
        </div>

        <div class="card">
            <h3>Fast Payment</h3>
            <p>Bayar dengan berbagai metode.</p>
        </div>
    </div>
</section>

{{-- CINEMA --}}
<section class="cinema">
    <h2>Available Cinemas</h2>

    <div class="cinema-list">
        <div class="cinema-card">
            <h3>CGV Grand Indonesia</h3>
            <p>Jakarta Pusat</p>
        </div>

        <div class="cinema-card">
            <h3>FLIX ASHTA</h3>
            <p>Jakarta Selatan</p>
        </div>

        <div class="cinema-card">
            <h3>Cinepolis Jati Asih</h3>
            <p>Bekasi</p>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta">
    <h2>Movie Deals Are Waiting</h2>
    <p>Download sekarang dan mulai booking tiketmu</p>
    <button class="btn">Get Started</button>
</section>



<script>
document.querySelectorAll('.seat').forEach(seat => {
    seat.addEventListener('click', () => {
        if (!seat.classList.contains('taken')) {
            seat.classList.toggle('selected');
        }
    });
});
</script>
@endsection