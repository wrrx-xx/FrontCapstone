<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'listing_id',
        'category',
        'priority',
        'title',
        'description',
        'photo_path',
        'preferred_schedule',
        'status',
        'remarks',
    'proof_of_work_path',
        'assigned_caretaker_id',
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function assignedCaretaker()
    {
        return $this->belongsTo(User::class, 'assigned_caretaker_id');
    }
}
