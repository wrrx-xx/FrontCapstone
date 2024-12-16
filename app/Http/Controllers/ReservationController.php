<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Viewing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function index()

    {

        // Fetch the viewings for the authenticated user

        $viewings = Viewing::where('requested_by', Auth::id())->with('listing')->get();


        return view('booking.index', compact('viewings'));

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

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return  $reservation;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
            $request->validate([
            'listing_id'=>'required',
            'reservation_status'=> 'required'
            ]);
            $request->update();
            return ['reservations'=> $reservation];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return ['message'=> 'reservation was delelted'];
    }
}
