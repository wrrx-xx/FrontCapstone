<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Viewing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    
    public function ownerindex()
    {
        $user = Auth::user();
    
        // Determine owner ID based on user role
        $userId = $user->role === 'caretaker' ? $user->owner_id : $user->id;
        
        $viewings = Viewing::whereHas('listing', function ($query) use ($userId) {
            $query->where('owner_id', $userId);
        })
            ->with(['listing', 'requestedBy.tenantProfile'])
            ->orderByRaw("CASE 
                WHEN viewing_status = 'pending' THEN 1
                WHEN viewing_status = 'approved' THEN 2
                WHEN viewing_status = 'declined' THEN 3
                WHEN viewing_status = 'cancelled' THEN 4
                ELSE 5 END")
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Paginate results (10 per page)
    
        return view('booking.dashindex', compact('viewings'));
    }

    
    public function accept($id)

    {

        $viewing = Viewing::findOrFail($id);

    // Update the viewing status to approved
    $viewing->viewing_status = 'approved';
    $viewing->save();

    // Create a new reservation
    $reservation = Reservation::create([
        'listing_id' => $viewing->listing_id,
        'prospect_id' => $viewing->requested_by, // Ensure this line is included
        'reservation_status' => 'pending', // Default status
    ]);

    return redirect()->route(
        Auth::user()->role === 'admin' ? 'admin.reservation.index' : 'reservations.index'
    )->with('success', 'Viewing request accepted successfully!');
    
    }


    /**

     * Decline a viewing request.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function decline($id)

    {

        $viewing = Viewing::findOrFail($id);

        $viewing->viewing_status = 'declined';

        $viewing->save();


        return redirect()->route('booking.owner')->with('success', 'Viewing request declined successfully!');
    }
}

