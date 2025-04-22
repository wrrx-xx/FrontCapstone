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
    
}