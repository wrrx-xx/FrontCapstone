<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model

{

    use HasFactory;


    protected $fillable = [
        'id',
        'listing_id',
        'prospect_id',
        'reservation_status',
    ];


    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    // Define the relationship with the User model (prospect)
    public function prospect()
    {
        return $this->belongsTo(User::class, 'prospect_id');
    }

}
