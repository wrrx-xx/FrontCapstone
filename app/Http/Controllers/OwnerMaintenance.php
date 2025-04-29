<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerMaintenance extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ownerId = Auth::id();

        // Get listings owned by the authenticated owner
        $listingIds = Listing::where('owner_id', $ownerId)->pluck('id');

        // Get maintenance requests for those listings with correct eager loading
        $requests = MaintenanceRequest::whereIn('listing_id', $listingIds)
            ->with(['listing', 'tenant'])
            ->get();

        return view('owner.maintenance.index', compact('requests'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed,Cancelled',
            'remarks' => 'nullable|string|max:1000',
            'photo_proof' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $maintenance = MaintenanceRequest::findOrFail($id);
    
        $maintenance->status = $request->status;
        $maintenance->remarks = $request->remarks;
    
        if ($request->hasFile('photo_proof')) {
            // Optionally delete old proof if needed
            if ($maintenance->photo_proof && Storage::exists($maintenance->photo_proof)) {
                Storage::delete($maintenance->photo_proof);
            }
    
            $path = $request->file('photo_proof')->store('proof_photos', 'public');
            $maintenance->photo_proof = $path;
        }
    
        $maintenance->save();
    
        return redirect()->back()->with('success', 'Maintenance request updated successfully.');
    }
}
