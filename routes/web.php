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
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ViewingController;
use Illuminate\Http\Request;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard',[TenantController::class,'index' ])->name('tenant.dashboard');
Route::post('/logout',[TenantController::class, 'outindex'])->name('outing');
Route::get('/listing',[ListingController::class ,  'index']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/signup', [AuthController::class, 'create'])->name('register');


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
   
    Route::get('/listing/mylisting',[ListingController::class, 'ownerindex'])->name('myproperty');
    Route::post('/listing/create',[ListingController::class, 'store'])->name('listing.store');
    Route::get('/owner',[UserController::class, 'ownerindex'])->name('owner.dashboard');
    Route::get('/listing/create',[ListingController::class, 'create'])->name('listing');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
