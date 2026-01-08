<div class="card product-card h-100 border-0">

    {{-- Product Image --}}
    <div class="position-relative overflow-hidden rounded-top">
        <a href="{{ route('catalog.show', $product->slug) }}">
            <img
                src="{{ $product->image_url }}"
                class="card-img-top product-img"
                alt="{{ $product->name }}">
        </a>

        {{-- Discount Badge --}}
        @if($product->has_discount)
            <span class="badge-instax-discount">
                -{{ $product->discount_percentage }}%
            </span>
        @endif

        {{-- Wishlist --}}
        @auth
        <button
            type="button"
            onclick="toggleWishlist({{ $product->id }})"
            class="btn wishlist-btn position-absolute top-0 end-0 m-2 rounded-circle wishlist-btn-{{ $product->id }}">
            <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
        </button>
        @endauth
    </div>

    {{-- Body --}}
    <div class="card-body d-flex flex-column">

        <small class="text-muted mb-1">
            {{ $product->category->name }}
        </small>

        <h6 class="card-title mb-2">
            <a href="{{ route('catalog.show', $product->slug) }}"
               class="product-title stretched-link">
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

        {{-- Stock --}}
        @if($product->stock <= 5 && $product->stock > 0)
            <small class="text-warning mt-2">
                <i class="bi bi-exclamation-triangle"></i>
                Stok tinggal {{ $product->stock }}
            </small>
        @elseif($product->stock == 0)
            <small class="text-danger mt-2">
                <i class="bi bi-x-circle"></i> Stok Habis
            </small>
        @endif
    </div>

    {{-- Footer --}}
    <div class="card-footer border-0 pt-0">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">

            <button
                type="submit"
                class="btn btn-instax w-100 btn-sm"
                @disabled($product->stock == 0)>
                <i class="bi bi-cart-plus me-1"></i>
                {{ $product->stock == 0 ? 'Stok Habis' : 'Tambah Keranjang' }}
            </button>
        </form>
    </div>
</div>
