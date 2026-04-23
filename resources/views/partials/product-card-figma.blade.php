    <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden" style="transition: 0.2s;">
        
        {{-- Image --}}
        <div class="position-relative">
            <a href="{{ route('catalog.show', $product->slug) }}">
                <img src="{{ $product->image_url }}"
                    onerror="this.onerror=null;this.src='{{ asset('images/no-product-image.svg') }}';"
                    class="w-100"
                    alt="{{ $product->name }}"
                    style="aspect-ratio: 16/9; object-fit: cover;">
            </a>

            @if($product->has_discount)
                <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 small">
                    -{{ $product->discount_percentage }}%
                </span>
            @endif
        </div>

        {{-- Body --}}
        <div class="card-body px-3 pt-3 pb-2 d-flex flex-column">

            {{-- Title --}}
            <h6 class="fw-semibold mb-1" style="font-size: 0.95rem; line-height: 1.4;">
                <a href="{{ route('catalog.show', $product->slug) }}"
                class="text-dark text-decoration-none">
                    {{ Str::limit($product->name, 45) }}
                </a>
            </h6>

            {{-- Date --}}
            <p class="text-muted mb-2" style="font-size: 0.8rem;">
                {{ date('d M Y') }}
            </p>

            {{-- Price --}}
            <div class="mt-auto">
                <span class="fw-bold" style="font-size: 1rem;">
                    {{ $product->formatted_price }}
                </span>
            </div>
        </div>

        {{-- Divider --}}
        <div class="px-3">
            <hr class="my-1" style="opacity: 0.08;">
        </div>

        {{-- Footer --}}
        <div class="px-3 pb-3 pt-1">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                    style="width: 26px; height: 26px;">
                    <i class="bi bi-shop small text-secondary"></i>
                </div>

                <small class="text-muted fw-medium" style="font-size: 0.8rem;">
                    Instax Official Store
                </small>
            </div>
        </div>
    </div>

    <style>
        /* Removes blue color and underlining from titles */
    .card-title a {
        color: #2d3436;
        transition: color 0.2s;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Forces 2 lines max like the photo */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-title a:hover {
        color: #007bff;
    }

    /* Card hover effect */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Makes the image look clean */
    .card-img-top {
        border-bottom: 1px solid #f0f0f0;
    }
    </style>