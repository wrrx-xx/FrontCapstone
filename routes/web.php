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
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportMessagesController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ViewingController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\SalesController as AdminSalesController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminCaretakerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGuestController;
use App\Http\Controllers\AdminListingController;
use App\Http\Controllers\AdminOwnerController;
use App\Http\Controllers\AdminTenantController;
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
use App\Http\Controllers\Listing as ControllersListing;
use App\Http\Controllers\Admin\TransactionLogController;

use App\Http\Controllers\Owner;

Route::get('/', [HomeController::class, 'filteredListings']);


Route::middleware(['auth','verified'])->group(function () {
    Route::get('/tenant/dashboard',[TenantController::class,'index'])->name('tenant.dashboard');
    Route::get('/tenant/payment',[TenantController::class,'paymentindex'])->name('tenant.payment');
    Route::get('/tenant/payment/create/{id}',[PaymentController::class,'createpay'])->name('tenant.payment.create');
    Route::post('/tenant/payment/store',[PaymentController::class,'paystore'])->name('tenant.payment.store');
    Route::get('/tenant/myrental', [TenantRentalController::class, 'index'])->name('tenant.rental.index');
    Route::resource('maintenance', MaintenanceRequestController::class)->names('tenant.maintenance');
    Route::get('/tenant/support', [SupportMessagesController::class, 'index'])->name('tenant.support');
    Route::patch('/viewings/{id}/cancel', [ViewingController::class, 'cancel'])->name('viewings.cancel');
    Route::patch('/viewings/{viewing}', [ViewingController::class, 'update'])->name('viewings.update');
    Route::post('/viewings/{viewing}/suggest-time', [ViewingController::class, 'suggestTime'])->name('booking.suggest-time');
    Route::post('/viewings/{viewing}/accept-suggestion', [ViewingController::class, 'acceptSuggestion'])->name('viewings.accept-suggestion');
    Route::post('/viewings/{viewing}/decline-suggestion', [ViewingController::class, 'declineSuggestion'])->name('viewings.decline-suggestion');
    Route::get('/owner/dashboard', [Owner::class, 'index'])->middleware(['auth', 'verified'])->name('owner.dashboard');

});

Route::middleware(['auth','verified','admin'])->group(function () {
    Route::resource('admin/listing',AdminListingController::class)->names('admin.listing');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth', 'admin');
    Route::resource('admin/caretakers',AdminCaretakerController::class)->names('admin.caretaker');
    Route::resource('admin/owners', AdminOwnerController::class)->names('admin.owner');
    Route::resource('admin/tenants', AdminTenantController::class)->names('admin.tenant');
    Route::resource('admin/guests', AdminGuestController::class)->names('admin.guest');
    Route::resource('admin/bookings',AdminBookingController::class)->names('admin.booking');
    Route::get('admin/reservations',[AdminBookingController::class, 'adminIndex'])->name('admin.reservation.index');
    Route::get('admin/payments',[PaymentController::class, 'adminIndex'])->name('admin.payment.index');
    
    // Transaction Logs Routes
    Route::get('admin/transaction-logs', [TransactionLogController::class, 'index'])->name('admin.transaction-logs.index');
    Route::get('admin/transaction-logs/{id}', [TransactionLogController::class, 'show'])->name('admin.transaction-logs.show');
    Route::get('admin/transaction-logs/export', [TransactionLogController::class, 'export'])->name('admin.transaction-logs.export');
    
    Route::get('admin/sales', [SalesController::class, 'adminIndex'])->name('admin.sales.index');
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
    Route::get('/viewings',[ReservationController::class,'index'])->name('reserve.index');
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
    Route::post('/tenant/rental/{listing}/leave', [ListingController::class, 'leave'])->name('tenant.rental.leave');
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/sales/payments', [SalesController::class, 'payments'])->name('sales.payments');
    Route::get('/sales/payments/{payment}', [SalesController::class, 'show'])->name('sales.payments.show');
    Route::get('/api/payments/{payment}', [SalesController::class, 'getPaymentDetails'])->name('api.payments.details');
    
    // Owner/Caretaker leave request management
   
 });

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 Route::middleware(['auth'])->group(function() {
        Route::get('/owner/leave-requests', [ListingController::class, 'leaveRequests'])->name('owner.leave-requests');
        Route::post('/owner/leave-requests/{id}/approve', [ListingController::class, 'approveLeaveRequest'])->name('owner.leave-requests.approve');
        Route::post('/owner/leave-requests/{id}/decline', [ListingController::class, 'declineLeaveRequest'])->name('owner.leave-requests.decline');
    });
require __DIR__.'/auth.php';

// Admin approval routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/approvals', [ApprovalController::class, 'index'])->name('admin.approvals.index');
    Route::post('/admin/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('admin.approvals.approve');
    Route::delete('/admin/approvals/{id}/reject', [ApprovalController::class, 'reject'])->name('admin.approvals.reject');
    Route::get('/admin/maintenance', [OwnerMaintenance::class, 'adminIndex'])->name('admin.maintenance.index');
    
 });
use App\Http\Controllers\MessageController;
Route::middleware(['auth'])->group(function () {
    Route::get('/tenant/messages', [MessageController::class, 'index'])->name('tenant.messages.index');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');
    Route::get('/messages/fetch', [MessageController::class, 'fetch'])->name('messages.fetch');
    Route::get('/owner/messages', [MessageController::class, 'ownerIndex'])->name('owner.messages.index');
    Route::post('/messages/typing', [MessageController::class, 'typing'])->name('messages.typing');
    Route::get('/caretaker/messages', [MessageController::class, 'caretakerIndex'])->name('caretaker.messages.index');
    
});

Route::post('/listings/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/payment/unpaid-report', [PaymentController::class, 'unpaidReport'])->name('payment.unpaid-report');

// Unpaid Billings Report Download
Route::get('/payment/unpaid/download', [PaymentController::class, 'downloadUnpaidReport'])
    ->name('payment.unpaid.download')
    ->middleware(['auth']);