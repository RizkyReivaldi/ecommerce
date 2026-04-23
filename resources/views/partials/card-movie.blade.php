<div style="min-width: 190px;">
    <a href="{{ route('catalog.show', $product->slug) }}" class="text-decoration-none">

        <div class="position-relative">

            {{-- Poster --}}
            <img src="{{ $product->image_url }}"
                 class="w-100 rounded-4"
                 style="height: 270px; object-fit: cover;">

            {{-- Coming Soon overlay --}}
            @if($product->event_date > now())
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-2"
                     style="background: linear-gradient(transparent, rgba(0,0,0,0.7)); border-radius: 16px;">
                    <span class="badge bg-warning text-dark">Coming Soon</span>
                </div>
            @endif

        </div>

        {{-- Title --}}
        <div class="mt-2">
            <small class="fw-semibold text-dark d-block" style="line-height:1.3;">
                {{ Str::limit($product->name, 30) }}
            </small>
        </div>

    </a>
</div>



<style>
    /* MOVIE CARD (LOKET SCREEN STYLE) */
.movie-card {
    min-width: 180px;
    max-width: 180px;
    flex-shrink: 0;
    transition: 0.3s;
}

.movie-poster img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    border-radius: 16px;
    transition: 0.35s ease;
}

.movie-card:hover img {
    transform: scale(1.08);
}

.movie-info {
    margin-top: 10px;
}

.movie-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #111;
}

.movie-date {
    font-size: 0.75rem;
    color: #888;
}
</style>