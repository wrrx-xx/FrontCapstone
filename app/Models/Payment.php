<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'billing_id',
        'amount',
        'payment_method',
        'cash_advance_amount',
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

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
    
    
    // Define the relationship with the Reservation model
    // Since there's no direct foreign key, we'll use the listing_id to find the associated reservation
    public function reservation()
    {
        // Assuming a listing can have only one active reservation
        return $this->hasOneThrough(
            Reservation::class,
            Listing::class,
            'id', // Foreign key on listings table
            'listing_id', // Foreign key on reservations table
            'listing_id', // Local key on payments table
            'id' // Local key on listings table
        );
    }
    public function billing()
{
    return $this->hasOne(Billings::class);
}

}
