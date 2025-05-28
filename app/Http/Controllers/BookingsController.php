<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Viewing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookingStatusNotification;

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
                WHEN viewing_status = 'suggested' THEN 2
                WHEN viewing_status = 'approved' THEN 3
                WHEN viewing_status = 'declined' THEN 4
                WHEN viewing_status = 'cancelled' THEN 5
                ELSE 6 END")
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
            'prospect_id' => $viewing->requested_by,
            'reservation_status' => 'pending',
        ]);

        // Send notification to the user who requested the viewing
        $viewing->requestedBy->notify(new BookingStatusNotification(
            'Your viewing request has been accepted!',
            'Your viewing request for ' . $viewing->listing->title . ' has been approved.',
            'success'
        ));

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

        // Send notification to the user who requested the viewing
        $viewing->requestedBy->notify(new BookingStatusNotification(
            'Your viewing request has been declined',
            'Your viewing request for ' . $viewing->listing->title . ' has been declined.',
            'error'
        ));

        return redirect()->route('booking.owner')->with('success', 'Viewing request declined successfully!');
    }

    public function suggestTime(Request $request, Viewing $viewing)
    {
        $request->validate([
            'suggested_date' => 'required|date|after:today',
            'suggested_time' => 'required',
            'suggestion_reason' => 'required|string|max:500'
        ]);

        $viewing->update([
            'suggested_date' => $request->suggested_date,
            'suggested_time' => $request->suggested_time,
            'suggestion_reason' => $request->suggestion_reason,
            'viewing_status' => 'suggested'
        ]);

        // Send notification to the user who requested the viewing
        $viewing->requestedBy->notify(new BookingStatusNotification(
            'New viewing time suggested',
            'A new viewing time has been suggested for ' . $viewing->listing->title . '. Please check your bookings.',
            'info'
        ));

        return redirect()->back()->with('success', 'Alternative time suggested successfully.');
    }
}

