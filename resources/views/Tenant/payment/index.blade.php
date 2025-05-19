@extends('layouts.app')

@section('content')
<div class="main-content py-4">
    {{-- Feedback Modal --}}
    @if (session('success') || $errors->any())
        @include('components.feedback-modal')
    @endif

    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="border-bottom pb-3 mb-4">
                    <i class="fas fa-money-bill-wave me-2"></i>My Payments
                </h2>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="mb-5">
            <h3 class="h4 mb-3"><i class="fas fa-chart-pie me-2"></i>Payment Summary</h3>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                <i class="fas fa-wallet text-success fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="card-subtitle text-muted mb-1">Total Amount Paid</h6>
                                <h4 class="card-title text-success mb-0">₱{{ number_format($payments->sum('amount'), 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                                <i class="fas fa-hand-holding-usd text-info fa-2x"></i>
                            </div>
                            <div>
                                @php
                                    $totalCashAdvance = $payments->where('status', 'completed')->sum('cash_advance_amount');
                                    $totalCashAdvanceUsed = $payments->where('status', 'completed')->sum('cash_advance_used');
                                    $availableCashAdvance = $totalCashAdvance - $totalCashAdvanceUsed;
                                @endphp
                                <div>
                                    <h6 class="card-subtitle text-muted mb-1">Available Cash Advance</h6>
                                    <h4 class="card-title text-info mb-0">₱{{ number_format($availableCashAdvance, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                                <i class="fas fa-clock text-warning fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="card-subtitle text-muted mb-1">Pending Payments</h6>
                                <h4 class="card-title text-warning mb-0">{{ $billings->where('status', 'pending')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Billings Table --}}
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h4 mb-0"><i class="fas fa-file-invoice-dollar me-2"></i>Billings</h3>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="billingFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="billingFilterDropdown">
                        <li><a class="dropdown-item" href="#">All Billings</a></li>
                        <li><a class="dropdown-item" href="#">Pending</a></li>
                        <li><a class="dropdown-item" href="#">Completed</a></li>
                        <li><a class="dropdown-item" href="#">Failed</a></li>
                    </ul>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Listing</th>
                                    <th class="px-4 py-3">Due Date</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Utilities</th>
                                    <th class="px-4 py-3">Total Amount</th>
                                    <th class="px-4 py-3 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($billings as $billing)
                                @php
                                    $utilityTotal = $billing->utility->sum('amount');
                                    $grandTotal = $billing->amount + $utilityTotal;
                                @endphp
                                <tr class="align-middle">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2">
                                                <i class="fas fa-home text-secondary"></i>
                                            </div>
                                            <div>
                                                {{ $billing->listing->title ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge {{ \Carbon\Carbon::parse($billing->due_date)->isPast() ? 'bg-danger' : 'bg-info' }}">
                                            {{ $billing->due_date->format('F j, Y') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($billing->status === 'pending')
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-exclamation-circle me-1"></i>Pending
                                            </span>
                                        @elseif ($billing->status === 'processing')
                                            <span class="badge bg-primary">
                                                <i class="fas fa-spinner fa-spin me-1"></i>Processing
                                            </span>
                                        @elseif ($billing->status === 'completed')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Completed
                                            </span>
                                        @elseif ($billing->status === 'failed')
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>Failed
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-info-circle me-1"></i>{{ ucfirst($billing->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($billing->utility->count() > 0)
                                            <div class="utility-list">
                                                @foreach ($billing->utility as $utility)
                                                    <div class="d-flex align-items-center mb-1">
                                                        @if($utility->type == 'electricity')
                                                            <i class="fas fa-bolt text-warning me-1"></i>
                                                        @elseif($utility->type == 'water')
                                                            <i class="fas fa-tint text-primary me-1"></i>
                                                        @elseif($utility->type == 'internet')
                                                            <i class="fas fa-wifi text-info me-1"></i>
                                                        @else
                                                            <i class="fas fa-file-invoice text-secondary me-1"></i>
                                                        @endif
                                                        <small>{{ ucfirst($utility->type) }}: <span class="fw-bold">₱{{ number_format($utility->amount, 2) }}</span></small>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <small class="text-muted">No utilities</small>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-bold">₱{{ number_format($grandTotal, 2) }}</div>
                                        <small class="text-muted">
                                            Rent: ₱{{ number_format($billing->amount, 2) }}
                                            @if($utilityTotal > 0)
                                                <br>Utilities: ₱{{ number_format($utilityTotal, 2) }}
                                            @endif
                                        </small>
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if (in_array($billing->status, ['pending', 'failed']))
                                                <form action="{{ route('tenant.payment.create', $billing->id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Pay Now">
                                                        <i class="fas fa-credit-card me-1"></i>Pay Now
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-file-invoice fa-3x mb-3"></i>
                                            <p>No billing records found</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment History --}}
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h4 mb-0"><i class="fas fa-history me-2"></i>Payment History</h3>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="paymentFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="paymentFilterDropdown">
                        <li><a class="dropdown-item" href="#">All Payments</a></li>
                        <li><a class="dropdown-item" href="#">Completed</a></li>
                        <li><a class="dropdown-item" href="#">Pending</a></li>
                        <li><a class="dropdown-item" href="#">Failed</a></li>
                    </ul>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Transaction ID</th>
                                    <th class="px-4 py-3">Amount</th>
                                    <th class="px-4 py-3">Method</th>
                                    <th class="px-4 py-3">Cash Advance</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-end">Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                <tr class="align-middle">
                                    <td class="px-4 py-3">
                                        <small class="text-monospace">{{ substr($payment->id, 0, 10) }}...</small>
                                    </td>
                                    <td class="px-4 py-3 fw-bold">₱{{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-4 py-3">
                                        @if($payment->payment_method == 'gcash')
                                            <i class="fas fa-university text-primary me-1"></i>
                                        @elseif($payment->payment_method == 'credit')
                                            <i class="far fa-credit-card text-success me-1"></i>
                                        @elseif($payment->payment_method == 'cash')
                                            <i class="fas fa-money-bill-wave text-warning me-1"></i>
                                        @else
                                            <i class="fas fa-money-bill-alt text-secondary me-1"></i>
                                        @endif
                                        {{ ucfirst($payment->payment_method) }}
                                    </td>
                                    <td class="px-4 py-3">₱{{ number_format($payment->cash_advance_amount, 2) }}</td>
                                    <td class="px-4 py-3">{{ $payment->created_at->format('F j, Y') }}</td>
                                    <td class="px-4 py-3">
                                        @if ($payment->status === 'pending')
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-spinner fa-spin me-1"></i>Pending
                                            </span>
                                        @elseif ($payment->status === 'completed')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Completed
                                            </span>
                                        @elseif ($payment->status === 'failed')
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>Failed
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-info-circle me-1"></i>{{ ucfirst($payment->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        @if($payment->status === 'completed')
                                        <a href="{{ route('receipt.download', $payment->id) }}" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Download Receipt">
                                            <i class="fas fa-download me-1"></i>Receipt
                                        </a>
                                        @else
                                        <span class="text-muted">
                                            <i class="fas fa-receipt me-1"></i>Unavailable
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-history fa-3x mb-3"></i>
                                            <p>No payment history found</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Auto-trigger modal on page load --}}
    @if (session('success') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new bootstrap.Modal(document.getElementById('feedbackModal')).show();
            
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @else
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @endif
</div>
@endsection