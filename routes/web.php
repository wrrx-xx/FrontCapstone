<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Listing;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\FlagsController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Owner;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportMessagesController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ViewingController;
use Illuminate\Http\Request;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});
Route::get('/listing',[ListingController::class ,  'index']);

Route::get('/signin', [AuthController::class, 'index'])->name('signin');
Route::get('/signup', [AuthController::class, 'create'])->name('signup');
Route::post('/signup', [AuthController::class, 'register'])->name('register.store');
Route::post('/signin', [AuthController::class, 'login'])->name('login.store');
Route::post('/signout', [AuthController::class, 'logout'])->name('signout');
Route::get('/owner',[Owner::class, 'index'])->name('owner');
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/clisting',[ListingController::class, 'create']);
    Route::post('/listing', [ListingController::class, 'store'])->name('listing.store');
    Route::get('/listing', [ListingController::class, 'ownerindex'])->name('owner.property');
    Route::post('/verify', [VerificationController::class, 'store']);
    Route::apiResource('/viewing',ViewingController::class);
    Route::apiResource('/reservation',ReservationController::class);
    Route::apiResource('/amenity',AmenitiesController::class);
    Route::apiResource('/inquiry',InquiriesController::class);
    Route::apiResource('/view',ViewController::class);
    Route::apiResource('/photo',PhotosController::class);
    Route::apiResource('/support',SupportController::class);
    Route::apiResource('/suppmess',SupportMessagesController::class);
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
