<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlataranThemeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes - Rumah Joglo Omah Ayem
|--------------------------------------------------------------------------
|
| Routing website front-end dan portal administrasi admin terproteksi auth.
|
*/

// --- Front-end: Classic Javanese Warmth ---
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/paket-sewa', [PageController::class, 'packages'])->name('packages');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');

// Reservasi, Validasi Double Booking, & Instruksi Transfer DP
Route::get('/reservasi', [PageController::class, 'booking'])->name('booking');
Route::post('/reservasi', [PageController::class, 'storeBooking'])->name('booking.store');
Route::get('/api/check-date', [PageController::class, 'checkDate'])->name('api.check-date');
Route::get('/reservasi/{booking_code}/instruksi', [PageController::class, 'bookingInstruction'])->name('booking.instruction');
Route::post('/reservasi/{booking_code}/bukti-transfer', [PageController::class, 'uploadPaymentProof'])->name('booking.upload-proof');

Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

// --- Front-end: Tema 2: Quiet Luxury Hospitality ---
Route::prefix('luxury')->name('luxury.')->group(function () {
    Route::get('/', [PlataranThemeController::class, 'home'])->name('home');
    Route::get('/experiences', [PlataranThemeController::class, 'experience'])->name('experience');
    Route::get('/reserve', [PlataranThemeController::class, 'reserve'])->name('reserve');
});

// --- Admin Authentication Routes ---
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// --- Protected Admin Panel Routes (Middleware: auth) ---
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Redirect /admin ke /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // 1. Dashboard Overview
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Manajemen Reservasi & Konfirmasi DP
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.update-status');
    Route::patch('/reservations/{reservation}/confirm-payment', [ReservationController::class, 'confirmPayment'])->name('reservations.confirm-payment');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // 3. Manajemen Galeri & Aset Visual
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // 4. Konfigurasi Web & Konten Statis (termasuk Rekening Bank & DP)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
