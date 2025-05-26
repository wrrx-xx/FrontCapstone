<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class Billings extends Model

{

    use HasFactory;


    protected $fillable = [

        'user_id',

        'listing_id',

        'amount',

        'due_date',

        'status',

    ];
    protected $casts = [
        'due_date' => 'datetime',
    ];


    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');

    }


    // Define the relationship with the Listing model

    public function listing()
    {

        return $this->belongsTo(Listing::class, 'listing_id');

    }
    public function utility(){
        return $this->hasMany(UtilityBill::class,'billing_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    
    /**
     * Check if the billing is overdue
     * 
     * @return bool
     */
    public function isOverdue()
    {
        return $this->status === 'pending' && $this->due_date->isPast();
    }

    /**
     * Get the total amount including utilities
     * 
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->amount + $this->utility->sum('amount');
    }

    /**
     * Get the number of days overdue
     * 
     * @return int|null
     */
    public function getDaysOverdue()
    {
        if ($this->isOverdue()) {
            return now()->diffInDays($this->due_date);
        }
        return null;
    }
}