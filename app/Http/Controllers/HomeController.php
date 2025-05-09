<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get a random open listing for the featured card
        $randomListing = Listing::with(['photos', 'amenities'])
            ->where('availability', 'open')
            ->inRandomOrder()
            ->first();

        // Get all cities for the dropdown
        $cities = Listing::select('city')
            ->distinct()
            ->pluck('city');

        // Get recent listings for the featured properties section
        $listings = Listing::with(['photos', 'amenities'])
            ->where('availability', 'open')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('randomListing', 'cities', 'listings'));
    }

    public function search(Request $request)
    {
        $query = Listing::with(['photos', 'amenities'])
            ->where('availability', 'open');

        // Filter by type if provided
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by city if provided
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Filter by category (maps to type)
        if ($request->filled('category')) {
            $category = $request->category;
            switch(strtolower($category)) {
                case 'apartment':
                    $query->where('type', 'Apartment');
                    break;
                case 'houses':
                    $query->where('type', 'House');
                    break;
                case 'boarding house':
                    $query->where('type', 'Boarding house');
                    break;
                case 'room':
                    $query->where('type', 'Room');
                    break;
            }
        }

        $listings = $query->latest()->get();

        if ($request->ajax()) {
            return response()->json([
                'listings' => $listings,
                'html' => view('partials.property-listings', compact('listings'))->render()
            ]);
        }

        return view('home', compact('listings'));
    }

    public function filteredListings(Request $request)
    {
        $query = Listing::with(['photos', 'amenities'])
            ->where('availability', 'open');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('baranggay')) {
            $query->where('baranggay', $request->baranggay);
        }

        $listings = $query->inRandomOrder()->limit(6)->get();

        // Get all cities for the dropdown
        $cities = Listing::select('city')->distinct()->pluck('city');

        // Get all baranggays for the dropdown
        $baranggays = Listing::select('baranggay')->distinct()->pluck('baranggay');

        return view('home', compact('listings', 'cities', 'baranggays'));
    }
}
