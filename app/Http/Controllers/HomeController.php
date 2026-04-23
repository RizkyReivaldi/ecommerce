<?php
// ================================================
// FILE: app/Http/Controllers/HomeController.php
// FUNGSI: Menangani halaman utama website
// ================================================

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda.
     *
     * Halaman ini menampilkan:
     * - Hero section (static)
     * - Kategori populer
     * - Produk unggulan (featured)
     * - Produk terbaru
     */
    public function index()
    {
        // ================================================
        // AMBIL DATA KATEGORI
        // - Hanya yang aktif
        // - Hitung jumlah produk di masing-masing kategori
        // ================================================
        $categories = Category::query()
            ->active() // Scope: hanya is_active = true
            ->withCount(['activeProducts' => function ($q) {
                $q->where('is_active', true)
                    ->where('stock', '>', 0);
            }])
            ->having('active_products_count', '>', 0) // Hanya yang punya produk
            ->orderBy('name')
            ->take(6) // Batasi 6 kategori
            ->get();

        // Debug: pastikan Category yang dipakai benar
        // Hapus baris ini setelah debug
        // dd(Category::class);

        // ================================================
        // PRODUK UNGGULAN (FEATURED)
        // - Flag is_featured = true
        // - Aktif dan ada stok
        // ================================================
        $featuredProducts = Product::query()
            ->with(['category', 'primaryImage']) // Eager load untuk performa
            ->active()                           // Scope: is_active = true
            ->inStock()                          // Scope: stock > 0
            ->featured()                         // Scope: is_featured = true
            ->latest()
            ->take(8)
            ->get();


        //all produk 
        $eventSeru = Product::with(['category'])
            ->where('is_active', 1)
            ->whereHas('category', function ($q) {
                $q->where('slug', 'event');
            })
            ->latest()
            ->take(10)
            ->get();

        $programbelajar = Product::with(['category'])
            ->where('is_active', 1)
            ->whereHas('category', function ($q) {
                $q->where('name', 'program belajar');
            })
            ->latest()
            ->take(10)
            ->get(); 


        $saatnyaSeru = Product::with(['category'])
            ->where('is_active', 1)
            ->whereHas('category', function ($q) {
                $q->where('name', 'atraksi');
            })
            ->latest()
            ->take(10)
            ->get();

        $workshops = Product::with(['category'])
            ->where('is_active', 1)
            ->whereHas('category', function ($q) {
                $q->where('name', 'workshop');
            })
            ->latest()
            ->take(10)
            ->get();







        // ================================================
        // PRODUK TERBARU
        // - Urutkan dari yang paling baru
        // ================================================
        $latestProducts = Product::query()
            ->with(['category', 'primaryImage'])
            ->active()
            ->inStock()
            ->latest() // Order by created_at DESC
            ->take(8)
            ->get();

        $movieProducts = Product::query()
            ->with(['category', 'primaryImage'])
            ->active()
            ->inStock()
            ->whereHas('category', function ($q) {
                $q->where('name', 'Movie');
            })
            ->latest()
            ->take(10)
            ->get();

        $nowShowing = Product::query()
            ->with(['category', 'primaryImage'])
            ->active()
            ->inStock()
            ->whereHas('category', function ($q) {
                $q->where('name', 'Movie');
            })
            ->latest()
            ->take(10)
            ->get();

        $comingSoon = collect(); // empty for now





        //user prefrences
        $userId = Auth::id();

        if (!$userId) {

            // ❗ User not logged in → show default
            $recommendedProducts = Product::featured()
                ->take(10)
                ->get();

        } else {

            // ✅ Get user's favorite categories
            $topCategories = DB::table('user_activities')
                ->join('products', 'user_activities.product_id', '=', 'products.id')
                ->select('products.category_id', DB::raw('COUNT(*) as total'))
                ->where('user_activities.user_id', $userId)
                ->groupBy('products.category_id')
                ->orderByDesc('total')
                ->limit(3)
                ->pluck('category_id');

            // ✅ Get recommended products
            $recommendedProducts = Product::whereIn('category_id', $topCategories)
                ->take(10)
                ->get();

            // ✅ Fallback if no activity yet
            if ($recommendedProducts->isEmpty()) {
                $recommendedProducts = Product::featured()->take(10)->get();
            }



            // ================================================
            // TOP 3 MOST BOUGHT EVENTS (BASED ON TICKETS SOLD)
            // ================================================
            $topEvents = Product::with('primaryImage')
                ->addSelect([
                    'total_sold' => DB::table('order_items')
                        ->join('orders', 'orders.id', '=', 'order_items.order_id')
                        ->selectRaw('SUM(order_items.quantity)')
                        ->whereColumn('order_items.product_id', 'products.id')
                        ->where('orders.payment_status', 'paid')
                        ->where('orders.created_at', '>=', now()->subDays(7))
                ])
                ->where('is_active', true)
                ->where('stock', '>', 0)
                ->orderByDesc('total_sold')
                ->take(3)
                ->get();



                // ================================================
                // TOP PRODUCT PER CATEGORY (BASED ON SALES)
                // ================================================
                $topCarousel = Product::select(
                        'products.id',
                        'products.name',
                        'products.slug',
                        'products.category_id'
                    )
                    ->with(['category', 'primaryImage'])
                    ->addSelect([
                        'total_sold' => DB::table('order_items')
                            ->join('orders', 'orders.id', '=', 'order_items.order_id')
                            ->selectRaw('SUM(order_items.quantity)')
                            ->whereColumn('order_items.product_id', 'products.id')
                            ->where('orders.payment_status', 'paid')
                    ])
                    ->where('products.is_active', true)
                    ->where('products.stock', '>', 0)
                    ->get()
                    ->filter(fn($p) => $p->total_sold > 0) // 👈 IMPORTANT
                    ->groupBy('category_id')
                    ->map(fn($items) => $items->sortByDesc('total_sold')->first())
                    ->take(6);

                // 👇 FLAG: check if empty
                $hasCarouselData = $topCarousel->isNotEmpty();



















}

        // ================================================
        // KIRIM DATA KE VIEW
        // compact() membuat array ['key' => $key]
        // ================================================
        return view('home', compact(
            'categories',
            'featuredProducts',
            'latestProducts',
            'movieProducts',
            'nowShowing',
            'comingSoon',
            'eventSeru',
            'programbelajar',
            'saatnyaSeru',
            'workshops',
            'recommendedProducts',
            'topEvents',
            'topCarousel',
            'hasCarouselData'
        ));
    }
}
