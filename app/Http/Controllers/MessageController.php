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

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $listingId = $request->input('listing_id');
        $listing = null;
        $owner = null;
        $tenant = null;
        $caretaker = null;

        if ($listingId) {
            $listing = Listing::with('user', 'caretakers')->find($listingId);
        } else {
            // Get the current tenant's active listing
            $listing = Listing::with('user', 'caretakers')
                ->where('tenant_id', Auth::id())
                ->first();
        }

        if ($listing) {
            $owner = $listing->user; // owner of the listing
            $tenant = $listing->tenant; // assigned tenant (should be current user)
            $caretaker = $listing->caretakers->first(); // get the first caretaker for this listing's owner
        }

        return view('tenant.messages.index', compact('listing', 'owner', 'tenant', 'caretaker'));
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

        $options = Config::get('services.pusher.options');
        $pusher = new Pusher(
            Config::get('services.pusher.key'),
            Config::get('services.pusher.secret'),
            Config::get('services.pusher.app_id'),
            $options
        );
        // Attach sender_role to the message for frontend display
        $messageArr = $message->toArray();
        $messageArr['sender_role'] = $message->sender ? $message->sender->role : null;
        $pusher->trigger('chat-channel', 'new-message', $messageArr);

        return response()->json($messageArr);
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'user_id' => 'required|exists:users,id', // receiver id (selected in dropdown)
        ]);
        $userId = Auth::id();
        $otherUserId = $request->user_id;

        // Only fetch messages between the current user and the selected recipient for this listing
        $messages = Message::where('listing_id', $request->listing_id)
            ->where(function($q) use ($userId, $otherUserId) {
                $q->where(function($q2) use ($userId, $otherUserId) {
                    $q2->where('sender_id', $userId)
                       ->where('receiver_id', $otherUserId);
                })->orWhere(function($q2) use ($userId, $otherUserId) {
                    $q2->where('sender_id', $otherUserId)
                       ->where('receiver_id', $userId);
                });
            })
            ->orderBy('created_at')
            ->get();

        // Attach sender_role for each message (for frontend display)
        $messages = $messages->map(function($msg) {
            $msgArr = $msg->toArray();
            $msgArr['sender_role'] = $msg->sender ? $msg->sender->role : null;
            return $msgArr;
        });

        return response()->json($messages);
    }
    public function ownerIndex(Request $request)
{
    // Fetch all messages where the owner is involved (as receiver or sender), eager load sender and receiver
    $messages = Message::with(['sender', 'receiver', 'listing'])
        ->where(function($q) {
            $q->where('receiver_id', Auth::id())
              ->orWhere('sender_id', Auth::id());
        })
        ->orderBy('created_at', 'asc')
        ->get();
    // Get all unique chat partners (tenants) for the sidebar
    $userId = Auth::id();
    $tenants = collect($messages)->map(function($m) use ($userId) {
        // Only show tenants (not the owner themselves)
        return $m->sender_id == $userId ? $m->receiver : $m->sender;
    })->filter(function($user) use ($userId) {
        return $user && $user->id != $userId;
    })->unique('id')->values();

    // Send all messages to Pusher for real-time sync (optional, only if you want to broadcast all on load)
    $options = Config::get('services.pusher.options');
    $pusher = new Pusher(
        Config::get('services.pusher.key'),
        Config::get('services.pusher.secret'),
        Config::get('services.pusher.app_id'),
        $options
    );
    foreach ($messages as $msg) {
        $pusher->trigger('chat-channel', 'new-message', $msg->toArray());
    }

    return view('owner.messages.index', compact('messages', 'tenants'));
}
public function caretakerIndex(Request $request)
    {
        // Fetch all messages where the caretaker is involved (as receiver or sender), eager load sender and receiver
        $messages = Message::with(['sender', 'receiver', 'listing'])
            ->where(function($q) {
                $q->where('receiver_id', Auth::id())
                  ->orWhere('sender_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();
        // Get all unique chat partners (tenants) for the sidebar
        $userId = Auth::id();
        $tenants = collect($messages)->map(function($m) use ($userId) {
            return $m->sender_id == $userId ? $m->receiver : $m->sender;
        })->filter(function($user) use ($userId) {
            return $user && $user->id != $userId;
        })->unique('id')->values();

        return view('caretaker.messages.index', compact('messages', 'tenants'));
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
            Cache::put($cacheKey, true, now()->addSeconds(5));
        } else {
            Cache::forget($cacheKey);
        }

        // Broadcast typing event
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'host' => env('PUSHER_HOST'),
                'port' => env('PUSHER_PORT'),
                'scheme' => env('PUSHER_SCHEME', 'http'),
                'encrypted' => env('PUSHER_SCHEME') === 'https',
            ]
        );

        $pusher->trigger('chat-channel', 'user-typing', [
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'listing_id' => $request->listing_id,
            'typing' => $request->typing,
            'timestamp' => now()->toISOString()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Typing status updated'
        ]);
    }

    /**
     * Get current typing users (optional endpoint)
     */

}
