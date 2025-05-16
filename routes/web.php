<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CaretakerController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FlagsController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportMessagesController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ViewingController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminCaretakerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminListingController;
use App\Http\Controllers\BillingsController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\OwnerMaintenance;
use App\Http\Controllers\TenantRentalController;
use App\Http\Controllers\UtilityBillsController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'filteredListings']);


use App\Http\Controllers\Owner;

Route::get('/owner/dashboard', [Owner::class, 'index'])->middleware(['auth', 'verified'])->name('owner.dashboard');


Route::middleware(['auth','verified'])->group(function () {
    Route::get('/tenant/dashboard',[TenantController::class,'index'])->name('tenant.dashboard');
    Route::get('/tenant/payment',[TenantController::class,'paymentindex'])->name('tenant.payment');
    Route::get('/tenant/payment/create/{id}',[PaymentController::class,'createpay'])->name('tenant.payment.create');
    Route::post('/tenant/payment/store',[PaymentController::class,'paystore'])->name('tenant.payment.store');
    Route::get('/tenant/myrental', [TenantRentalController::class, 'index'])->name('tenant.rental.index');
    Route::resource('maintenance', MaintenanceRequestController::class)->names('tenant.maintenance');
    Route::get('/tenant/support', [SupportMessagesController::class, 'index'])->name('tenant.support');
});

Route::middleware(['auth','verified','admin'])->group(function () {
    Route::resource('admin/listing',AdminListingController::class)->names('admin.listing');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth', 'admin');
    Route::resource('admin/caretakers',AdminCaretakerController::class)->names('admin.caretaker');
    Route::resource('admin/bookings',AdminBookingController::class)->names('admin.booking');
    Route::get('admin/reservations',[AdminBookingController::class, 'adminIndex'])->name('admin.reservation.index');
Route::get('admin/payments',[PaymentController::class, 'adminIndex'])->name('admin.payment.index');
});
Route::get('/listing', function () {
    $listings = Listing::paginate(10);
    return view('listing.display', ['listings' => $listings]);
})->middleware(['auth', 'verified'])->name('guest.home');



Route::get('/caretaker/dashboard',[CaretakerController::class, 'dashboard'])->middleware(['auth', 'verified','staff'])->name('caretaker.dashboard');

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
    Route::post('/reservation/{id}/decline', [ReservationController::class, 'decline'])->name('reservation.decline');
    Route::resource('/book',ViewingController::class);
    Route::resource('/payment',PaymentController::class);   
    Route::get('/owner/payment', [PaymentController::class, 'ownerIndex'])->name('payment.owner');
    Route::get('/payment/create/{id}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment',[PaymentController::class,'tenantindex'])->name('tenant.payment.index');
    Route::get('/receipt/download/{id}', [PaymentController::class, 'downloadReceipt'])->name('receipt.download');
    Route::post('/billing/{id}/approve', [BillingsController::class, 'approve'])->name('billing.approve');
    Route::post('/billing/{id}/decline', [BillingsController::class, 'decline'])->name('billing.decline');
    Route::resource('/utilitybill', UtilityBillsController::class);
    Route::resource('owner/maintenance/request', OwnerMaintenance::class)->names('owner.maintenance');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin approval routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/approvals', [ApprovalController::class, 'index'])->name('admin.approvals.index');
    Route::post('/admin/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('admin.approvals.approve');
    Route::delete('/admin/approvals/{id}/reject', [ApprovalController::class, 'reject'])->name('admin.approvals.reject');
});
