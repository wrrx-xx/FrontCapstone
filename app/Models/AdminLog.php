<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $fillable = [
        'admin_id',
        'action',
        'model_type',
        'model_id',
        'details',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'details' => 'array'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function model()
    {
        return $this->morphTo();
    }
} 