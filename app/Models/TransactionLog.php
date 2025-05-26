<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'billing_id',
        'user_id',
        'processed_by',
        'amount',
        'cash_advance_amount',
        'cash_advance_used',
        'payment_method',
        'reference_number',
        'status',
        'action_type',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'cash_advance_amount' => 'decimal:2',
        'cash_advance_used' => 'decimal:2',
    ];

    // Relationships
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function billing()
    {
        return $this->belongsTo(Billings::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
} 