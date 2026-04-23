<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\MidtransNotificationController;

use App\Http\Controllers\Auth\GoogleController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TicketAdminController;

Route::get('/dashhome', [HomeController::class, 'index'])->name('dashhome');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/locale/{locale}', function ($locale) {
    $available = ['id', 'en'];

    if (!in_array($locale, $available)) {
        abort(404);
    }

    session(['app_locale' => $locale]);

    return redirect(url()->previous() ?: route('home'));
})->name('locale.switch');

Route::get('/tentang', fn () => view('tentang'));

Route::view('/promo-indodana', 'pages.promo-indodana')->name('promo.indodana');
Route::view('/blog-home', 'pages.blog-home')->name('blog.home');
Route::view('/loket-x', 'pages.loket-x')->name('pages.loket-x');
Route::view('/loket-edu', 'pages.loket-edu')->name('pages.loket-edu');
Route::view('/loket-news', 'pages.loket-news')->name('pages.loket-news');
Route::view('/loket-screen', 'pages.loket-screen')->name('pages.loket-screen');
Route::view('/loket-wiki', 'pages.loket-wiki')->name('pages.loket-wiki');
Route::view('/loket-event', 'pages.loket-event')->name('pages.loket-event');
Route::view('/loket-plus', 'pages.loket-plus')->name('pages.loket-plus');
Route::view('/loket-promo', 'pages.loket-promo')->name('pages.loket-promo');
Route::view('/loketattraction', 'pages.loket-attraction')->name('pages.loket-attraction');
Route::view('/pricing', 'checkout.pricing')->name('pricing');

Route::get('/catalog/{slug}', [CatalogController::class, 'show'])
    ->middleware('track.product');

Route::get('/category/{slug}', [CatalogController::class, 'category'])
    ->name('catalog.category');

Route::get('/screen-loket', [BookingController::class, 'index'])->name('pages.screen-loket');
Route::get('/screen', [BookingController::class, 'index']);
Route::get('/seats/{id}', [BookingController::class, 'seats']);
Route::post('/book', [BookingController::class, 'book']);

Route::get('/sapa/{nama}', function ($nama) {
    return "Halo, Selamat datang $nama di website kami!";
});

Route::get('/kategori/{nama?}', function ($nama = 'Semua') {
    return "Tampilkan Kategori: $nama";
});

Route::get('produk/{id}', function ($id) {
    return "Tampilkan Produk: #$id";
})->name('produk.detail');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/products/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

Route::controller(GoogleController::class)->group(function () {
    Route::get('/auth/google', 'redirect')->name('auth.google');
    Route::get('/auth/google/callback', 'callback')->name('auth.google.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

    Route::resource('tickets', TicketController::class);
    Route::patch('tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
    Route::post('tickets/{ticket}/reply', [TicketController::class, 'reply'])->name('tickets.reply');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    Route::get('/events/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/events', [CatalogController::class, 'store'])->name('catalog.store');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/orders/{order}/pay', [PaymentController::class, 'show'])->name('orders.pay');
    Route::get('/orders/{order}/success', [PaymentController::class, 'success'])->name('orders.success');
    Route::get('/orders/{order}/pending', [PaymentController::class, 'pending'])->name('orders.pending');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class);

        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');

        Route::get('/tickets/dashboard', [TicketAdminController::class, 'dashboard'])->name('tickets.dashboard');
        Route::get('/tickets', [TicketAdminController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [TicketAdminController::class, 'show'])->name('tickets.show');
        Route::patch('/tickets/{ticket}', [TicketAdminController::class, 'update'])->name('tickets.update');
        Route::post('/tickets/{ticket}/reply', [TicketAdminController::class, 'addReply'])->name('tickets.addReply');
        Route::post('/tickets/bulk-update', [TicketAdminController::class, 'bulkUpdate'])->name('tickets.bulkUpdate');
        Route::delete('/tickets/{ticket}', [TicketAdminController::class, 'destroy'])->name('tickets.destroy');

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

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
