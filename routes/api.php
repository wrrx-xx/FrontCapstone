<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class, 'store']);
// kani duwa tempo rani ikaw ray bahala asa ni sila na belong since naa rapd ni sila sa web.php
Route::post('/listing', [ListingController::class, 'store'])->middleware('auth:sanctum')->name('listing.store');
Route::post('/signin', [AuthController::class, 'login'])->name('login.store');