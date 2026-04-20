<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    /**
     * Menampilkan halaman catalog publik dengan fitur filter lengkap.
     */
    public function index(Request $request)
    {
        // 1. BASE QUERY
        $query = Product::query()
            ->with(['category', 'primaryImage'])
            ->available(); // scope: aktif + stok > 0

        // 2. FILTERING PIPELINE

        // 🔍 Search
        if ($request->filled('q')) {
            $query->search($request->q);
        }

        // 📂 Category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // 💰 Price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 📊 STOCK SLIDER FILTER (⭐ NEW ⭐)
        // Example: ?stock_min=20
        if ($request->filled('stock_min')) {
            $query->where('stock', '>=', (int) $request->stock_min);
        }

        // 🟢 Discount
        if ($request->boolean('on_sale')) {
            $query->where('has_discount', true);
        }

        // 3. SORTING
        $sort = $request->get('sort', 'newest');

        $query
            ->when($sort === 'price_asc', fn($q) => $q->orderBy('price', 'asc'))
            ->when($sort === 'price_desc', fn($q) => $q->orderBy('price', 'desc'))
            ->when($sort === 'name_asc', fn($q) => $q->orderBy('name', 'asc'))
            ->when($sort === 'name_desc', fn($q) => $q->orderBy('name', 'desc'))
            ->when($sort === 'stock_desc', fn($q) => $q->orderBy('stock', 'desc'))
            ->when($sort === 'newest', fn($q) => $q->latest());

        // 4. EXECUTE & PAGINATE
        $products = $query->paginate(12)->withQueryString();

        // 5. SIDEBAR DATA

        $categories = Category::active()
            ->withCount(['products' => fn($q) => $q->available()])
            ->having('products_count', '>', 0)
            ->orderBy('name')
            ->get();

        $priceRange = Product::available()
            ->selectRaw('MIN(price) as min, MAX(price) as max')
            ->first();

        return view('catalog.index', compact(
            'products',
            'categories',
            'priceRange'
        ));
    }

    /**
     * Show the public event creation form for logged in users.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('catalog.create', compact('categories'));
    }

    /**
     * Store a new event created by a logged in user.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $product = Product::create($request->validated());

            if ($request->hasFile('images')) {
                $this->uploadImages($request->file('images'), $product);
            }

            DB::commit();

            return redirect()
                ->route('catalog.index')
                ->with('success', 'Event berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan event: ' . $e->getMessage());
        }
    }

    protected function uploadImages(array $files, Product $product): void
    {
        $isFirst = $product->images()->count() === 0;

        foreach ($files as $index => $file) {
            $filename = 'product-' . $product->id . '-' . time() . '-' . $index . '.' . $file->extension();
            $path = $file->storeAs('products', $filename, 'public');

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => $isFirst && $index === 0,
                'sort_order' => $product->images()->count() + $index,
            ]);
        }
    }

    /**
     * Single product page
     */
    public function show($slug)
    {
        $product = Product::with(['category', 'images', 'primaryImage'])
            ->where('slug', $slug)
            ->firstOrFail();

        $recommended = Product::where('id', '!=', $product->id)
            ->available()
            ->limit(4)
            ->get();

        return view('catalog.show', compact('product', 'recommended'));
    }
}
