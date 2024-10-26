<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Reservation::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field = $request->validate([
        'listing_id'=>'required',
        'reservation_status'=> 'required'
        ]);
        $reservation = $request -> user()->reservation()->create($field);

        return ['reservations'=> $reservation];
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
