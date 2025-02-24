<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'business_address',
        'business_phone',
        'business_email',
        'owner_id_type',
        'owner_id_front_path',
        'owner_id_back_path',
        'additional_info',
        'approved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
