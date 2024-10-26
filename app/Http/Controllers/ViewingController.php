<?php

namespace App\Http\Controllers;

use App\Models\Viewing;
use App\Models\Verification;
use Illuminate\Http\Request;

class ViewingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Viewing::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
    $field = $request->validate([
        'listing_id' => 'required|exists:listings,id', // Ensure the listing exists
        'viewing_date' => 'required|date', // Validate date format
        'viewing_time' => 'required|date_format:H:i', // Validate time format
        'viewing_status' => 'required|in:approved,declined,cancelled' // Validate status
    ]);

    // Check if the user has an approved verification
    $verification = Verification::where('user_id', $request->user()->id)
        ->where('status', 'approved')
        ->first();

    if (!$verification) {
        return response()->json(['error' => 'You must be verified to create a viewing.'], 403);
    }
        $view =$request->user()->viewing()->create($field);

        return ['viewings' => $view];
    }

    /**
     * Display the specified resource.
     */
    public function show(Viewing $viewing)
    {
        return  $viewing;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Viewing $viewing)
    {
        $field = $request->validate([
            'listing_id' => 'required',
            'viewing_date' => 'required',
            'viewing_time' => 'required',
            'viewing_status' => 'required'
            ]);
             $viewing->update($field);
            return response()->json(['message' => 'Viewing updated successfully!', 'viewing' => $viewing]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viewing $viewing)
    {
        $viewing->delete();
        return ['message' => 'The Viewing was deleted'];
    }
}
