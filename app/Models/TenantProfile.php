<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'current_address',
        'employment_status',
        'monthly_income',
        'emergency_contact_name',
        'emergency_contact_phone',
        'valid_id_type',
        'valid_id_front_path',
        'valid_id_back_path',
    ];

    /**
     * Get the user associated with the tenant profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}