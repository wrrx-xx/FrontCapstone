<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewing_id', 
        'listing_id',
        'amount',
        'cash_advance',
        'payment_method',
        'status',
    ];

    // Cast dates to Carbon instances
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Define the relationship with the Listing model
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    // Define the relationship with the Viewing model if applicable
    public function viewing()
    {
        return $this->belongsTo(Viewing::class);
    }
}
