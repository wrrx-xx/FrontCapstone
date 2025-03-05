<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'amount',
        'payment_method',
        'reference_number',
        'screenshot',
        'status',
        'processed_by', // Added to track who processed the payment
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

    public function processed_by(){
        return $this->belongsTo(User::class, 'processed_by');
    }

}
