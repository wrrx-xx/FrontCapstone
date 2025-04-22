<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Billings;
use App\Models\Listing;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\User;
use App\Models\UtilityBill;
use App\Models\Viewing;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Existing methods...

    /**
     * Process payment for a specific billing.
     */
   
     public function tenantindex(){
        $tenant = Auth::user(); // Assuming the tenant is authenticated as a User


        // Retrieve billings associated with the tenant

        $billings = Billings::where('user_id', $tenant->id)->get();


        // Retrieve listings associated with the tenant

        $listings = Listing::where('tenant_id', $tenant->id)->pluck('id'); // Get the IDs of the listings where the tenant is assigned


        // Retrieve payments associated with the tenant's listings

        $payments = Payment::whereIn('listing_id', $listings)->get(); // Fetch payments for those listings

 return view('Tenant.payment.index', [

            'billings' => $billings,
 'payments' => $payments,

            'tenant' => $tenant,
            'listings'=> $listings,

        ]);
       
    }


public function ownerIndex()
{
    $user = Auth::user();
    
    // Determine owner ID based on user role
    $userId = $user->role === 'caretaker' ? $user->owner_id : $user->id;
    
    // Fetch all listings owned by the user
    $listings = Listing::where('owner_id', $userId)->get();

    // Initialize collections to hold payments and billings
    $payments = collect();
    $billings = collect();

    // Loop through each listing to get associated payments and billings
    foreach ($listings as $listing) {
        // Fetch payments for the current listing and merge into the collection
        $listingPayments = Payment::where('listing_id', $listing->id)->get();
        $payments = $payments->merge($listingPayments);

        // Fetch billings for the current listing and eager load utilities, then merge into the collection
        $listingBillings = Billings::with('utility')->where('listing_id', $listing->id)->get();
        $billings = $billings->merge($listingBillings);
    }

    // Return the view with listings, payments, and billings data
    return view('payment.index', compact('listings', 'payments', 'billings'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $user = Auth::user();
        $reservation = Reservation::findOrFail($id);
        $listing = Listing::findOrFail($reservation->listing_id); // Retrieve the associated listing
        $prospect = $reservation->prospect; // Retrieve the user associated with the reservation
        return view('payments.create', compact('reservation', 'listing', 'prospect', 'user')); // Pass listing and prospect to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    // 
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'listing_id' => 'required|exists:listings,id',
        'total_amount' => 'required|numeric',
        'payment_method' => 'required|in:cash,gcash',
        'reference_number' => 'nullable|string',
        'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        'reservation_id' => 'required|exists:reservations,id', // Ensure reservation_id is passed
        'cash_advance_amount' => 'nullable|numeric', // Validate cash advance amount
    ]);

    try {
        // Retrieve the viewing record associated with the listing
        $viewing = Viewing::where('listing_id', $request->listing_id)
            ->where('viewing_status', 'approved') // Ensure the viewing is approved
            ->first();

        if (!$viewing) {
            return response()->json(['success' => false, 'message' => 'Viewing not found or not approved for the current user.'], 404);
        }

        // Retrieve the associated reservation using the reservation_id from the request
        $reservation = Reservation::findOrFail($request->reservation_id);

        // Create a new payment record and set the processor
        $payment = new Payment(); // Initialize the payment object
        $payment->processed_by = Auth::id(); // Set the user ID of the processor
        $payment->listing_id = $request->listing_id;
        $payment->amount = $request->total_amount; // Total amount to be paid
        $payment->cash_advance_amount = $request->cash_advance_amount; // Set cash advance amount
        $payment->payment_method = $request->payment_method;
        $payment->reference_number = $request->reference_number;

        // Handle file upload for the screenshot
        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('screenshots', 'public');
            $payment->screenshot = $path; // Store the path to the screenshot
        }

        // Save the payment record
        $payment->status = 'completed'; // Set the payment status to completed
        $payment->save(); // Save the payment record

        // Update the reservation status to approved
        $reservation->update(['reservation_status' => 'approved']);

        // Update the listing to associate it with the tenant and close availability
        $listing = Listing::find($request->listing_id);
        $listing->tenant_id = $viewing->requested_by; // Set tenant_id to the requested_by from the viewing
        $listing->availability = 'closed'; // Set availability to closed
        $listing->reservation = 'closed'; // Set reservation to closed
        $listing->save(); // Save the changes to the listing

        // Update the user's role to tenant
        $user = User::find($viewing->requested_by);
        $user->role = 'tenant';
        DB::table('sessions')->where('user_id', $user->id)->delete();
        $user->save();
        
        

        // Create a new billing record
        $billing = new Billings();
        $billing->user_id = $viewing->requested_by; // Assuming requested_by is the tenant
        $billing->listing_id = $request->listing_id;
        $billing->amount = $listing->price; // Amount to be billed
        $billing->due_date = now()->addMonth(); // Set due date to one month from now
        $billing->status = 'pending'; // Set initial status
        $billing->save(); // Save the billing record

        // Return a JSON response to trigger the modal
        return response()->json(['success' => true, 'payment_id' => $payment->id]);

    } catch (\Exception $e) {
        // Log the error message for debugging
        Log::error('Payment processing error: ' . $e->getMessage());

        // Return a JSON response with the error message
        return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
}
    // public function downloadReceipt($id)
    // {
    //     $payment = Payment::with(['listing.tenant', 'listing.user', 'processed_by'])->findOrFail($id);
    //     $data['owner'] = $payment->listing->user; // Get owner details
    //     $data['processed_by'] = $payment->processed_by; // Get the user who processed the payment
    //     $data['tenant'] = $payment->listing->tenant; // Get tenant details
    
    //     $data = [
    //         'payment' => $payment,
    //         'listing' => $payment->listing,
    //         'reservation' => $payment->reservation,
    //         'owner' => $data['owner'], // Get owner details
    //         'processed_by' => $data['processed_by'], // Get the user who processed the payment
    //         'user' => $data['processed_by'], // Pass user details to the view
            
    //     ];
    
    //     // Load PDF view and pass data
    //     $pdf = Pdf::loadView('payments.receipt', $data);
    
    //     return $pdf->download('payment_receipt_' . $payment->id . '.pdf');
    // }
    

   
    /**
     * Display the specified resource.
     */

     public function downloadReceipt($id)
{
    // Fetch the payment with related models
    $payment = Payment::with(['listing.tenant', 'listing.user', 'processor'])->findOrFail($id);


    // Prepare data for the PDF
    $data = [
        'payment' => $payment,
        'listing' => $payment->listing,
        'reservation' => $payment->reservation,
        'owner' => $payment->listing->user, // Get owner details
        'processed_by' => $payment->processed_by, // Get the user who processed the payment
        'tenant' => $payment->listing->tenant, // Get tenant details
    ];

    // Load PDF view and pass data
    $pdf = Pdf::loadView('payments.receipt', $data);

    // Download the PDF
    return $pdf->download('payment_receipt_' . $payment->id . '.pdf');
}
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function createpay($id)
    {
        $billing = Billings::with('utility')->findOrFail($id);
    
        // Calculate total utilities amount
        $utilityTotal = $billing->utility->sum('amount');
    
        // Calculate grand total (billing amount + utilities)
        $grandTotal = $billing->amount + $utilityTotal;
    
        return view('Tenant.payment.create', compact('billing', 'utilityTotal', 'grandTotal'));
    }
  
    public function paystore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'billing_id' => 'required|exists:billings,id',
            'listing_id' => 'required|exists:listings,id',
            'payment_method' => 'required|in:cash,gcash',
            'reference_number' => 'nullable|string|max:255',
            'screenshot' => 'nullable|image|max:2048',
            'cash_advance_checkbox' => 'nullable',
            'cash_advance_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);
    
        try {
            // Create a new payment record
            
    $payment = new Payment();
    $payment->billing_id = $request->billing_id;
    $payment->listing_id = $request->listing_id;
    $payment->amount = $request->total_amount;
    $payment->payment_method = $request->payment_method;
    $payment->status = 'processing';

    if ($request->hasFile('screenshot')) {
        $payment->screenshot = $request->file('screenshot')->store('payment_screenshots', 'public');
    }

    if ($request->filled('reference_number')) {
        $payment->reference_number = $request->reference_number;
    }

    if ($request->has('cash_advance_checkbox') && $request->filled('cash_advance_amount')) {
        $payment->cash_advance = $request->cash_advance_amount;
    }

    $payment->save();
    
            // Update the billing status to 'processing' using billing ID
            $billing = Billings::find($request->billing_id);
            if ($billing) {
                $billing->status = 'processing';
                $billing->save();
            }
    
            // Create a new billing record for the next month
            $newBilling = new Billings();
            $newBilling->user_id = Auth::id(); // Assuming current user is tenant
            $newBilling->listing_id = $request->listing_id;
            $newBilling->amount = $request->rent; // Or set to listing price if preferred
            $newBilling->due_date = now()->addMonth(); // Due date one month from now
            $newBilling->status = 'pending'; // Set initial status
            $newBilling->save();
    
            // Redirect to tenant payment index route with success message
            return redirect()->route('tenant.payment.index')->with('success', 'Payment submitted successfully and pending approval.');
        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Payment processing error: ' . $e->getMessage());
    
            // Redirect back with error message
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}

