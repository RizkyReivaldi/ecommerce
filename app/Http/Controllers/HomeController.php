<?php
//// ================================================
// FILE: app/Http/Controllers/HomeController.php
// ================================================

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // ✅ 1. Categories – EXCLUDE movie category
        $categories = Category::query()
            ->active()
            ->where('type', '!=', 'movie')          // 👈 FIX: hide movie category
            ->withCount(['activeProducts' => function ($q) {
                $q->where('is_active', true)->where('stock', '>', 0);
            }])
            ->having('active_products_count', '>', 0)
            ->orderBy('name')
            ->take(6)
            ->get();

        // ✅ 2. Featured products – EXCLUDE movies (safety)
        $featuredProducts = Product::query()
            ->with(['category', 'primaryImage'])
            ->active()
            ->inStock()
            ->featured()
            ->whereHas('category', fn($q) => $q->where('name', '!=', 'Movie')) // 👈 exclude movies
            ->latest()
            ->take(8)
            ->get();

        // 3. Event Seru – already excluded movies (type = 'event')
        $eventSeru = Product::with(['category'])
            ->where('is_active', 1)
            ->whereHas('category', function ($q) {
                $q->where('name', '!=', 'Movie')
                ->where('name', 'NOT LIKE', '%Movie%');   // 👈 extra safety
            })
            ->latest()
            ->take(10)
            ->get();

        // 4. Program Belajar – already safe (type != movie)
        $programbelajar = Product::with(['category'])
            ->where('is_active', 1)
            ->whereHas('category', fn($q) =>
                $q->where('name', 'LIKE', '%Belajar%')
                  ->where('type', '!=', 'movie')
            )
            ->latest()
            ->take(10)
            ->get();

        // 5. Saatnya Seru – already safe
        $saatnyaSeru = Product::with(['category'])
            ->where('is_active', 1)
            ->whereHas('category', fn($q) =>
                $q->where('name', 'LIKE', '%Atraksi%')
                  ->where('type', '!=', 'movie')
            )
            ->latest()
            ->take(10)
            ->get();

        // 6. Workshops – already safe
        $workshops = Product::with(['category'])
            ->where('is_active', 1)
            ->whereHas('category', fn($q) =>
                $q->where('name', 'LIKE', '%Workshop%')
                  ->where('type', '!=', 'movie')
            )
            ->latest()
            ->take(10)
            ->get();

        // 7. Latest products – only events (excludes movies)
        $latestProducts = Product::query()
            ->with(['category', 'primaryImage'])
            ->active()
            ->inStock()
            ->whereHas('category', fn($q) => $q->where('name', '!=', 'Movie'))
            ->latest()
            ->take(8)
            ->get();

        // 8. Movie products – ONLY for LOKET screen (unchanged)
        $movieProducts = Product::query()
            ->with(['category', 'primaryImage'])
            ->active()
            ->inStock()
            ->whereHas('category', fn($q) => $q->where('type', 'movie'))
            ->latest()
            ->take(10)
            ->get();

        // 9. Now Showing & Coming Soon – ONLY movies (unchanged)
        $nowShowing = Product::query()
            ->with(['category', 'primaryImage'])
            ->active()
            ->inStock()
            ->whereHas('category', fn($q) => $q->where('type', 'movie'))
            ->latest()
            ->take(10)
            ->get();

        $comingSoon = collect(); // populate as needed

        // 10. User preferences – exclude movies from recommendations & top carousel
        $userId = Auth::id();
        $topEvents = collect();
        $topCarousel = collect();
        $hasCarouselData = false;

        if (!$userId) {
            $recommendedProducts = Product::featured()
                ->whereHas('category', fn($q) => $q->where('name', '!=', 'Movie'))
                ->take(10)
                ->get();
        } else {
            $topCategories = DB::table('user_activities')
                ->join('products', 'user_activities.product_id', '=', 'products.id')
                ->select('products.category_id', DB::raw('COUNT(*) as total'))
                ->where('user_activities.user_id', $userId)
                ->groupBy('products.category_id')
                ->orderByDesc('total')
                ->limit(3)
                ->pluck('category_id');

            $recommendedProducts = Product::whereIn('category_id', $topCategories)
                ->whereHas('category', fn($q) => $q->where('name', '!=', 'Movie'))
                ->take(10)
                ->get();

            if ($recommendedProducts->isEmpty()) {
                $recommendedProducts = Product::featured()
                    ->whereHas('category', fn($q) => $q->where('name', '!=', 'Movie'))
                    ->take(10)
                    ->get();
            }

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
                ->whereHas('category', fn($q) => $q->where('name', '!=', 'Movie'))
                ->orderByDesc('total_sold')
                ->take(3)
                ->get();

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
                ->whereHas('category', fn($q) => $q->where('name', '!=', 'Movie'))  // 👈 exclude movies from carousel
                ->get()
                ->filter(fn($p) => $p->total_sold > 0)
                ->groupBy('category_id')
                ->map(fn($items) => $items->sortByDesc('total_sold')->first())
                ->take(6);

            $hasCarouselData = $topCarousel->isNotEmpty();
        }

        // Final filter – ensure no movies slip into recommendations
        $recommendedProducts = $recommendedProducts->filter(
            fn($p) => $p->category && $p->category->type !== 'movie'
        );

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