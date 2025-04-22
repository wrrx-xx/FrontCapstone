<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_id',
        'type',
        'amount',
        'reading',
        'status',
    ];

    public function billing()
    {
        return $this->belongsTo(Billings::class); // Corrected the reference to Billing model
    }
}
