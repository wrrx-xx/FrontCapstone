<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function  requestedBy(){
        return $this->belongsTo(User::class,'requested_by');
        }
}
