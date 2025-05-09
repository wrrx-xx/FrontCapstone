<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Viewing extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'requested_by',
        'viewing_date',
        'viewing_time',
        'viewing_status'
    ];

    public function  listing(){
    return $this->belongsTo(Listing::class, 'listing_id');
    }
    public function requestedBy(){
        return $this->belongsTo(User::class,'requested_by');
    }

    public static function getPendingCount()
    {
        $user = Auth::user();
        // Determine owner ID based on user role
        $userId = $user->role === 'caretaker' ? $user->owner_id : $user->id;
        
        return self::whereHas('listing', function ($query) use ($userId) {
            $query->where('owner_id', $userId);
        })
        ->where('viewing_status', 'pending')
        ->count();
    }
}
