<?php

use App\Http\Controllers\Api\BookingController;
use Illuminate\Support\Facades\Route;
use App\Models\Movie;

Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::put('/bookings/{id}', [BookingController::class, 'update']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);



/// route special for admin to store movies data
Route::post('/movies', [BookingController::class, 'storeMovie']);

/// route to get all movies data to show in user side (home page for user)
Route::get('/movies', [BookingController::class, 'getMovies']);