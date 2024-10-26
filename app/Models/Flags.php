<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flags extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'flagged_by',
        'flag_reason',
        'flag_status',
        'flag_admin_note'
    ];

    public function flagBy(){
        return $this->belongsTo(User::class,  'flagged_by');
    }
    public function List(){
        return $this->belongsTo(Listing::class,   'listing_id');
    }
}
