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
                        <i class="fas fa-building me-2"></i>Admin Payment Management
                    </h2>
                    <p class="text-muted">Manage all owners' listings, billings, and payment records</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#revenueModal">
                        <i class="fas fa-chart-line me-1"></i> Overall Revenue Summary
                    </button>
                </div>
            </div>

            <!-- Dashboard Stats -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 rounded-3 bg-white h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                <i class="fas fa-users text-primary fs-3"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">{{ $owners->count() }}</h3>
                                <p class="text-muted mb-0">Total Owners</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 rounded-3 bg-white h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                <i class="fas fa-home text-success fs-3"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">
                                    {{ $owners->sum(function ($owner) {return $owner->listing->count();}) }}</h3>
                                <p class="text-muted mb-0">Total Properties</p>
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
                                <h3 class="mb-0 fw-bold">
                                    {{ $owners->sum(function ($owner) {
                                        return $owner->listing->sum(function ($listing) {
                                            return $listing->billings->where('status', 'pending')->count();
                                        });
                                    }) }}
                                </h3>
                                <p class="text-muted mb-0">Pending Payments</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 rounded-3 bg-white h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                                <i class="fas fa-money-bill-wave text-info fs-3"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">
                                    ₱{{ number_format(
                                        $owners->sum(function ($owner) {
                                            return $owner->listing->sum(function ($listing) {
                                                return $listing->billings->where('status', 'paid')->sum('amount');
                                            });
                                        }),
                                        2,
                                    ) }}
                                </h3>
                                <p class="text-muted mb-0">Total Revenue</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Owners List -->
            <div class="row">
                @foreach ($owners as $owner)
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 bg-white">
                            <div class="card-header bg-transparent border-0 py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h4 class="mb-0 fw-bold text-primary">
                                            <i class="fas fa-user me-2"></i>{{ $owner->fname }} {{ $owner->lname }}
                                        </h4>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-envelope me-1"></i> {{ $owner->email }}
                                            <span class="ms-3">
                                                <i class="fas fa-building me-1"></i> {{ $owner->listing->count() }}
                                                Properties
                                            </span>
                                        </p>
                                    </div>
                                   
                                </div>
                            </div>

                           <div class="scrollable" id="ownerDetails-{{ $owner->id }}">
                                <div class="card-body pt-0">
                                    <div class="row g-4">
                                        @foreach ($owner->listing as $listing)
                                            <div class="col-12">
                                                <div
                                                    class="card shadow-sm border-0 rounded-3 bg-white h-100 overflow-hidden">
                                                    <div class="card-header bg-transparent py-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <h5 class="mb-0 fw-bold text-primary">
                                                                    <i
                                                                        class="fas fa-building me-2"></i>{{ $listing->title }}
                                                                </h5>
                                                                <div class="mt-2">
                                                                    @if ($listing->tenant)
                                                                        <span
                                                                            class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                                            <i class="fas fa-user me-1"></i>
                                                                            {{ $listing->tenant->fname }}
                                                                            {{ $listing->tenant->lname }}
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                                                            <i class="fas fa-home-alt me-1"></i> Vacant
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-outline-primary rounded-pill"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#listingDetails-{{ $listing->id }}">
                                                                <i class="fas fa-chevron-down me-1"></i> View Details
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="collapse" id="listingDetails-{{ $listing->id }}">
                                                        <div class="card-body pt-0">
                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-pills mb-3" id="tabs-{{ $listing->id }}"
                                                                role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link active px-4"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#billing-{{ $listing->id }}"
                                                                        type="button">
                                                                        <i class="fas fa-file-invoice-dollar me-1"></i>
                                                                        Billings
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link px-4" data-bs-toggle="tab"
                                                                        data-bs-target="#payment-{{ $listing->id }}"
                                                                        type="button">
                                                                        <i class="fas fa-money-check-alt me-1"></i> Payments
                                                                    </button>
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content">
                                                                <!-- Billing Tab -->
                                                                <div class="tab-pane fade show active"
                                                                    id="billing-{{ $listing->id }}">
                                                                    @if ($listing->billings->isEmpty())
                                                                        <div class="text-center py-5">
                                                                            <i
                                                                                class="fas fa-file-invoice text-muted fa-3x mb-3"></i>
                                                                            <p class="text-muted">No billings have been
                                                                                created yet.</p>
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
                                                                                    @foreach ($listing->billings as $billing)
                                                                                        <tr>
                                                                                            <td>{{ $billing->due_date->format('M d, Y') }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <strong>₱{{ number_format($billing->amount + $billing->utility->sum('amount'), 2) }}</strong>
                                                                                                <div
                                                                                                    class="small text-muted">
                                                                                                    Rent:
                                                                                                    ₱{{ number_format($billing->amount, 2) }}
                                                                                                    @if ($billing->utility->sum('amount') > 0)
                                                                                                        <br>Utilities:
                                                                                                        ₱{{ number_format($billing->utility->sum('amount'), 2) }}
                                                                                                    @endif
                                                                                                </div>

                                                                                                @if ($billing->utility->isNotEmpty())
                                                                                                    <a href="#"
                                                                                                        class="small"
                                                                                                        data-bs-toggle="collapse"
                                                                                                        data-bs-target="#utilities-{{ $billing->id }}">
                                                                                                        Show details <i
                                                                                                            class="fas fa-chevron-down ms-1"></i>
                                                                                                    </a>
                                                                                                    <div class="collapse mt-2"
                                                                                                        id="utilities-{{ $billing->id }}">
                                                                                                        <div
                                                                                                            class="card card-body bg-light p-2">
                                                                                                            @foreach ($billing->utility as $utility)
                                                                                                                <div
                                                                                                                    class="d-flex justify-content-between mb-1">
                                                                                                                    <span>{{ $utility->type }}</span>
                                                                                                                    <span>₱{{ number_format($utility->amount, 2) }}</span>
                                                                                                                </div>
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                @php
                                                                                                    $statusClass = match (
                                                                                                        $billing->status
                                                                                                    ) {
                                                                                                        'paid'
                                                                                                            => 'success',
                                                                                                        'failed'
                                                                                                            => 'danger',
                                                                                                        'processing'
                                                                                                            => 'info',
                                                                                                        default
                                                                                                            => 'warning',
                                                                                                    };
                                                                                                @endphp
                                                                                                <span
                                                                                                    class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} px-3 py-2 rounded-pill">
                                                                                                    @if ($billing->status === 'paid')
                                                                                                        <i
                                                                                                            class="fas fa-check-circle me-1"></i>
                                                                                                    @elseif($billing->status === 'failed')
                                                                                                        <i
                                                                                                            class="fas fa-times-circle me-1"></i>
                                                                                                    @elseif($billing->status === 'processing')
                                                                                                        <i
                                                                                                            class="fas fa-clock me-1"></i>
                                                                                                    @else
                                                                                                        <i
                                                                                                            class="fas fa-exclamation-circle me-1"></i>
                                                                                                    @endif
                                                                                                    {{ $billing->status === 'processing' ? 'Waiting for Approval' : ucfirst($billing->status) }}
                                                                                                </span>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="btn-group">
                                                                                                    @if ($billing->status == 'pending' || $billing->status == 'failed')
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-sm btn-outline-primary"
                                                                                                            data-bs-toggle="modal"
                                                                                                            data-bs-target="#addUtilityBillModal-{{ $billing->id }}">
                                                                                                            <i
                                                                                                                class="fas fa-bolt me-1"></i>
                                                                                                            Add Utility
                                                                                                        </button>
                                                                                                        <a href="{{ route('tenant.payment.create', $billing->id) }}"
                                                                                                            class="btn btn-sm btn-primary">
                                                                                                            <i
                                                                                                                class="fas fa-money-bill me-1"></i>
                                                                                                            Pay
                                                                                                        </a>
                                                                                                    @endif
                                                                                                    @if ($billing->status == 'processing')
                                                                                                        <form
                                                                                                            action="{{ route('billing.approve', $billing->id) }}"
                                                                                                            method="POST"
                                                                                                            class="d-inline">
                                                                                                            @csrf
                                                                                                            <button
                                                                                                                type="submit"
                                                                                                                class="btn btn-sm btn-success">
                                                                                                                <i
                                                                                                                    class="fas fa-check me-1"></i>
                                                                                                                Approve
                                                                                                            </button>
                                                                                                        </form>
                                                                                                        <form
                                                                                                            action="{{ route('billing.decline', $billing->id) }}"
                                                                                                            method="POST"
                                                                                                            class="d-inline ms-1">
                                                                                                            @csrf
                                                                                                            <button
                                                                                                                type="submit"
                                                                                                                class="btn btn-sm btn-danger">
                                                                                                                <i
                                                                                                                    class="fas fa-times me-1"></i>
                                                                                                                Decline
                                                                                                            </button>
                                                                                                        </form>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <!-- Payments Tab -->
                                                                <div class="tab-pane fade" id="payment-{{ $listing->id }}">
    @php 
        // Get all payments associated with this listing's billings
        $listingPayments = $listing->billings()
            ->with('payment')
            ->whereHas('payment')
            ->get()
            ->pluck('payment')
            ->filter();
    @endphp
    
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
                        <th>Method</th>
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
                                    $totalAmount = $payment->amount + ($payment->cash_advance_amount ?? 0);
                                @endphp
                                <strong>₱{{ number_format($totalAmount, 2) }}</strong>
                                @if ($payment->cash_advance_amount > 0)
                                    <div class="small text-muted">
                                        Rent: ₱{{ number_format($payment->amount, 2) }}
                                        <br>
                                        Cash Advance: ₱{{ number_format($payment->cash_advance_amount, 2) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info px-3 py-2">
                                    {{ ucfirst($payment->payment_method) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusClass = match($payment->status) {
                                        'completed' => 'success',
                                        'failed' => 'danger',
                                        default => 'warning'
                                    };
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
                                <div class="btn-group">
                                    <a href="{{ route('receipt.download', $payment->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download me-1"></i> Receipt
                                    </a>
                                    @if ($payment->screenshot)
                                        <button type="button" class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#viewScreenshotModal-{{ $payment->id }}">
                                            <i class="fas fa-image me-1"></i> View Proof
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Screenshot Modal -->
@foreach ($listingPayments as $payment)
    @if ($payment->screenshot)
        <div class="modal fade" id="viewScreenshotModal-{{ $payment->id }}" 
             tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment Proof</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $payment->screenshot) }}" 
                             class="img-fluid rounded" alt="Payment Screenshot">
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Utility Bill Modal -->
            @foreach ($owners as $owner)
                @foreach ($owner->listing as $listing)
                    @foreach ($listing->billings as $billing)
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="type-{{ $billing->id }}" class="form-label">Utility Type</label>
                                            <select name="type" id="type-{{ $billing->id }}" class="form-select"
                                                required onchange="toggleCustomUtilityType(this, {{ $billing->id }})">
                                                <option value="" disabled selected>Select Utility Type</option>
                                                <option value="electricity">Electricity</option>
                                                <option value="water">Water</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <input type="text" name="custom_type"
                                                id="custom_type_{{ $billing->id }}" class="form-control mt-2"
                                                placeholder="Enter custom utility type" style="display:none;">
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
                                                <input type="number" step="0.01" name="amount"
                                                    id="amount-{{ $billing->id }}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="reading-{{ $billing->id }}" class="form-label">Reading
                                                (optional)</label>
                                            <input type="text" name="reading" id="reading-{{ $billing->id }}"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="status-{{ $billing->id }}" class="form-label">Status</label>
                                            <select name="status" id="status-{{ $billing->id }}" class="form-select"
                                                required>
                                                <option value="pending" selected>Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="failed">Failed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Add Utility Bill
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
             @if (session('success') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new bootstrap.Modal(document.getElementById('feedbackModal')).show();
        });
        
    </script>
    
@endif<!-- Row 
        @endsection
