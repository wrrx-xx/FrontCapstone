@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaction Log Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.transaction-logs.index') }}" class="btn btn-sm btn-default">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Transaction Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Transaction ID</th>
                                    <td>{{ $transactionLog->id }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge badge-{{ $transactionLog->status == 'completed' ? 'success' : ($transactionLog->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($transactionLog->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action Type</th>
                                    <td>{{ str_replace('_', ' ', ucfirst($transactionLog->action_type)) }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>₱{{ number_format($transactionLog->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>{{ ucfirst($transactionLog->payment_method) }}</td>
                                </tr>
                                @if($transactionLog->reference_number)
                                <tr>
                                    <th>Reference Number</th>
                                    <td>{{ $transactionLog->reference_number }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Date & Time</th>
                                    <td>{{ $transactionLog->created_at->format('F d, Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>User Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">User</th>
                                    <td>{{ $transactionLog->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Processed By</th>
                                    <td>{{ $transactionLog->processor ? $transactionLog->processor->name : 'N/A' }}</td>
                                </tr>
                            </table>

                            @if($transactionLog->cash_advance_amount)
                            <h4 class="mt-4">Cash Advance Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Cash Advance Amount</th>
                                    <td>₱{{ number_format($transactionLog->cash_advance_amount, 2) }}</td>
                                </tr>
                                @if($transactionLog->cash_advance_used)
                                <tr>
                                    <th>Cash Advance Used</th>
                                    <td>₱{{ number_format($transactionLog->cash_advance_used, 2) }}</td>
                                </tr>
                                @endif
                            </table>
                            @endif

                            @if($transactionLog->notes)
                            <h4 class="mt-4">Additional Notes</h4>
                            <div class="alert alert-info">
                                {{ $transactionLog->notes }}
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($transactionLog->payment)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Related Payment Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Payment ID</th>
                                    <td>{{ $transactionLog->payment->id }}</td>
                                </tr>
                                <tr>
                                    <th>Listing</th>
                                    <td>{{ $transactionLog->payment->listing->title ?? 'N/A' }}</td>
                                </tr>
                                @if($transactionLog->payment->screenshot)
                                <tr>
                                    <th>Payment Screenshot</th>
                                    <td>
                                        <a href="{{ Storage::url($transactionLog->payment->screenshot) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-image"></i> View Screenshot
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($transactionLog->billing)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Related Billing Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Billing ID</th>
                                    <td>{{ $transactionLog->billing->id }}</td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td>{{ $transactionLog->billing->due_date->format('F d, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Billing Status</th>
                                    <td>
                                        <span class="badge badge-{{ $transactionLog->billing->status == 'paid' ? 'success' : ($transactionLog->billing->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($transactionLog->billing->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 