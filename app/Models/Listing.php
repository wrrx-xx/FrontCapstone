<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',
        'title',
        'body',
        'price',
        'address',
        'baranggay',
        'city',
        'type',
        'availability',
        'reservation',
        'reservation_amount',
        'waiver_file',
        'map_link',
        'tenant_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function message()
    {
        return $this->hasMany(Messages::class);
    }
    public function view()
    {
        return $this->hasMany(Viewing::class, 'listing_id');
    }
    public function photos()
    {
        return $this->hasMany(Photos::class);
    }                                   
    public function amenities()
    {
        return $this->hasOne(Amenities::class);
    }
    public function billings()
    {
        return $this->hasMany(Billings::class, 'listing_id');
    }
    public function tenant(){
        return $this->belongsTo(User::class, 'tenant_id');
    }
}
