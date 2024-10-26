<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'listing_id',
        'wifi',
        'parking',
        'bathroom',
        'kitchen',
        'laundry',
        'gym',
        'projector_room',
        'back_yard',
        'front_yard',
        'attached_garage',
        'pool',
        'elevator',
        'school',
        'transportation_hub',
        'super_market',
        'clinic',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
