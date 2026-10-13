<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;

Route::get('/', [TourController::class, 'index'])->name('home');
Route::get('/booking', [TourController::class, 'bookingPage'])->name('tour.booking.page');
Route::post('/booking', [TourController::class, 'book'])->name('tour.book');

