@extends('layouts.app')

@section('content')
<div class="main-content bg-light">
    <div class="container py-5">
        @if (session('success') || $errors->any())
            <!-- Feedback Modal -->
            @include('components.feedback-modal')
        @endif

        <div class="row mb-4 align-items-center">
            <div class="col">
                <h2 class="fw-bold text-primary mb-0">
                    <i class="fas fa-building me-2"></i>Billings and Payment
                </h2>
                <p class="text-muted">Manage your listings, billings, and payment records</p>
            </div>
            @if (!Auth::user()->isCaretaker())
            <div class="col-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#revenueModal">
                    <i class="fas fa-chart-line me-1"></i> Revenue Summary
                </button>
            </div>
            @endif
        </div>

        <!-- Unpaid Billings Section -->
        @if (!Auth::user()->isCaretaker())
        <div class="row mb-4">
            <div class="col-12">
                <x-unpaid-billings :listings="$listings" />
            </div>
        </div>
        @endif

        <!-- Dashboard Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3 bg-white h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-home text-primary fs-3"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $listings->count() }}</h3>
                            <p class="text-muted mb-0">Total Properties</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3 bg-white h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-user-check text-success fs-3"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $listings->where('tenant', '!=', null)->count() }}</h3>
                            <p class="text-muted mb-0">Occupied Units</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3 bg-white h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="fas fa-exclamation-triangle text-warning fs-3"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $billings->where('status', 'pending')->count() }}</h3>
                            <p class="text-muted mb-0">Pending Payments</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3 bg-white h-100">
                    <div class="card-body d-flex align-items-center">
                        @if (!Auth::user()->isCaretaker())
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-money-bill-wave text-info fs-3"></i>
                        </div>
                        
                        <div>
                            <h3 class="mb-0 fw-bold">{{ number_format($payments->where('status', 'completed')->sum('amount'), 2) }}</h3>
                            <p class="text-muted mb-0">Total Revenue</p>
                        </div>
                        @endif  
                    </div>
                </div>
            </div>
        </div>

        <!-- Properties -->
        <div class="row g-4">
            @foreach ($listings as $listing)
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0 rounded-3 bg-white h-100 overflow-hidden">
                        <div class="card-header bg-transparent border-0 py-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h4 class="mb-0 fw-bold text-primary">
                                        <i class="fas fa-building me-2"></i>{{ $listing->title }}
                                    </h4>
                                    <div class="mt-2 d-flex align-items-center">
                                        @if ($listing->tenant)
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                <i class="fas fa-user me-1"></i> {{ $listing->tenant->fname }} {{ $listing->tenant->lname }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                                <i class="fas fa-home-alt me-1"></i> Vacant
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button class="btn btn-outline-primary rounded-pill" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#listingDetails-{{ $listing->id }}">
                                    <i class="fas fa-chevron-down me-1"></i> View Details
                                </button>
                            </div>
                        </div>

                        <div class="collapse" id="listingDetails-{{ $listing->id }}">
                            <div class="card-body pt-0">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills mb-3" id="tab-{{ $listing->id }}" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active px-4" id="billing-tab-{{ $listing->id }}"
                                            data-bs-toggle="tab" data-bs-target="#billing-{{ $listing->id }}"
                                            type="button" role="tab">
                                            <i class="fas fa-file-invoice-dollar me-1"></i> Billings
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link px-4" id="payment-tab-{{ $listing->id }}"
                                            data-bs-toggle="tab" data-bs-target="#payment-{{ $listing->id }}"
                                            type="button" role="tab">
                                            <i class="fas fa-money-check-alt me-1"></i> Payments
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content overflow-auto" id="tabs-content-{{ $listing->id }}"
                                    style="max-height: 450px;">

                                    <!-- Billing Tab -->
                                    <div class="tab-pane fade show active" id="billing-{{ $listing->id }}" role="tabpanel">
                                        @php $listingBillings = $billings->where('listing_id', $listing->id); @endphp

                                        @if ($listingBillings->isEmpty())
                                            <div class="text-center py-5">
                                                <i class="fas fa-file-invoice text-muted fa-3x mb-3"></i>
                                                <p class="text-muted">No billings have been created yet.</p>
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-plus me-1"></i> Create Billing
                                                </button>
                                            </div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Due Date</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($listingBillings as $billing)
                                                            <tr>
                                                                <td>{{ $billing->due_date->format('M d, Y') }}</td>
                                                                <td>
                                                                    <strong>₱{{ number_format($billing->amount + $billing->utility->sum('amount'), 2) }}</strong>
                                                                    <div class="small text-muted">
                                                                        Rent: ₱{{ number_format($billing->amount, 2) }}
                                                                        @if ($billing->utility->sum('amount') > 0)
                                                                            <br>Utilities: ₱{{ number_format($billing->utility->sum('amount'), 2) }}
                                                                        @endif
                                                                    </div>
                                                                    
                                                                    @if ($billing->utility->isNotEmpty())
                                                                        <a href="#" class="small" data-bs-toggle="collapse" data-bs-target="#utilities-{{ $billing->id }}">
                                                                            Show details <i class="fas fa-chevron-down ms-1"></i>
                                                                        </a>
                                                                        <div class="collapse mt-2" id="utilities-{{ $billing->id }}">
                                                                            <div class="card card-body bg-light p-2">
                                                                                @foreach ($billing->utility as $utility)
                                                                                    <div class="d-flex justify-content-between mb-1">
                                                                                        <span>{{ $utility->type ?? 'Utility' }}</span>
                                                                                        <span>₱{{ number_format($utility->amount, 2) }}</span>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $statusClass = 'warning';
                                                                        if ($billing->status === 'paid') {
                                                                            $statusClass = 'success';
                                                                        } elseif ($billing->status === 'failed') {
                                                                            $statusClass = 'danger';
                                                                        } elseif ($billing->status === 'processing') {
                                                                            $statusClass = 'info';
                                                                        }
                                                                    @endphp
                                                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} px-3 py-2 rounded-pill">
                                                                        @if ($billing->status === 'paid')
                                                                            <i class="fas fa-check-circle me-1"></i>
                                                                        @elseif ($billing->status === 'failed')
                                                                            <i class="fas fa-times-circle me-1"></i>
                                                                        @elseif ($billing->status === 'processing')
                                                                            <i class="fas fa-clock me-1"></i>
                                                                        @else
                                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                                        @endif
                                                                        {{ $billing->status === 'processing' ? 'Waiting for Approval' : ucfirst($billing->status) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        @if (in_array(Auth::user()->role, ['owner', 'caretaker','admin']) &&
                                                                                ($billing->status == 'pending' || $billing->status == 'failed'))
                                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                                data-bs-toggle="modal" data-bs-target="#addUtilityBillModal-{{ $billing->id }}">
                                                                                <i class="fas fa-bolt me-1"></i> Add Utility
                                                                            </button>
                                                                            <a href="{{ route('tenant.payment.create', $billing->id) }}" class="btn btn-sm btn-primary">
                                                                                <i class="fas fa-money-bill me-1"></i> Pay
                                                                            </a>
                                                                        @endif
                                                                        
                                                                        @if ($billing->status == 'processing')
                                                                            <div class="btn-group">
                                                                                <form action="{{ route('billing.approve', $billing->id) }}" method="POST" class="d-inline">
                                                                                    @csrf
                                                                                    <button type="submit" class="btn btn-success btn-sm">
                                                                                        <i class="fas fa-check me-1"></i> Approve
                                                                                    </button>
                                                                                </form>
                                                                                <form action="{{ route('billing.decline', $billing->id) }}" method="POST" class="d-inline ms-1">
                                                                                    @csrf
                                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                                        <i class="fas fa-times me-1"></i> Decline
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        
                                        <!-- Utility Bill Modal -->
                                        @foreach ($listingBillings as $billing)
                                            <div class="modal fade" id="addUtilityBillModal-{{ $billing->id }}" tabindex="-1"
                                                aria-labelledby="addUtilityBillModalLabel-{{ $billing->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('utilitybill.store') }}" method="POST" class="modal-content">
                                                        @csrf
                                                        <input type="hidden" name="billing_id" value="{{ $billing->id }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addUtilityBillModalLabel-{{ $billing->id }}">
                                                                <i class="fas fa-bolt me-2"></i>Add Utility Bill
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="type-{{ $billing->id }}" class="form-label">Utility Type</label>
                                                                <select name="type" id="type-{{ $billing->id }}" class="form-select" required onchange="toggleCustomUtilityType(this, {{ $billing->id }})">
                                                                    <option value="" disabled selected>Select Utility Type</option>
                                                                    <option value="electricity">Electricity</option>
                                                                    <option value="water">Water</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                                <input type="text" name="custom_type" id="custom_type_{{ $billing->id }}" class="form-control mt-2" placeholder="Enter custom utility type" style="display:none;">
                                                            </div>
                                                            
                                                            <script>
                                                                function toggleCustomUtilityType(selectElem, billingId) {
                                                                    var customInput = document.getElementById('custom_type_' + billingId);
                                                                    if (selectElem.value === 'other') {
                                                                        customInput.style.display = 'block';
                                                                        customInput.required = true;
                                                                    } else {
                                                                        customInput.style.display = 'none';
                                                                        customInput.required = false;
                                                                    }
                                                                }
                                                            </script>
                                                            
                                                            <div class="mb-3">
                                                                <label for="amount-{{ $billing->id }}" class="form-label">Amount</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">₱</span>
                                                                    <input type="number" step="0.01" name="amount" id="amount-{{ $billing->id }}" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="reading-{{ $billing->id }}" class="form-label">Reading (optional)</label>
                                                                <input type="text" name="reading" id="reading-{{ $billing->id }}" class="form-control">
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="status-{{ $billing->id }}" class="form-label">Status</label>
                                                                <select name="status" id="status-{{ $billing->id }}" class="form-select" required>
                                                                    <option value="pending" selected>Pending</option>
                                                                    <option value="paid">Paid</option>
                                                                    <option value="failed">Failed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-save me-1"></i> Add Utility Bill
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Payments Tab -->
                                    <div class="tab-pane fade" id="payment-{{ $listing->id }}" role="tabpanel">
                                        @php $listingPayments = $payments->where('listing_id', $listing->id); @endphp
                                        
                                        @if ($listingPayments->isEmpty())
                                            <div class="text-center py-5">
                                                <i class="fas fa-money-check-alt text-muted fa-3x mb-3"></i>
                                                <p class="text-muted">No payments have been recorded yet.</p>
                                            </div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($listingPayments as $payment)
                                                            <tr>
                                                                <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                                                <td>
                                                                    @php
                                                                        $totalAmount = $payment->amount + $payment->cash_advance_amount;
                                                                    @endphp
                                                                    <strong>₱{{ number_format($payment->amount, 2) }}</strong>
                                                                    @if ($payment->cash_advance_amount > 0)
                                                                        <div class="small text-muted">

                                                                            Cash Advance: ₱{{ number_format($payment->cash_advance_amount, 2) }}
                                                                            <br>
                                                                            Rent: ₱{{ number_format($payment->listing->price, 2) }}
                                                                            <br>
                                                                            Reservation: ₱{{ number_format($payment->reservation_amount, 2) }}
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $statusClass = 'warning';
                                                                        if ($payment->status === 'completed') {
                                                                            $statusClass = 'success';
                                                                        } elseif ($payment->status === 'failed') {
                                                                            $statusClass = 'danger';
                                                                        }
                                                                    @endphp
                                                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} px-3 py-2 rounded-pill">
                                                                        @if ($payment->status === 'completed')
                                                                            <i class="fas fa-check-circle me-1"></i>
                                                                        @elseif ($payment->status === 'failed')
                                                                            <i class="fas fa-times-circle me-1"></i>
                                                                        @else
                                                                            <i class="fas fa-clock me-1"></i>
                                                                        @endif
                                                                        {{ ucfirst($payment->status) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('receipt.download', $payment->id) }}" class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-download me-1"></i> Receipt
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Revenue Summary Modal -->
<div class="modal fade" id="revenueModal" tabindex="-1" aria-labelledby="revenueModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="revenueModalLabel">
                    <i class="fas fa-chart-bar me-2"></i>Revenue Summary
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <canvas id="revenueChart" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-transparent">
                                <h6 class="mb-0">Revenue by Property</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    @foreach ($listings as $listing)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $listing->title }}
                                            <span class="badge bg-primary rounded-pill">
                                                ₱{{ number_format($payments->where('listing_id', $listing->id)->where('status', 'completed')->sum('amount'), 2) }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent">
                                <h6 class="mb-0">Outstanding Payments</h6>
                            </div>
                            <div class="card-body">
                                <h3 class="text-danger mb-0">
                                    ₱{{ number_format($billings->where('status', 'pending')->sum('amount') + $billings->where('status', 'pending')->sum(function($bill) { return $bill->utility->sum('amount'); }), 2) }}
                                </h3>
                                <p class="text-muted mb-0">Total pending amount</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-file-export me-1"></i> Export Report
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Show modal on load if needed -->
@if (session('success') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new bootstrap.Modal(document.getElementById('feedbackModal')).show();
        });
    </script>
@endif

<!-- Revenue Chart Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    var ctx = document.getElementById('revenueChart');
    if (ctx) {
        // Get the monthly revenue data from PHP
        var monthlyRevenue = @json($monthlyRevenue);
        var months = Object.keys(monthlyRevenue);
        var revenues = Object.values(monthlyRevenue);
        
        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: revenues,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₱' + context.raw.toLocaleString(undefined, {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection