<?php

namespace App\Http\Controllers;

use App\Models\Billings;
use App\Http\Requests\StoreBillingsRequest;
use App\Http\Requests\UpdateBillingsRequest;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillingsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Billings $billings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billings $billings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillingsRequest $request, Billings $billings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billings $billings)
    {
        //
    }

    /**
     * Approve the billing and mark payment as completed.
     */
    public function approve($id)
    {
        $billing = Billings::findOrFail($id);

        // Find the payment using payment_id on billing
        $payment = null;
        if ($billing->payment_id) {
            $payment = Payment::find($billing->payment_id);
        }

        if ($payment) {
            $billing->status = 'paid';
            $billing->payment_id = $payment->id;
            $billing->save();

            // Mark payment as completed too
            $payment->status = 'completed';
            $payment->processed_by = Auth::id();
            $payment->save();

            // Create a new billing record for the next month
            $newBilling = new Billings();
            $newBilling->user_id = $billing->user_id;
            $newBilling->listing_id = $billing->listing_id;
            $newBilling->amount = $billing->amount; // Use the same amount as current billing
            $newBilling->due_date = now()->addMonth(); // Due date one month from now
            $newBilling->status = 'pending'; // Set initial status
            $newBilling->save();

            // Additional logic: send notification or log approval if needed
        }

        return redirect()->back()->with('success', 'Billing approved and payment updated.');
    }

    /**
     * Decline the billing.
     */
    public function decline($id)
    {
        $billing = Billings::findOrFail($id);
        $billing->status = 'failed';
        $billing->save();

        // Find the payment using payment_id on billing
        $payment = null;
        if ($billing->payment_id) {
            $payment = Payment::find($billing->payment_id);
        }

        if ($payment) {
            $payment->processed_by = Auth::id();
            $payment->status = 'failed';
            $payment->save();

            // Additional logic: send notification or log decline if needed
        }

        return redirect()->back()->with('success', 'Billing declined successfully.');
    }
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
}
