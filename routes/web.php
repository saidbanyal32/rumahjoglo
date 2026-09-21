<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlataranThemeController;

/*
|--------------------------------------------------------------------------
| Web Routes - Rumah Joglo Omah Ayem
|--------------------------------------------------------------------------
|
| Routing halaman statis / front-end untuk persewaan venue Rumah Joglo Omah Ayem.
|
*/

// --- Tema 1: Classic Javanese Warmth ---
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/paket-sewa', [PageController::class, 'packages'])->name('packages');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/reservasi', [PageController::class, 'booking'])->name('booking');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

// --- Tema 2: Quiet Luxury Hospitality (Inspired by Plataran Borobudur) ---
Route::prefix('luxury')->name('luxury.')->group(function () {
    Route::get('/', [PlataranThemeController::class, 'home'])->name('home');
    Route::get('/experiences', [PlataranThemeController::class, 'experience'])->name('experience');
    Route::get('/reserve', [PlataranThemeController::class, 'reserve'])->name('reserve');
});

