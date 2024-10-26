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
    public function create()
    {
        return view('listing.create');
    }
    public function ownerindex()
    {
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
        $listing = Listing::all();
        return view('gridlisting.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'owner_id' => 'required|exists:users,id',
             'title' => 'required|string|max:255',
             'body' => 'required|string',
             'price' => 'required|numeric',
             'address' => 'required|string',
             'baranggay' => 'required|string',
             'city' => 'required|string',
             'type' => 'required|in:Apartment,House,Boarding house,Room',
             'availability' => 'in:open,closed',
             'reservation' => 'in:open,closed',
             'reservation_amount' => 'required|numeric|between:0,999999.99',
             'photos' => 'array',
             'photos.*.photo_url' => 'required|string',
             'amenities' => 'required|array',
             'amenities.wifi' => 'boolean',
             'amenities.parking' => 'boolean',
             'amenities.bathroom' => 'boolean',
             'amenities.kitchen' => 'boolean',
             'amenities.laundry' => 'boolean',
             'amenities.gym' => 'boolean',
             'amenities.projector_room' => 'boolean',
             'amenities.back_yard' => 'boolean',
             'amenities.front_yard' => 'boolean',
             'amenities.attached_garage' => 'boolean',
             'amenities.pool' => 'boolean',
             'amenities.elevator' => 'boolean',
             'amenities.school' => 'boolean',
             'amenities.transportation_hub' => 'boolean',
             'amenities.super_market' => 'boolean',
             'amenities.clinic' => 'boolean',
         ]);
     
         DB::beginTransaction();
         try {
             // Create the listing
             $listing = Listing::create([
                 'owner_id' => $validatedData['owner_id'],
                 'title' => $validatedData['title'],
                 'body' => $validatedData['body'],
                 'price' => $validatedData['price'],
                 'address' => $validatedData['address'],
                 'baranggay' => $validatedData['baranggay'],
                 'city' => $validatedData['city'],
                 'type' => $validatedData['type'],
                 'availability' => $validatedData['availability'] ?? 'open',
                 'reservation' => $validatedData['reservation'] ?? 'open',
                 'reservation_amount' => $validatedData['reservation_amount'],
             ]);
     
             // Save photos if any
             if (!empty($validatedData['photos'])) {
                 foreach ($validatedData['photos'] as $photoData) {
                     $listing->photos()->create([
                         'photo_url' => $photoData['photo_url'],
                     ]);
                 }
             }
     
             // Save amenities
             $listing->amenity()->create($validatedData['amenities']);
     
             DB::commit();
             return response()->json(['message' => 'Listing created successfully', 'listing' => $listing], 201);
     
         } catch (\Exception $e) {
             DB::rollBack();
             return response()->json(['message' => 'Failed to create listing', 'error' => $e->getMessage()], 500);
         }
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
