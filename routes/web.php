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
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified','admin'])->name('admin.dashboard');

Route::get('/owner/dashboard', function () {
    return view('owner.dashboard');
})->middleware(['auth', 'verified'])->name('owner.dashboard');

Route::get('/tenant/dashboard', function () {
    return view('tenant.dashboard');
})->middleware(['auth', 'verified','tenant'])->name('tenant.dashboard');

Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->middleware(['auth', 'verified','staff'])->name('staff.dashboard');

Route::get('/list',[ListingController::class, 'display'])->name('listing.display');

Route::middleware('auth')->group(function () {
   
    Route::get('/listing/mylisting',[ListingController::class, 'ownerindex'])->name('owner.property');
    Route::resource('/listing', ListingController::class);
    Route::get('/listings/owner/{id}', [ListingController::class, 'myproperty'])->name('listing.myproperty');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
