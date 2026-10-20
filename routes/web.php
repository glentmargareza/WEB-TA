<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / Customer Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [TourController::class, 'index'])->name('home');
Route::get('/paket-wisata', [TourController::class, 'packages'])->name('packages.index');
Route::get('/paket-wisata/{slug}', [TourController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('packages.show');
Route::post('/booking', [TourController::class, 'book'])
    ->name('tour.book');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected by auth & admin middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Sub-pages (ready for future detail expansion)
    Route::get('/booking', [DashboardController::class, 'index'])->name('booking');
    Route::get('/pembayaran', [DashboardController::class, 'index'])->name('pembayaran');
    Route::get('/jeep-driver', [DashboardController::class, 'index'])->name('jeep-driver');
    Route::get('/paket-wisata', [DashboardController::class, 'index'])->name('paket-wisata');
    Route::get('/pelanggan', [DashboardController::class, 'index'])->name('pelanggan');
    Route::get('/laporan', [DashboardController::class, 'index'])->name('laporan');
    Route::get('/pengaturan', [DashboardController::class, 'index'])->name('pengaturan');
});

