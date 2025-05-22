<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Viewing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //Tenant side
   public function index()
{
    // Fetch the viewings for the authenticated user in descending order by viewing_date
    $viewings = Viewing::where('requested_by', Auth::id())
        ->with('listing')
        ->orderBy('viewing_date', 'desc') // Change 'viewing_date' to 'created_at' if you want to sort by creation date
        ->get();

    return view('booking.index', compact('viewings'));
}


    public function ownerindex()
{
    $userId = Auth::id();

    // Fetch reservations where the listing's owner_id matches the logged-in user
    $reservations = Reservation::with(['listing.photos', 'prospect'])
        ->whereHas('listing', function ($query) use ($userId) {
            $query->where('owner_id', $userId);
        })
        ->orderBy('reservation_status', 'desc')
        ->get();

    return view('reservation.index', compact('reservations'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'viewing_date' => 'required|date',
            'viewing_time' => 'required|date_format:H:i',
        ]);

        // Create a new viewing
        $viewing = Viewing::create([
            'listing_id' => $request->listing_id,
            'requested_by' => Auth::id(),
            'viewing_date' => $request->viewing_date,
            'viewing_time' => $request->viewing_time,
            'viewing_status' => 'pending', // or whatever default status you want
        ]);

        // Create a new reservation
        $reservation = Reservation::create([
            'listing_id' => $request->listing_id,
            'prospect_id' => Auth::id(), // Ensure this line is included
            'reservation_status' => 'pending', // or whatever default status you want
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Your reservation has been made successfully!');
    }

public function paystore(Request $request)
{
    $request->validate([
        'listing_id' => 'required|exists:listings,id',
        'amount' => 'required|numeric',
        'cash_advance' => 'nullable|numeric',
        'payment_method' => 'required|in:gcash,cash',
    ]);

    // Create a new payment record
    $payment = Payment::create([
        'listing_id' => $request->listing_id,
        'amount' => $request->amount,
        'cash_advance' => $request->cash_advance,
        'payment_method' => $request->payment_method,
        'status' => 'pending', // Set initial status
    ]);

    // Optionally, you can update the reservation status or notify the user here

    return redirect()->route('payment.success', ['payment' => $payment]);
}
    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'viewing_date' => 'required|date',
            'viewing_time' => 'required|date_format:H:i', // Assuming time is in HH:MM format
        ]);
        // Find the viewing by ID
        $viewing = Viewing::findOrFail($id);
        // Check if the user is authorized to update the viewing
        if ($viewing->requested_by !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this viewing.');
        }
        // Update the viewing details
        $viewing->viewing_date = $request->input('viewing_date');
        $viewing->viewing_time = $request->input('viewing_time');
        // Do not update viewing_status
        $viewing->save();
        // Redirect back with a success message
        return redirect()->route('viewings.index')->with('success', 'Viewing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return ['message' => 'reservation was delelted'];
    }


    /**

     * Show the details of a specific viewing.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $viewing = Viewing::findOrFail($id);

        return view('viewings.show', compact('viewing'));
    }

    public function approve($id)
{
    $reservation = Reservation::findOrFail($id);
    
    // Redirect to the payment form with the reservation ID
    return redirect()->route('payment.create', ['id' => $reservation->id]);
}
public function decline($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation -> reservation_status = 'declined';
    $reservation ->save();
    // Redirect to the payment form with the reservation ID
    return redirect()->route('reservations.index', ['id' => $reservation->id])->with('success', 'Reservation request declined successfully!');
}

}
