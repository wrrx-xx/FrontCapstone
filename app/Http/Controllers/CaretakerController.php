<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\MaintenanceRequest;
use App\Models\Payment;
use App\Models\User;
use App\Models\Viewing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CaretakerController extends Controller
{   
    public function dashboard(){
        $user = Auth::user();

        // Determine owner ID based on user role
        $ownerId = $user->role === 'caretaker' ? $user->owner_id : $user->id;

        // Get listings with related data counts
        $listings = Listing::where('owner_id', $ownerId)
            ->withCount(['view', 'billings'])
            ->with(['tenant'])
            ->get();

        // Get maintenance requests for owner's listings
        $maintenanceRequests = MaintenanceRequest::whereIn('listing_id', $listings->pluck('id'))
            ->with(['tenant', 'listing'])
            ->latest()
            ->get();

        // Get payments for owner's listings
        $payments =Payment::whereIn('listing_id', $listings->pluck('id'))
            ->with(['listing', 'billing'])
            ->latest()
            ->get();

        // Get viewing requests for owner's listings
        $viewings = Viewing::whereIn('listing_id', $listings->pluck('id'))
            ->with(['requestedBy', 'listing'])
            ->latest()
            ->get();

        // Get caretakers related to owner
        $caretakers = User::where('owner_id', $ownerId)
            ->where('role', 'caretaker')
            ->get();

        return view('caretaker.dashboard', compact(
            'listings',
            'maintenanceRequests',
            'payments',
            'viewings',
            'caretakers'
        ));
    }
    public function create()
    {
        return view('caretaker.create');
    }

    public function index()
    {
        $caretakers = User::where('owner_id', Auth::id())
            ->where('role', 'caretaker')
            ->get();
            
        return view('caretaker.index', compact('caretakers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'owner_id' => Auth::id(),
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'caretaker',
        ]);

        return redirect()->route('caretaker.index')->with('success', 'Caretaker created successfully!');
    }

    public function edit(User $caretaker)
    {
        // Ensure the caretaker belongs to the current owner
        if ($caretaker->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('caretaker.edit', compact('caretaker'));
    }

    public function update(Request $request, User $caretaker)
    {
        // Ensure the caretaker belongs to the current owner
        if ($caretaker->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$caretaker->id,
            'phone_number' => 'required|string|max:15',
        ]);

        $caretaker->update([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('caretaker.index')->with('success', 'Caretaker updated successfully!');
    }

    public function destroy(User $caretaker)
    {
        // Ensure the caretaker belongs to the current owner
        if ($caretaker->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $caretaker->delete();

        return redirect()->route('caretaker.index')->with('success', 'Caretaker deleted successfully!');
    }
}
