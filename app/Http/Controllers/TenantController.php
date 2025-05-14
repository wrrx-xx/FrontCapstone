<?php

namespace App\Http\Controllers;

use App\Models\Billings;
use App\Models\Listing;
use App\Models\MaintenanceRequest;
use App\Models\UtilityBill;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
   public function index()
    {
        $user = Auth::user();
        
        // Get listings where tenant_id is the current user id
        $listings = Listing::where('tenant_id', $user->id)->get();
        
        // Get current active listing
        $currentListing = $listings->where('status', 'active')->first();
        
        // Get billings
        $billings = Billings::where('user_id', $user->id)
            ->orderBy('due_date', 'desc')
            ->get();
        
        // Get upcoming payment

        $upcomingBilling = $billings->where('status', 'pending')
            ->where('due_date', '>=', Carbon::now())
            ->sortBy('due_date')
            ->first();
            
        // Get maintenance requests
        $maintenanceRequests = MaintenanceRequest::where('tenant_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Get pending maintenance count
        $pendingMaintenanceCount = $maintenanceRequests
            ->where('status', 'Pending')
            ->count();

        return view('Tenant.dashboard', compact(
            'listings',
            'currentListing',
            'billings',
            'upcomingBilling',
            'maintenanceRequests',
            'pendingMaintenanceCount'
        ));
    }

    public function paymentindex(){
        return view('Tenant.payment');
    }
}