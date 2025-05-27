<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SalesController extends Controller
{
    public function adminIndex(Request $request)
    {
        // Aggregate sales data grouped by owners for admin view using joins

        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date)->startOfDay() : null;
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date)->endOfDay() : null;

        $query = User::select('users.id', 'users.fname', 'users.lname', 'users.email',
                DB::raw('COUNT(DISTINCT listings.id) as total_properties'),
                DB::raw('COALESCE(SUM(payments.amount), 0) as total_sales'),
                DB::raw("COALESCE(SUM(CASE WHEN payments.status = 'pending' THEN payments.amount ELSE 0 END), 0) as pending_payments")
            )
            ->leftJoin('listings', 'users.id', '=', 'listings.owner_id')
            ->leftJoin('payments', 'listings.id', '=', 'payments.listing_id')
            ->where('users.role', 'owner')
            ->groupBy('users.id', 'users.fname', 'users.lname', 'users.email');

        if ($startDate && $endDate) {
            $query->whereBetween('payments.created_at', [$startDate, $endDate]);
        }

        $owners = $query->paginate(15);

        // Monthly revenue data for chart (overall, not per owner)
        $monthlyDataQuery = DB::table('payments')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('created_at', Carbon::now()->year);

        if ($startDate && $endDate) {
            $monthlyDataQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $monthlyData = $monthlyDataQuery
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $monthlyLabels = [];
        $monthlyValues = [];

        foreach ($monthlyData as $data) {
            $monthlyLabels[] = Carbon::create()->month($data->month)->format('M');
            $monthlyValues[] = $data->total;
        }

        return view('admin.sales.index', [
            'query' => $owners,
            'monthlyLabels' => $monthlyLabels,
            'monthlyValues' => $monthlyValues,
        ]);
    }

    public function index(Request $request)
    {
        $owner = Auth::user();
        
        // Get monthly revenue
        $monthlyRevenue = Payment::whereHas('listing', function($query) use ($owner) {
            $query->where('owner_id', $owner->id);
        })
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('amount');

        // Get pending payments
        $pendingPayments = Payment::whereHas('listing', function($query) use ($owner) {
            $query->where('owner_id', $owner->id);
        })
        ->where('status', 'pending')
        ->sum('amount');

        // Get total properties
        $totalProperties = Listing::where('owner_id', $owner->id)->count();

        // Get all payments with filtering
        $query = Payment::whereHas('listing', function($query) use ($owner) {
            $query->where('owner_id', $owner->id);
        })
        ->with(['listing.tenant'])
        ->latest();

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        $payments = $query->paginate(15);

        // Get monthly data for chart
        $monthlyData = Payment::whereHas('listing', function($query) use ($owner) {
            $query->where('owner_id', $owner->id);
        })
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(amount) as total')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        $monthlyLabels = [];
        $monthlyValues = [];

        foreach ($monthlyData as $data) {
            $monthlyLabels[] = Carbon::create()->month($data->month)->format('M');
            $monthlyValues[] = $data->total;
        }

        return view('sales.index', compact(
            'monthlyRevenue',
            'pendingPayments',
            'totalProperties',
            'payments',
            'monthlyLabels',
            'monthlyValues'
        ));
    }

    public function payments(Request $request)
    {
        $owner = Auth::user();
        
        $query = Payment::whereHas('listing', function($query) use ($owner) {
            $query->where('owner_id', $owner->id);
        })
        ->with(['listing.tenant'])
        ->latest();

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        $payments = $query->paginate(15);

        return view('sales.payments', compact('payments'));
    }

    public function show(Payment $payment)
    {
        // Check if the payment belongs to the owner's listing
        if ($payment->listing->owner_id !== Auth::id()) {
            abort(403);
        }

        $payment->load(['listing.tenant', 'billing']);

        return view('sales.show', compact('payment'));
    }

    /**
     * Get payment details for the API
     */
    public function getPaymentDetails(Payment $payment)
    {
        // Check if the payment belongs to the owner's listing
        if ($payment->listing->owner_id !== Auth::id()) {
            abort(403);
        }

        $payment->load(['listing.tenant', 'listing.user', 'billing']);

        return response()->json($payment);
    }

   
} 