<?php

namespace App\Http\Controllers;

use App\Models\Billings;
use App\Http\Requests\StoreBillingsRequest;
use App\Http\Requests\UpdateBillingsRequest;

use App\Models\Payment;
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
    
        // Find the latest payment matching this billing
        $payment = Payment::where('billing_id', $billing->id)->latest()->first();
    
        if ($payment) {
            $billing->status = 'paid';
            $billing->payment_id = $payment->id;
            $billing->save();
    
            // Optional: mark payment as completed too
            $payment->status = 'completed';
            $payment->save();
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

        // Find the existing payment associated with this billing and update processed_by
        $payment = Payment::where('listing_id', $billing->listing_id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($payment) {
            $payment->processed_by = Auth::id();
            $payment->save();
        }

        return redirect()->back()->with('success', 'Billing declined successfully.');
    }
}
