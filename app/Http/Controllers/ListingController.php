<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
    public function create(){
        return view('listing.create');
    }
    public function ownerindex(){
        return view('owner.property');
    }

    public function index(Request $request)
    {   
        // $user= $request ->user();
        // if($user->role === 'owner'){
        //     return Listing::where('owner_id', $user->id)->get();
        // } else{
        //     return Listing::all();
        // }
        $listing =Listing::all();
        return view('gridlisting.index');
    }
    

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
{
    // Validate the incoming request data
    $field = $request->validate([
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
        'wifi' => 'boolean',
        'kitchen' => 'boolean',
        'laundry' => 'boolean',
        'gym' => 'boolean',
        'projector_room' => 'boolean',
        'back_yard' => 'boolean',
        'front_yard' => 'boolean',
        'attached_garage' => 'boolean',
        'pool' => 'boolean',
        'elevator' => 'boolean',
        'school' => 'boolean',
        'transportation_hub' => 'boolean',
        'super_market' => 'boolean',
        'clinic' => 'boolean',
        'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate images
    ]);

    // Create a new listing
    $listing = $request->user()->listing()->create($field);

    // Create amenities
    $amenities = new Amenities([
        'wifi' => $request->has('wifi'),
        'kitchen' => $request->has('kitchen'),
        'laundry' => $request->has('laundry'),
        'gym' => $request->has('gym'),
        'projector_room' => $request->has('projector_room'),
        'back_yard' => $request->has('back_yard'),
        'front_yard' => $request->has('front_yard'),
        'attached_garage' => $request->has('attached_garage'),
        'pool' => $request->has('pool'),
        'elevator' => $request->has('elevator'),
        'school' => $request->has('school'),
        'transportation_hub' => $request->has('transportation_hub'),
        'super_market' => $request->has('super_market'),
        'clinic' => $request->has('clinic'),
    ]);
    $listing->amenities()->save($amenities);

    // Handle photo uploads
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('photos', 'public'); // Store in public/photos
            $listing->photos()->create(['url' => $path]);
        }
    }

    // Redirect or return response
    return redirect()->route('owner.property', $listing->id)->with('success', 'Listing created successfully.');
}
    

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return ['listings' => $listing];
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
}
