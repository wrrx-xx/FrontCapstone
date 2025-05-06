<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\MaintenanceRequest;
use App\Models\Payment;
use App\Models\Viewing;
use Illuminate\Support\Facades\Auth;

class Owner extends Controller
{
    public function index(){
        $owner = Auth::user();

        // Get listings with related data counts
        $listings = Listing::where('owner_id', $owner->id)
            ->withCount(['view', 'billings'])
            ->with(['tenant'])
            ->get();

        // Get maintenance requests for owner's listings
        $maintenanceRequests = MaintenanceRequest::whereIn('listing_id', $listings->pluck('id'))
            ->with(['tenant', 'listing'])
            ->latest()
            ->get();

        // Get payments for owner's listings
        $payments = Payment::whereIn('listing_id', $listings->pluck('id'))
            ->with(['listing', 'billing'])
            ->latest()
            ->get();

        // Get viewing requests for owner's listings
        $viewings = Viewing::whereIn('listing_id', $listings->pluck('id'))
            ->with(['requestedBy', 'listing'])
            ->latest()
            ->get();

        // Get caretakers related to owner
        $caretakers = $owner->caretakers;

        return view('owner.dashboard', compact(
            'listings',
            'maintenanceRequests',
            'payments',
            'viewings',
            'caretakers'
        ));
    }
    
}
