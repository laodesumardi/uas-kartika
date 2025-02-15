<?php

use Mews\Captcha\Facades\Captcha;
use App\Http\Controllers\Auth1\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman dashboard hanya bisa diakses oleh user yang sudah login dan terverifikasi
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk pengelolaan profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk menampilkan form login
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses login
Route::post('/login', [RegisterController::class, 'login']);

// Rute untuk logout
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

// Rute untuk menampilkan form registrasi
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');

// Rute untuk memproses registrasi
Route::post('/register', [RegisterController::class, 'register']);

// Rute untuk reload CAPTCHA
Route::get('/reload-captcha', [App\Http\Controllers\Auth1\RegisterController::class, 'reloadCaptcha'])->name('reload.captcha');

Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses login dengan middleware CAPTCHA
Route::post('/login', [RegisterController::class, 'login'])->middleware('captcha.check');
// Mengimpor rute autentikasi dari Laravel Breeze
require __DIR__ . '/auth.php';

Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);
Route::get('/reload-captcha', [RegisterController::class, 'reloadCaptcha'])->name('reload.captcha');

Route::prefix('qrcode')->group(function () {
    Route::get('/', [QRCodeController::class, 'index'])->name('qrcode.index');
    Route::post('/store', [QRCodeController::class, 'store'])->name('qrcode.store');
    Route::get('/generate/{id}', [QRCodeController::class, 'generate'])->name('qrcode.generate');
});

Route::get('/captcha/reload', function () {
    return response()->json(['captcha' => Captcha::src()]);
});
// Menampilkan halaman login
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [RegisterController::class, 'login']);

// Proses logout
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

// Refresh CAPTCHA
Route::get('/captcha/reload', [RegisterController::class, 'reloadCaptcha']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/captcha/reload', [RegisterController::class, 'reloadCaptcha']);
