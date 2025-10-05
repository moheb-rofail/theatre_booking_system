<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\ValueController;
use Illuminate\Support\Facades\Route;

Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::put('/bookings/{id}', [BookingController::class, 'update']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
Route::get('/booked_seats/{party_date}/{party_number}', [BookingController::class, 'booked_seats']);

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::post('/movies', [MovieController::class, 'store']);
Route::put('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);

// Admin
Route::post('/settings', [ValueController::class, 'update']);

Route::get('/settings', [ValueController::class, 'index']);
Route::get('/settings/{id}', [ValueController::class, 'show']);
Route::post('/settings',  [ValueController::class, 'update']);
Route::delete('/settings/{id}', [ValueController::class, 'destroy']);