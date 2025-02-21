<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caretaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'fname', 
        'mname',
        'lname',
        'email',
        'phone_number'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
