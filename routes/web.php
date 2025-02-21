<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CaretakerController;
use App\Http\Controllers\FlagsController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Owner;
use App\Http\Controllers\Payment;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportMessagesController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ViewingController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Fetch 6 random listings with 'open' availability
    $listings = Listing::where('availability', 'open')->inRandomOrder()->limit(6)->get();

    // Pass the listings to the view
    return view('home', ['listings' => $listings]);
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified','admin'])->name('admin.dashboard');

Route::get('/owner/dashboard', function () {
    return view('owner.dashboard');
})->middleware(['auth', 'verified'])->name('owner.dashboard');

Route::get('/tenant/home', function () {
    $listings = Listing::paginate(10); // Adjust the number per page as needed

    // Pass the listings to the view
    return view('listing.display', ['listings' => $listings]);
})->middleware(['auth', 'verified','tenant'])->name('tenant.home');

Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->middleware(['auth', 'verified','staff'])->name('staff.dashboard');

Route::get('/listings', [ListingController::class, 'index'])->name('listing.display');
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');

Route::middleware('auth')->group(function () {
   
    Route::get('/listing/mylisting',[ListingController::class, 'ownerindex'])->name('owner.property');
    Route::resource('/listing', ListingController::class);
    Route::resource('/reserve', ReservationController::class);
    Route::get('/listings/owner/myproperty', [ListingController::class, 'myproperty'])->name('listing.myproperty');
    Route::get('/listings/show/{id}', [ListingController::class, 'detail'])->name('listing.detail');
    Route::resource('/owner/caretaker', CaretakerController::class);
    Route::get('/bookings',[BookingsController::class, 'ownerindex'])->name('booking.owner');
    Route::post('/booking/{id}/accept', [BookingsController::class, 'accept'])->name('booking.accept');
    Route::post('/booking/{id}/decline', [BookingsController::class, 'decline'])->name('booking.decline');
    Route::get('/reservations', [ReservationController::class, 'ownerindex'])->name('reservations.index');
    Route::post('/reservation/{id}/approve', [ReservationController::class, 'approve'])->name('reservation.approve');
    Route::resource('/book',ViewingController::class);
    Route::resource('/payment',PaymentController::class);
    Route::get('/owner/payment', [PaymentController::class, 'ownerIndex'])->name('payment.owner');
    Route::get('/payment/create/{id}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment',[PaymentController::class,'tenantindex'])->name('tenant.payment.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
