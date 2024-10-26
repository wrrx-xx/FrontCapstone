<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiries extends Model
{
    use HasFactory;
    protected $fillable = [
        'listing_id',
        'inquiry_status',
    ];

    public function List(){
        return $this->belongsTo(Listing::class,'listing_id');
    }
}
