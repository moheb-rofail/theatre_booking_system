<?php

use App\Http\Controllers\Api\BookingController;
use Illuminate\Support\Facades\Route;
use App\Models\Movie;

Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::put('/bookings/{id}', [BookingController::class, 'update']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
Route::get('/booked_seats/{party_date}/{party_number}', [BookingController::class, 'booked_seats']);

Route::get('/movies', [BookingController::class, 'index']);
Route::get('/movies/{id}', [BookingController::class, 'show']);
Route::post('/movies', [BookingController::class, 'store']);
Route::put('/movies/{id}', [BookingController::class, 'update']);
Route::delete('/movies/{id}', [BookingController::class, 'destroy']);