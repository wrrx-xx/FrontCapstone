<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessages extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_id',
        'sender_id',
        'support_message',
    ];
    public function suppId(){
        return $this->belongsTo(Support::class,'support_id');
    }
    public function  senderId(){
        return $this->belongsTo(User::class,'sender_id');
        }
}
