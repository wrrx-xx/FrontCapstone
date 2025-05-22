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
   public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'viewing_date' => 'required|date',
            'viewing_time' => 'required|date_format:H:i', // Assuming time is in HH:MM format
        ]);
        // Find the viewing by ID
        $viewing = Viewing::findOrFail($id);
        // Check if the user is authorized to update the viewing
        if ($viewing->requested_by !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this viewing.');
        }
        // Update the viewing details
        $viewing->viewing_date = $request->input('viewing_date');
        $viewing->viewing_time = $request->input('viewing_time');
        // Do not update viewing_status
        $viewing->save();
        // Redirect back with a success message
        return redirect()->route('reserve.index')->with('success', 'Viewing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viewing $viewing)
    {
        $viewing->delete();
        return ['message' => 'The Viewing was deleted'];
    }  
   
public function cancel($id)
    {
        // Find the viewing by ID
        $viewing = Viewing::findOrFail($id);
        // Check if the user is authorized to cancel the viewing
        if ($viewing->requested_by !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to cancel this viewing.');
        }
        // Update the viewing status to 'canceled'
        $viewing->viewing_status = 'cancelled';
        $viewing->save();
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Viewing canceled successfully.');
    }
}
