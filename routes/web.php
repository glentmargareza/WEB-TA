<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;

Route::get('/', [TourController::class, 'index'])->name('home');
Route::post('/booking', [TourController::class, 'book'])->name('tour.book');

Route::get('/pembayaran', [TourController::class, 'pembayaran'])->name('tour.pembayaran');
