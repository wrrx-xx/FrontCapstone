@extends('layouts.admin-navigation')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Payment Details</h1>
        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Sales Report
        </a>
    </div>

    <div class="row">
        <!-- Payment Information -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Payment Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Payment ID:</strong> {{ $payment->id }}</p>
                            <p><strong>Amount:</strong> ₱{{ number_format($payment->amount, 2) }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge bg-{{ $payment->status === 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </p>
                            <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
                            <p><strong>Reference Number:</strong> {{ $payment->reference_number ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date Created:</strong> {{ $payment->created_at->format('M d, Y H:i:s') }}</p>
                            <p><strong>Last Updated:</strong> {{ $payment->updated_at->format('M d, Y H:i:s') }}</p>
                            <p><strong>Processed By:</strong> {{ $payment->processor ? $payment->processor->fname . ' ' . $payment->processor->lname : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-home me-1"></i>
                    Property Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Property Title:</strong> {{ $payment->listing->title }}</p>
                            <p><strong>Property Type:</strong> {{ ucfirst($payment->listing->type) }}</p>
                            <p><strong>Address:</strong> {{ $payment->listing->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Owner:</strong> {{ $payment->listing->user->fname }} {{ $payment->listing->user->lname }}</p>
                            <p><strong>Tenant:</strong> {{ $payment->listing->tenant ? $payment->listing->tenant->fname . ' ' . $payment->listing->tenant->lname : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billing Information -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-invoice-dollar me-1"></i>
                    Billing Information
                </div>
                <div class="card-body">
                    @if($payment->billing)
                        <p><strong>Billing ID:</strong> {{ $payment->billing->id }}</p>
                        <p><strong>Due Date:</strong> {{ $payment->billing->due_date->format('M d, Y') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $payment->billing->status === 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($payment->billing->status) }}
                            </span>
                        </p>
                        
                        @if($payment->billing->utility->count() > 0)
                            <hr>
                            <h6>Utility Bills</h6>
                            @foreach($payment->billing->utility as $utility)
                                <p class="mb-1">
                                    <strong>{{ ucfirst($utility->type) }}:</strong>
                                    ₱{{ number_format($utility->amount, 2) }}
                                </p>
                            @endforeach
                        @endif
                    @else
                        <p class="text-muted">No billing information available.</p>
                    @endif
                </div>
            </div>

            <!-- Payment Screenshot -->
            @if($payment->screenshot)
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-image me-1"></i>
                        Payment Screenshot
                    </div>
                    <div class="card-body">
                        <img src="{{ asset($payment->screenshot) }}" alt="Payment Screenshot" class="img-fluid">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 