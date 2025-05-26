<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Listing;
use App\Models\User;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use App\Jobs\BroadcastNewMessage;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $listingId = $request->input('listing_id');
        $listing = null;
        $owner = null;
        $tenant = null;
        $caretaker = null;
        $chatPartners = collect();

        // Get the current tenant's active listing with relationships
        if ($listingId) {
            $listing = Listing::with(['user', 'caretakers', 'tenant'])->find($listingId);
        } else {
            $listing = Listing::with(['user', 'caretakers', 'tenant'])
                ->where('tenant_id', $userId)
                ->first();
        }

        if ($listing) {
            $owner = $listing->user;
            $tenant = $listing->tenant;
            $caretaker = $listing->caretakers->first();
            // Add owner and caretaker as chat partners if they exist
            $chatPartners = collect();
            if ($owner) $chatPartners->push($owner);
            if ($caretaker) $chatPartners->push($caretaker);
        }

        return view('tenant.messages.index', compact('listing', 'owner', 'tenant', 'caretaker', 'chatPartners'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'listing_id' => $request->listing_id,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Load the message with relationships for complete data
        $message->load(['sender', 'receiver', 'listing']);
        
        // Create the message array with all necessary data
        $messageArr = $message->toArray();
        $messageArr['sender_role'] = $message->sender ? $message->sender->role : null;
        $messageArr['sender_name'] = $message->sender ? $message->sender->fname . ' ' . $message->sender->lname : null;
        $messageArr['receiver_name'] = $message->receiver ? $message->receiver->fname . ' ' . $message->receiver->lname : null;

        // Dispatch the broadcast job asynchronously
        BroadcastNewMessage::dispatch($messageArr);

        return response()->json($messageArr);
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $userId = Auth::id();
        $otherUserId = $request->user_id;

        try {
            // Fetch messages with all necessary relationships
            $messages = Message::with(['sender', 'receiver', 'listing'])
                ->where('listing_id', $request->listing_id)
                ->where(function($q) use ($userId, $otherUserId) {
                    $q->where(function($q2) use ($userId, $otherUserId) {
                        $q2->where('sender_id', $userId)
                           ->where('receiver_id', $otherUserId);
                    })->orWhere(function($q2) use ($userId, $otherUserId) {
                        $q2->where('sender_id', $otherUserId)
                           ->where('receiver_id', $userId);
                    });
                })
                ->orderBy('created_at', 'asc')
                ->get()
                ->map(function($message) {
                    $messageArr = $message->toArray();
                    $messageArr['sender_role'] = $message->sender ? $message->sender->role : null;
                    $messageArr['sender_name'] = $message->sender ? $message->sender->fname . ' ' . $message->sender->lname : null;
                    $messageArr['receiver_name'] = $message->receiver ? $message->receiver->fname . ' ' . $message->receiver->lname : null;
                    $messageArr['created_at'] = $message->created_at->toIso8601String();
                    $messageArr['updated_at'] = $message->updated_at->toIso8601String();
                    return $messageArr;
                });

            return response()->json($messages);
        } catch (\Exception $e) {
            Log::error('Error fetching messages: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch messages'], 500);
        }
    }

    public function ownerIndex(Request $request)
    {
        $userId = Auth::id();
        
        // Fetch all messages where the owner is involved (as receiver or sender)
        $messages = Message::with(['sender', 'receiver', 'listing'])
            ->where(function($q) use ($userId) {
                $q->where('receiver_id', $userId)
                  ->orWhere('sender_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function($message) {
                // Add sender_role for frontend display
                $message->sender_role = $message->sender ? $message->sender->role : null;
                return $message;
            });

        // Get all unique chat partners (both tenants and caretakers)
        $chatPartners = collect($messages)->map(function($m) use ($userId) {
            return $m->sender_id == $userId ? $m->receiver : $m->sender;
        })->filter(function($user) use ($userId) {
            return $user && $user->id != $userId && ($user->role === 'tenant' || $user->role === 'caretaker');
        })->unique('id')->values();

        // Get caretakers specifically
        $caretakers = $chatPartners->filter(function($user) {
            return $user->role === 'caretaker';
        });

        // Get tenants specifically
        $tenants = $chatPartners->filter(function($user) {
            return $user->role === 'tenant';
        });

        return view('owner.messages.index', compact('messages', 'tenants', 'caretakers', 'chatPartners'));
    }

    public function caretakerIndex(Request $request)
    {
        $userId = Auth::id();
        
        // Fetch the caretaker user with their owner relationship
        $caretaker = User::with(['owner'])->find($userId);
        $owner = $caretaker->owner; // Get the owner directly from the relationship
        
        // Get the listing associated with the care@taker
        $listing = Listing::whereHas('caretakers', function($query) use ($userId) {
            $query->where('users.id', $userId);
        })->first();

        // Fetch all messages where the caretaker is involved
        $messages = Message::with(['sender', 'receiver', 'listing'])
            ->where(function($q) use ($userId) {
                $q->where('receiver_id', $userId)
                  ->orWhere('sender_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Get all unique chat partners
        $chatPartners = collect($messages)->map(function($m) use ($userId) {
            return $m->sender_id == $userId ? $m->receiver : $m->sender;
        })->filter(function($user) use ($userId) {
            return $user && $user->id != $userId;
        })->unique('id')->values();

        // Add owner to chat partners if not already present
        if ($owner && !$chatPartners->contains('id', $owner->id)) {
            $chatPartners->push($owner);
        }

        return view('caretaker.messages.index', [
            'messages' => $messages,
            'tenants' => $chatPartners,
            'owner' => $owner,
            'listing' => $listing,
        ]);
    }

    public function typing(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'listing_id' => 'required|exists:listings,id',
            'typing' => 'required|boolean'
        ]);

        // Optional: Store typing status in cache for persistence
        $cacheKey = "typing_{$request->listing_id}_{$request->receiver_id}_{$request->user()->id}";
        
        if ($request->typing) {
            Cache::put($cacheKey, true, now()->addSeconds(.05));
        } else {
            Cache::forget($cacheKey);
        }

        return response()->json([
            'success' => true,
            'message' => 'Typing status updated'
        ]);
    }

    /**
     * Get current typing users (optional endpoint)
     */
}
