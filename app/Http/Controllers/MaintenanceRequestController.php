<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Http\Requests\StoreMaintenanceRequestRequest;
use App\Http\Requests\UpdateMaintenanceRequestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaintenanceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = MaintenanceRequest::with('listing')->where('tenant_id', Auth::id())
            ->latest()
            ->paginate(10); // 10 per page
    
        return view('Tenant.maintenance.index', compact('requests'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listings = Auth::user()->listings; // get collection of listings (plural)
        return view('Tenant.maintenance.create', compact('listings'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'category' => 'required|string|max:255',
            'priority' => 'required|in:Low,Medium,High,Urgent',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'preferred_schedule' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('maintenance_photos', 'public');
        }
    
        MaintenanceRequest::create([
            'tenant_id' => Auth::id(),
            'listing_id' => $request->listing_id,
            'category' => $request->category,
            'priority' => $request->priority,
            'title' => $request->title,
            'description' => $request->description,
            'preferred_schedule' => $request->preferred_schedule,
            'photo_path' => $photoPath,
            'status' => 'Pending',
        ]);
    
        return redirect()->route('tenant.maintenance.index')->with('success', 'Maintenance request submitted successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceRequest $maintenanceRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceRequest $maintenanceRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Pending,in_progress,resolved',
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceRequest $maintenanceRequest)
    {
        //
    }
}
