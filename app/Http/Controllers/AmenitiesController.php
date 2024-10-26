<?php

namespace App\Http\Controllers;

use App\Models\amenities;
use App\Http\Requests\StoreamenitiesRequest;
use App\Http\Requests\UpdateamenitiesRequest;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return amenities::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $field = $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'amenity_wifi' => 'required|boolean',
            'amenity_parking' => 'required|boolean',
            'amenity_bathroom' => 'required|boolean',
            'amenity_kitchen' => 'required|boolean',
        ]);
        $amenity = amenities::create($field);
        return ['amenities' => $amenity];
    }   
    

    /**
     * Display the specified resource.
     */
    public function show(amenities $amenities)
    {
     return $amenities;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, amenities $amenities)
    {
        $field = $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'amenity_wifi' => 'required|boolean',
            'amenity_parking' => 'required|boolean',
            'amenity_bathroom' => 'required|boolean',
            'amenity_kitchen' => 'required|boolean',
        ]);
        $amenities -> update($field);
        return ['amenities'=> $amenities];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(amenities $amenities)
    {
        $amenities -> delete();
        return ['message' => 'Amenity deleted'];
    }
}
