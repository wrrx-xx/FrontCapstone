@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-bottom mb-4 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-dark">Payment Details</h1>
                <p class="text-muted mb-0">View detailed information about this payment</p>
            </div>
            <div>
                <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Back to Payments
                </a>
                <a href="{{ route('receipt.download', $payment->id) }}" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Download Receipt
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Payment Information -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Payment Information</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted d-block">Payment ID</label>
                                <span class="fw-medium">#{{ $payment->id }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted d-block">Amount</label>
                                <span class="fw-bold text-primary">₱{{ number_format($payment->amount, 2) }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted d-block">Status</label>
                                @php
                                    $statusClass = [
                                        'completed' => 'success',
                                        'pending' => 'warning',
                                        'failed' => 'danger',
                                        'overdue' => 'danger'
                                    ][$payment->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">{{ ucfirst($payment->status) }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted d-block">Date & Time</label>
                                <span class="fw-medium">{{ $payment->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted d-block">Payment Method</label>
                                <span class="fw-medium">{{ ucfirst($payment->payment_method ?? 'N/A') }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted d-block">Reference Number</label>
                                <span class="fw-medium">{{ $payment->reference_number ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Property Information</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted d-block">Property Name</label>
                                <span class="fw-medium">{{ $payment->listing->title }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted d-block">Property ID</label>
                                <span class="fw-medium">#{{ $payment->listing->id }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted d-block">Location</label>
                                <span class="fw-medium">{{ $payment->listing->address }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted d-block">Monthly Rate</label>
                                <span class="fw-medium">₱{{ number_format($payment->listing->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tenant Information -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Tenant Information</h5>
                    <div class="text-center mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <span class="h4 mb-0">
                                {{ substr($payment->listing->tenant->fname ?? 'N', 0, 1) }}{{ substr($payment->listing->tenant->lname ?? 'A', 0, 1) }}
                            </span>
                        </div>
                        <h5 class="mb-1">{{ $payment->listing->tenant->fname ?? 'N/A' }} {{ $payment->listing->tenant->lname ?? '' }}</h5>
                        <p class="text-muted mb-0">Tenant</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Email</label>
                        <span class="fw-medium">{{ $payment->listing->tenant->email ?? 'N/A' }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Phone</label>
                        <span class="fw-medium">{{ $payment->listing->tenant->phone_number ?? 'N/A' }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Move-in Date</label>
                        <span class="fw-medium">{{ $payment->listing->tenant->created_at->format('M d, Y') ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 