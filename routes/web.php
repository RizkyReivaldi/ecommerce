<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
Route::get('/', function () {
    return view('welcome');
});



Route::get('/tentang', function () {

    return view('tentang');
});



Route::get('/sapa/{nama}', function($nama){

    return "Halo, $nama! Selamat Datang di Toko Online";
});

Route::get('/kategori/{nama?}', function($nama = 'semua'){

    return "Menampilkan Kategori: $nama";
});

Route::get('/produk/{id}', function($id){
    return "Detail produk #$id";
})->name('produk.detail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

use App\Http\Controllers\Auth\GoogleController;

    Route::controller(GoogleController::class)->group(function () {

    Route::get('/auth/google', 'redirect')
        ->name('auth.google');

    Route::get('/auth/google/callback', 'callback')
        ->name('auth.google.callback');
});




?>
