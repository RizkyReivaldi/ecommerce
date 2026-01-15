<div class="card product-card h-100 border-0 position-relative">

    {{-- Image --}}
    <div class="position-relative overflow-hidden rounded-top product-media">
        <a href="{{ route('catalog.show', $product->slug) }}" class="product-link">
            <img src="{{ $product->image_url }}"
                    data-product-img="{{ $product->id }}"
                    class="card-img-top product-img"
                    alt="{{ $product->name }}">

        </a>

        {{-- Discount LEFT --}}
        @if($product->has_discount)
            <span class="badge-instax-discount position-absolute top-0 start-0 m-2">
                -{{ $product->discount_percentage }}%
            </span>
        @endif

        {{-- Wishlist --}}
        @auth
        <button
            type="button"
            onclick="toggleWishlist({{ $product->id }}, this)"
            class="wishlist-btn position-absolute top-0 end-0 m-2"
            aria-label="Wishlist">
            <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill active' : 'bi-heart' }}"></i>
        </button>
        @endauth
    </div>

    {{-- Body --}}
    <div class="card-body d-flex flex-column">

        <small class="text-muted">{{ $product->category->name }}</small>

        <h6 class="mt-1">
            <a href="{{ route('catalog.show', $product->slug) }}" class="product-title">
                {{ Str::limit($product->name, 40) }}
            </a>
        </h6>

        <div class="mt-auto">
            @if($product->has_discount)
                <small class="text-muted text-decoration-line-through">
                    {{ $product->formatted_original_price }}
                </small>
            @endif
            <div class="price-instax fw-bold">
                {{ $product->formatted_price }}
            </div>
        </div>

        {{-- Quantity --}}
        <div class="d-flex align-items-center gap-2 mt-2">
            <button type="button" class="qty-btn" onclick="changeQty({{ $product->id }}, -1)">−</button>
            <input type="number"
                   id="qty-{{ $product->id }}"
                   value="1"
                   min="1"
                   max="{{ $product->stock }}"
                   class="qty-input">
            <button type="button" class="qty-btn" onclick="changeQty({{ $product->id }}, 1)">+</button>
        </div>
    </div>

    {{-- Footer --}}
    <div class="card-footer border-0 pt-0">
        <button
            type="button"
            onclick="addToCart({{ $product->id }})"
            class="btn btn-instax w-100 btn-sm"
            @disabled($product->stock == 0)>
            <i class="bi bi-cart-plus"></i> Tambah Keranjang
        </button>
    </div>
</div>
