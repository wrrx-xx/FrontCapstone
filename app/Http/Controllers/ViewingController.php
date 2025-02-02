<?php

namespace App\Http\Controllers;

use App\Models\Viewing;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'viewing_status' => 'pending', // Default status
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Your viewing has been requested successfully!');
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
