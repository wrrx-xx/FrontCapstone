<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TransactionLogService;
use App\Models\User;
use App\Models\TransactionLog;
use Illuminate\Http\Request;

class TransactionLogController extends Controller
{
    protected $transactionLogService;

    public function __construct(TransactionLogService $transactionLogService)
    {
        $this->transactionLogService = $transactionLogService;
    }

    /**
     * Display a listing of transaction logs.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'user_id',
            'status',
            'action_type',
            'date_from',
            'date_to'
        ]);

        $transactionLogs = $this->transactionLogService->getTransactionLogs($filters);
        
        // Get users for the filter dropdown
        $users = User::whereIn('role', ['tenant', 'owner'])->get();

        return view('admin.transaction-logs.index', compact('transactionLogs', 'filters', 'users'));
    }

    /**
     * Display the specified transaction log.
     */
    public function show($id)
    {
        $transactionLog = TransactionLog::with(['user', 'processor', 'payment', 'billing'])
            ->findOrFail($id);

        return view('admin.transaction-logs.show', compact('transactionLog'));
    }

    /**
     * Export transaction logs to CSV
     */
    public function export(Request $request)
    {
        $filters = $request->only([
            'user_id',
            'status',
            'action_type',
            'date_from',
            'date_to'
        ]);

        $transactionLogs = $this->transactionLogService->getTransactionLogs($filters);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="transaction-logs.csv"',
        ];

        $callback = function() use ($transactionLogs) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, [
                'ID',
                'User',
                'Processor',
                'Amount',
                'Cash Advance Amount',
                'Cash Advance Used',
                'Payment Method',
                'Reference Number',
                'Status',
                'Action Type',
                'Notes',
                'Created At'
            ]);

            // Add data
            foreach ($transactionLogs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->user->name,
                    $log->processor ? $log->processor->name : 'N/A',
                    $log->amount,
                    $log->cash_advance_amount,
                    $log->cash_advance_used,
                    $log->payment_method,
                    $log->reference_number,
                    $log->status,
                    $log->action_type,
                    $log->notes,
                    $log->created_at
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
} 