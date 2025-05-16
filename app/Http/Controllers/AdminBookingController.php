<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Viewing;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
   public function index()
    {
        $viewings = Viewing::with(['listing.user', 'requestedBy.tenantProfile'])
            ->orderByRaw("CASE 
                WHEN viewing_status = 'pending' THEN 1
                WHEN viewing_status = 'approved' THEN 2
                WHEN viewing_status = 'declined' THEN 3
                WHEN viewing_status = 'cancelled' THEN 4
                ELSE 5 END")
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($viewing) {
                return $viewing->listing->user->id;
            });

        return view('admin.booking.index', ['ownersViewings' => $viewings]);
    }
   public function create()
{
    // Fetch all users with role 'guest' to select as requester
    $guests = User::where('role', 'guest')->get();

    // Fetch all listings to select from
    $listings = Listing::all();

    return view('admin.booking.create', compact('guests', 'listings'));
}

    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'listing_id' => 'required|exists:listings,id',
        'requested_by' => 'required|exists:users,id',
        'viewing_date' => 'required|date',
        'viewing_time' => 'required|date_format:H:i',
    ]);

    // Create a new viewing
    $viewing = Viewing::create([
        'listing_id' => $request->listing_id,
        'requested_by' => $request->requested_by,
        'viewing_date' => $request->viewing_date,
        'viewing_time' => $request->viewing_time,
        'viewing_status' => 'pending', // Default status
    ]);

    // Redirect or return a response
    return redirect()->back()->with('success', 'The viewing has been requested successfully!');
}
public function adminindex()
{
    // Fetch reservations with related listings, prospects, and photos
    // Order by listing owner's name
    $reservations = Reservation::with(['listing.photos', 'prospect', 'listing.user'])
        ->get()
        ->sortBy(function ($reservation) {
            return $reservation->listing->user->fname ?? '';
        });

    return view('admin.reservation.index', compact('reservations'));
}

}