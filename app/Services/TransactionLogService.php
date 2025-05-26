<?php

namespace App\Services;

use App\Models\TransactionLog;
use App\Models\Payment;
use App\Models\Billings;
use Illuminate\Support\Facades\Auth;

class TransactionLogService
{
    /**
     * Log a payment transaction
     */
    public function logPayment(Payment $payment, string $actionType, ?string $notes = null): TransactionLog
    {
        return TransactionLog::create([
            'payment_id' => $payment->id,
            'billing_id' => $payment->billing_id,
            'user_id' => $payment->listing->tenant_id,
            'processed_by' => Auth::id(),
            'amount' => $payment->amount,
            'cash_advance_amount' => $payment->cash_advance_amount,
            'cash_advance_used' => $payment->cash_advance_used,
            'payment_method' => $payment->payment_method,
            'reference_number' => $payment->reference_number,
            'status' => $payment->status,
            'action_type' => $actionType,
            'notes' => $notes
        ]);
    }

    /**
     * Log a billing transaction
     */
    public function logBilling(Billings $billing, string $actionType, ?string $notes = null): TransactionLog
    {
        return TransactionLog::create([
            'billing_id' => $billing->id,
            'user_id' => $billing->user_id,
            'processed_by' => Auth::id(),
            'amount' => $billing->amount,
            'status' => $billing->status,
            'action_type' => $actionType,
            'notes' => $notes
        ]);
    }

    /**
     * Get transaction logs with filters
     */
    public function getTransactionLogs(array $filters = [])
    {
        $query = TransactionLog::with(['user', 'processor', 'payment', 'billing']);

        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['action_type'])) {
            $query->where('action_type', $filters['action_type']);
        }

        if (isset($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }
} 