<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'requested_by',
        'request_title',
        'request_body',
        'request_status',
    ];

    public function  requestedBy(){
        return $this->belongsTo(User::class,'requested_by');
    }
}
