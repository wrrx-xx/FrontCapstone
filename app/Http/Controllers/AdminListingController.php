<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Listing;
use App\Models\Photos;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminListingController extends Controller
{
    /**
     * Display the form to create a new listing with owner selection.
     */
   public function index()
{
    $owners = User::where('role', 'owner')->with(['listing.photos'])->paginate(10);
    return view('admin.listing.index', compact('owners'));
}


    public function create()
    {
        $amenities = (new Amenities())->getFillable();
        // Remove 'listing_id' from the list
        $amenities = array_filter($amenities, fn($item) => $item !== 'listing_id');

        // Get all owners for admin to select
        $owners = User::where('role', 'owner')->get();

        return view('admin.listing.create', compact('amenities', 'owners'));
    }

    /**
     * Store a newly created listing by admin with owner selection.
     */
   public function store(Request $request)
{
    try {
        // Validate the incoming request data including owner_id
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string|max:255',
            'baranggay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'type' => 'required|in:Apartment,House,Boarding house,Room',
            'availability' => 'required|in:open,closed',
            'reservation' => 'required|in:open,closed',
            'reservation_amount' => 'required|numeric',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif',
            'map_link' => '|string|max:255',
            'waiver_file' => 'nullable|mimes:pdf|max:10240',
            'advance_payment_months' => 'required|integer|in:0,1,2',
        ]);

        // Handle waiver_file upload
        $waiverFilePath = null;
        if ($request->hasFile('waiver_file')) {
            $waiverFile = $request->file('waiver_file');
            $filename = time() . '_' . $waiverFile->getClientOriginalName();
            $waiverFile->move(public_path('waivers'), $filename);
            $waiverFilePath = 'waivers/' . $filename;
        }

        // Create the listing with selected owner_id
        $listing = Listing::create([
            'owner_id' => $request->owner_id,
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'address' => $request->address,
            'baranggay' => $request->baranggay,
            'city' => $request->city,
            'type' => $request->type,
            'availability' => $request->availability,
            'reservation' => $request->reservation,
            'reservation_amount' => $request->reservation_amount,
            'map_link' => $request->maps,
            'waiver_file' => $waiverFilePath,
            'advance_payment_months' => $request->input('advance_payment_months'),
        ]);

        // Create amenities
        Amenities::create([
            'listing_id' => $listing->id,
            'wifi' => $request->has('wifi') ? 1 : 0,
            'parking' => $request->has('parking') ? 1 : 0,
            'bathroom' => $request->has('bathroom') ? 1 : 0,
            'kitchen' => $request->has('kitchen') ? 1 : 0,
            'laundry' => $request->has('laundry') ? 1 : 0,
            'gym' => $request->has('gym') ? 1 : 0,
            'projector_room' => $request->has('projector_room') ? 1 : 0,
            'back_yard' => $request->has('back_yard') ? 1 : 0,
            'front_yard' => $request->has('front_yard') ? 1 : 0,
            'attached_garage' => $request->has('attached_garage') ? 1 : 0,
            'pool' => $request->has('pool') ? 1 : 0,
            'elevator' => $request->has('elevator') ? 1 : 0,
            'school' => $request->has('school') ? 1 : 0,
            'transportation_hub' => $request->has('transportation_hub') ? 1 : 0,
            'super_market' => $request->has('super_market') ? 1 : 0,
            'clinic' => $request->has('clinic') ? 1 : 0,
        ]);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('photos'), $filename);
                $path = 'photos/' . $filename;

                Photos::create([
                    'listing_id' => $listing->id,
                    'photo_url' => $path,
                ]);
            }
        }

        // Redirect or return response
        return redirect()->route('admin.listing.create')->with('success', 'Listing created successfully by admin!');
    } catch (Exception $e) {
        // Log the error and redirect back with error message
        Log::error('Error creating listing by admin: ' . $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'An error occurred while creating the listing. Please try again.');
    }
}
public function edit($id)
{
    $listing = Listing::findOrFail($id);
    $owners = User::where('role', 'owner')->get();
    $amenities = (new Amenities())->getFillable();
    $amenities = array_filter($amenities, fn($item) => $item !== 'listing_id');

    $listingAmenities = $listing->amenities;

    return view('admin.listing.edit', compact('listing', 'owners', 'amenities', 'listingAmenities'));
}

public function update(Request $request, $id)
{
    try {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string|max:255',
            'baranggay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'type' => 'required|in:Apartment,House,Boarding house,Room',
            'availability' => 'required|in:open,closed',
            'reservation' => 'required|in:open,closed',
            'reservation_amount' => 'required|numeric',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif',
            'map_link' => 'nullable|string|max:255',
            'waiver_file' => 'nullable|mimes:pdf|max:10240',
            'advance_payment_months' => 'required|integer|in:0,1,2',
        ]);

        $listing = Listing::findOrFail($id);

        // Handle waiver_file upload if new file uploaded
        if ($request->hasFile('waiver_file')) {
            $waiverFile = $request->file('waiver_file');
            $filename = time() . '_' . $waiverFile->getClientOriginalName();
            $waiverFile->move(public_path('waivers'), $filename);
            $listing->waiver_file = 'waivers/' . $filename;
        }

        $listing->update([
            'owner_id' => $request->owner_id,
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'address' => $request->address,
            'baranggay' => $request->baranggay,
            'city' => $request->city,
            'type' => $request->type,
            'availability' => $request->availability,
            'reservation' => $request->reservation,
            'reservation_amount' => $request->reservation_amount,
            'map_link' => $request->maps,
            'advance_payment_months' => $request->input('advance_payment_months'),
        ]);

        // Update amenities
        $amenitiesData = [
            'wifi' => $request->has('wifi') ? 1 : 0,
            'parking' => $request->has('parking') ? 1 : 0,
            'bathroom' => $request->has('bathroom') ? 1 : 0,
            'kitchen' => $request->has('kitchen') ? 1 : 0,
            'laundry' => $request->has('laundry') ? 1 : 0,
            'gym' => $request->has('gym') ? 1 : 0,
            'projector_room' => $request->has('projector_room') ? 1 : 0,
            'back_yard' => $request->has('back_yard') ? 1 : 0,
            'front_yard' => $request->has('front_yard') ? 1 : 0,
            'attached_garage' => $request->has('attached_garage') ? 1 : 0,
            'pool' => $request->has('pool') ? 1 : 0,
            'elevator' => $request->has('elevator') ? 1 : 0,
            'school' => $request->has('school') ? 1 : 0,
            'transportation_hub' => $request->has('transportation_hub') ? 1 : 0,
            'super_market' => $request->has('super_market') ? 1 : 0,
            'clinic' => $request->has('clinic') ? 1 : 0,
        ];

        $listing->amenities()->update($amenitiesData);

        // Handle photo uploads if any new photos uploaded
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('photos'), $filename);
                $path = 'photos/' . $filename;

                Photos::create([
                    'listing_id' => $listing->id,
                    'photo_url' => $path,
                ]);
            }
        }

        return redirect()->route('admin.listing.index')->with('success', 'Listing updated successfully by admin!');
    } catch (Exception $e) {
        Log::error('Error updating listing by admin: ' . $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'An error occurred while updating the listing. Please try again.');
    }
}


}
