<?php

namespace App\Http\Controllers;

use App\Models\Viewing;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'viewing_id' => 'required|exists:viewings,id',
            'payment_method' => 'required|in:gcash,cash',
            'cash_advance' => 'nullable|numeric|min:0',
        ]);
    
        $viewing = Viewing::findOrFail($request->viewing_id);
        $totalAmount = $viewing->listing->price + $viewing->listing->reservation_amount;
    
        // Determine the amount to be paid
        $cashAdvance = $request->cash_advance ?? 0;
        $amountToPay = $totalAmount - $cashAdvance; // Subtract cash advance from total amount
    
        // Create the payment record
        $payment = Payment::create([
            'viewing_id' => $viewing->id,
            'listing_id' => $viewing->listing_id, // Link to the listing
            'amount' => $amountToPay,
            'payment_method' => $request->payment_method,
            'status' => 'completed', // Set to completed or pending based on your logic
        ]);
    
        // Update the viewing payment status
        $viewing->update(['payment_status' => 'completed']);
    
        // Optionally, handle cash advance logic (e.g., record it separately, notify tenant, etc.)
    
        return redirect()->route('listing.myproperty')->with('success', 'Payment processed successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
