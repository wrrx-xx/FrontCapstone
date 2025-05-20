<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\MaintenanceRequest;
use App\Models\Payment;

class AdminController extends Controller
{
    public function index()
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

        // Aggregate payments by month for the last 12 months
        $paymentSummary = Payment::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(amount) as total_amount")
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Generate last 12 months labels
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $months->push(now()->subMonths($i)->format('Y-m'));
        }

        // Map payment amounts to months, fill missing with 0
        $paymentAmountsMap = $paymentSummary->pluck('total_amount', 'month');
        $paymentAmounts = $months->map(function ($month) use ($paymentAmountsMap) {
            return $paymentAmountsMap->get($month, 0);
        });

        $paymentMonths = $months->map(function ($month) {
            return date('M Y', strtotime($month));
        });

        return view('admin.dashboard', compact(
            'totalOwners',
            'totalListings',
            'totalMaintenanceRequests',
            'totalPayments',
            'recentListings',
            'recentMaintenanceRequests',
            'maintenanceRequests',
            'payments',
            'viewings',
            'paymentMonths',
            'paymentAmounts'
        ));
    }
}
