<?php

use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TourController::class, 'index'])->name('home');
<<<<<<< HEAD
Route::get('/booking', [TourController::class, 'bookingPage'])->name('tour.booking.page');
Route::post('/booking', [TourController::class, 'book'])->name('tour.book');

=======
Route::get('/paket-wisata', [TourController::class, 'packages'])->name('packages.index');
Route::get('/paket-wisata/{slug}', [TourController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('packages.show');
Route::post('/booking', [TourController::class, 'book'])
    ->name('tour.book');
>>>>>>> origin/dev
