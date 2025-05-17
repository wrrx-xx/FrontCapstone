<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\MaintenanceRequest;
use App\Models\Payment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOwners = User::where('role', 'owner')->count();
        $totalListings = Listing::count();
        $totalMaintenanceRequests = MaintenanceRequest::count();
        $totalPayments = Payment::count();

        $recentListings = Listing::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        $recentMaintenanceRequests = MaintenanceRequest::orderBy('created_at', 'desc')->take(5)->get();

        $maintenanceRequests = MaintenanceRequest::orderBy('created_at', 'desc')->get();
        $payments = Payment::orderBy('created_at', 'desc')->get();
        $viewings = \App\Models\Viewing::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact(
            'totalOwners',
            'totalListings',
            'totalMaintenanceRequests',
            'totalPayments',
            'recentListings',
            'recentMaintenanceRequests',
            'maintenanceRequests',
            'payments',
            'viewings'
        ));
    }
}
