<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransNotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('dashhome', function () {
    return view('dashhome');
})->name('dashhome');

route::get('dashhome', [HomeController::class, 'index'])
    ->name('dashhome');





Route::get('/search', [SearchController::class, 'index'])
    ->name('search');



Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/sapa/{nama}', function ($nama) {

    return "Halo, Selamat datang $nama di website kami!";
});

Route::get('/kategori/{nama?}', function ($nama = 'Semua') {
    return "Tampilkan Kategori: $nama";
});

// ================================================
// ROUTE DENGAN NAMA (NAMED ROUTE)
// ================================================
Route::get('produk/{id}', function ($id) {
    return "Tampilkan Produk: #$id";
})->name('produk.detail');


Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');


});

// ========================================
// FILE: routes/web.php (tambahan untuk admin)
// ========================================

// ================================================
// ROUTE KHUSUS ADMIN
// ================================================
// middleware(['auth', 'admin']) = Harus login DAN harus admin
// prefix('admin')               = Semua URL diawali /admin
// name('admin.')                = Semua nama route diawali admin.
// ================================================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // /admin/dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');
        // ↑ Nama lengkap route: admin.dashboard
        // ↑ URL: /admin/dashboard

        // CRUD Produk: /admin/products, /admin/products/create, dll
        Route::resource('/products', AdminProductController::class);

        Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
        // ↑ resource() membuat 7 route sekaligus:
        // - GET    /admin/products          → index   (admin.products.index)
        // - GET    /admin/products/create   → create  (admin.products.create)
        // - POST   /admin/products          → store   (admin.products.store)
        // - GET    /admin/products/{id}     → show    (admin.products.show)
        // - GET    /admin/products/{id}/edit→ edit    (admin.products.edit)
        // - PUT    /admin/products/{id}     → update  (admin.products.update)
        // - DELETE /admin/products/{id}     → destroy (admin.products.destroy)
        Route::resource('reports', ReportController::class)->only(['index', 'sales']);
    });

Route::controller(GoogleController::class)->group(function () {
    Route::get('/auth/google/', 'redirect')
        ->name('auth.google');

    route::get('/auth/google/callback', 'callback')
        ->name('auth.google.callback');
});

// routes/web.php



// Katalog Produk
Route::get('/products', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/products/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

// ================================================
// HALAMAN PUBLIK (Tanpa Login)
// ================================================

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog Produk
Route::get('/products', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/products/{slug}', [CatalogController::class, 'show'])->name('catalog.show');


// ================================================
// HALAMAN YANG BUTUH LOGIN (Customer)
// ================================================

Route::middleware('auth')->group(function () {
    // Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Batasi 5 request per menit
    // Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');

    // Pesanan Saya
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Payment Routes
    Route::get('/orders/{order}/pay', [PaymentController::class, 'show'])
        ->name('orders.pay');
    Route::get('/orders/{order}/success', [PaymentController::class, 'success'])
        ->name('orders.success');
    Route::get('/orders/{order}/pending', [PaymentController::class, 'pending'])
        ->name('orders.pending');

});


// ================================================
// HALAMAN ADMIN (Butuh Login + Role Admin)
// ================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

      // Kategori
    Route::resource('categories', CategoryController::class)->except(['show']); // Kategori biasanya tidak butuh show detail page

    // Produk
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    // Route tambahan untuk AJAX Image Handling (jika diperlukan)
    // ...

    // Manajemen Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});







// ============================================================
// MIDTRANS WEBHOOK
// Route ini HARUS public (tanpa auth middleware)
// Karena diakses oleh SERVER Midtrans, bukan browser user
// ============================================================
Route::post('midtrans/notification', [MidtransNotificationController::class, 'handle'])
    ->name('midtrans.notification');







// routes/web.php (HAPUS SETELAH TESTING!)

// use App\Services\MidtransService;

// Route::get('/debug-midtrans', function () {
//     // Cek apakah config terbaca
//     $config = [
//         'merchant_id'   => config('midtrans.merchant_id'),
//         'client_key'    => config('midtrans.client_key'),
//         'server_key'    => config('midtrans.server_key') ? '***SET***' : 'NOT SET',
//         'is_production' => config('midtrans.is_production'),
//     ];

//     // Test buat dummy token
//     try {
//         $service = new MidtransService();

//         // Buat dummy order untuk testing
//         $dummyOrder = new \App\Models\Order();
//         $dummyOrder->order_number = 'TEST-' . time();
//         $dummyOrder->total_amount = 10000;
//         $dummyOrder->shipping_cost = 0;
//         $dummyOrder->shipping_name = 'Test User';
//         $dummyOrder->shipping_phone = '08123456789';
//         $dummyOrder->shipping_address = 'Jl. Test No. 123';
//         $dummyOrder->user = (object) [
//             'name'  => 'Tester',
//             'email' => 'test@example.com',
//             'phone' => '08123456789',
//         ];
//         // Dummy items
//         $dummyOrder->items = collect([
//             (object) [
//                 'product_id'   => 1,
//                 'product_name' => 'Produk Test',
//                 'price'        => 10000,
//                 'quantity'     => 1,
//             ],
//         ]);

//         $token = $service->createSnapToken($dummyOrder);

//         return response()->json([
//             'status'  => 'SUCCESS',
//             'message' => 'Berhasil terhubung ke Midtrans!',
//             'config'  => $config,
//             'token'   => $token,
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'status'  => 'ERROR',
//             'message' => $e->getMessage(),
//             'config'  => $config,
//         ], 500);
//     }
// });


// #TEST EMAIL

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('Halo, ini adalah email percobaan dari Laravel 12 ke Mailtrap!', function ($message) {
        $message->to('test@example.com')
            ->subject('Test Koneksi Mailtrap');
    });

    return "Email berhasil dikirim! Silakan cek dashboard Mailtrap Anda.";
});



