<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:500'
        ]);

        $listing = Listing::findOrFail($id);

        // Check if user has already reviewed this listing
        $existingReview = Review::where('listing_id', $listing->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this property.');
        }

        // Create new review
        Review::create([
            'listing_id' => $listing->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
