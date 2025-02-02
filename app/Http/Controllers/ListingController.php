<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Listing;
use App\Models\Photos;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function create()
    {
        return view('listing.create');
    }
    public function ownerindex()
    {
        return view('owner.property');
    }

    public function index()
    {
        // Fetch all listings with pagination
        $listings = Listing::paginate(10); // Adjust the number per page as needed

        // Pass the listings to the view
        return view('listing.display', ['listings' => $listings]);
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string|max:255',
            'baranggay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'type' => 'required|in:Apartment,House,Boarding house,Room',
            'availability' => 'required|in:open,closed',
            'reservation' => 'required|in:open,closed',
            'reservation_amount' => 'required|numeric',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif', // Validate photo uploads
            'map_link' => '|string|max:255',
            'waiver_file' => '|mimes:pdf|max:255', // Validate PDF file for waiver_file
        ]);
        

        // Create the listing
        $listing = Listing::create([
            'owner_id' => Auth::id(), // Get the authenticated user's ID
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'address' => $request->address,
            'baranggay' => $request->baranggay,
            'city' => $request->city,
            'type' => $request->type,
            'availability' => $request->availability,
            'reservation' => $request->reservation,
            'reservation_amount' => $request->reservation_amount,
            'map_link' => $request->maps,
            'waiver_file' => $request->waiver,
        ]);

        // Create amenities
        Amenities::create([
            'listing_id' => $listing->id,
            'wifi' => $request->has('wifi') ? 1 : 0, // Convert checkbox to boolean
            'parking' => $request->has('parking') ? 1 : 0,
            'bathroom' => $request->has('bathroom') ? 1 : 0,
            'kitchen' => $request->has('kitchen') ? 1 : 0,
            'laundry' => $request->has('laundry') ? 1 : 0,
            'gym' => $request->has('gym') ? 1 : 0,
            'projector_room' => $request->has('projector_room') ? 1 : 0,
            'back_yard' => $request->has('back_yard') ? 1 : 0,
            'front_yard' => $request->has('front_yard') ? 1 : 0,
            'attached_garage' => $request->has('attached_garage') ? 1 : 0,
            'pool' => $request->has('pool') ? 1 : 0,
            'elevator' => $request->has('elevator') ? 1 : 0,
            'school' => $request->has('school') ? 1 : 0,
            'transportation_hub' => $request->has('transportation_hub') ? 1 : 0,
            'super_market' => $request->has('super_market') ? 1 : 0,
            'clinic' => $request->has('clinic') ? 1 : 0,
        ]);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Store the photo and get the path
                $path = $photo->store('photos', 'public'); // Store in the 'photos' directory in the public disk

                // Create a new photo record
                Photos::create([
                    'listing_id' => $listing->id,
                    'photo_url' => $path,
                ]);
            }
        }

        // Redirect or return response
        return redirect()->route('listing.create')->with('success', 'Listing created successfully!');
    }


    public function show($id)
    {
        // Retrieve the listing by its ID
        $listing = Listing::with(['photos', 'amenities'])->findOrFail($id);
    
        // Return the 'show' view with the listing data
        return view('listing.view', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $field = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'price' => 'required',
            'address' => 'required',
            'city' => 'required',
            'type' => 'required',
            'availability' => 'required|in:open,closed',
            'reservation' => 'required|in:open,closed',
            'reservation_amount' => 'required'
        ]);

        $listing->update($field);

        return ['listings' => $listing];
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return ['message' => 'The post was deleted'];
    }
    public function myproperty($id)
    {
        $listings = Listing::where('owner_id', $id)->with('amenities', 'photos')->get();
        return view('listing.myproperty', compact('listings'));
    }
    public function display()
    {
        Listing::all();
        return view('listing.display');
    }
}
