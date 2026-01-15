<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
            ->when($sort === 'price_asc', fn ($q) => $q->orderBy('price', 'asc'))
            ->when($sort === 'price_desc', fn ($q) => $q->orderBy('price', 'desc'))
            ->when($sort === 'name_asc', fn ($q) => $q->orderBy('name', 'asc'))
            ->when($sort === 'name_desc', fn ($q) => $q->orderBy('name', 'desc'))
            ->when($sort === 'stock_desc', fn ($q) => $q->orderBy('stock', 'desc'))
            ->when($sort === 'newest', fn ($q) => $q->latest());

        // 4. EXECUTE & PAGINATE
        $products = $query->paginate(12)->withQueryString();

        // 5. SIDEBAR DATA

        $categories = Category::active()
            ->withCount(['products' => fn ($q) => $q->available()])
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
     * Single product page
     */
    public function show($slug)
    {
        $product = Product::available()
            ->with(['category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('catalog.show', compact('product'));
    }
}
