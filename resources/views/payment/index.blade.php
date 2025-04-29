@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container py-4">
            @if (session('success') || $errors->any())
                <!-- Feedback Modal -->
                @include('components.feedback-modal')
            @endif

            <h2 class="text-primary mb-4">My Listings & Payments</h2>

            <div class="row g-4">
                @foreach ($listings as $listing)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">{{ $listing->title }}</span>
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#listingDetails-{{ $listing->id }}">
                                        View Details
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        Tenant:
                                        @if ($listing->tenant)
                                            <span class="text-success fw-semibold">{{ $listing->tenant->fname }}
                                                {{ $listing->tenant->lname }}</span>
                                        @else
                                            <span class="text-danger">Vacant</span>
                                        @endif
                                    </small>
                                </div>
                            </div>

                            <div class="collapse" id="listingDetails-{{ $listing->id }}">
                                <div class="card-body">
                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs mb-3" id="tab-{{ $listing->id }}" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="billing-tab-{{ $listing->id }}"
                                                data-bs-toggle="tab" data-bs-target="#billing-{{ $listing->id }}"
                                                type="button" role="tab">Billings</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="payment-tab-{{ $listing->id }}"
                                                data-bs-toggle="tab" data-bs-target="#payment-{{ $listing->id }}"
                                                type="button" role="tab">Payments</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content overflow-auto" id="tabs-content-{{ $listing->id }}"
                                        style="max-height: 400px;">

                                        <!-- Billing -->
                                        <div class="tab-pane fade show active" id="billing-{{ $listing->id }}"
                                            role="tabpanel">
                                            @php $listingBillings = $billings->where('listing_id', $listing->id); @endphp

                                            @if ($listingBillings->isEmpty())
                                                <p class="text-muted">No billings yet.</p>
                                            @else
                                                @foreach ($listingBillings as $billing)
                                                    <div class="mb-3 border rounded p-2">
                                                        <p class="mb-1">
                                                            <strong>Total:</strong>
                                                            ₱{{ number_format($billing->amount + $billing->utility->sum('amount'), 2) }}
                                                            <br>
                                                            <small
                                                                class="text-muted">(₱{{ number_format($billing->amount, 2) }}
                                                                rent
                                                                @if ($billing->utility->sum('amount') > 0)
                                                                    +
                                                                    ₱{{ number_format($billing->utility->sum('amount'), 2) }}
                                                                    utilities
                                                                @endif
                                                                )
                                                                @if ($billing->utility->isNotEmpty())
                                                                    <small class="text-muted d-block mt-2">
                                                                        <span>
                                                                            @foreach ($billing->utility as $utility)
                                                                                <small class="me-2">
                                                                                   <strong> {{ $utility->type ?? 'Utility' }}:</strong>
                                                                                    ₱{{ number_format($utility->amount, 2) }}
                                                                                </small>
                                                                            @endforeach
                                                                        </span>
                                                                    </small>
                                                                @endif
                                                            </small>
                                                        </p>
                                                        <p class="mb-1"><strong>Due:</strong>
                                                            {{ $billing->due_date->format('M d, Y') }}</p>
                                                        <p class="mb-2"><strong>Status:</strong>
                                                            <span
                                                                class="badge bg-{{ $billing->status === 'paid' ? 'success' : ($billing->status === 'failed' ? 'danger' : 'warning') }}">
                                                                {{ $billing->status === 'processing' ? 'Waiting for Approval' : ucfirst($billing->status) }}
                                                            </span>
                                                        </p>
                                                        @if (in_array(Auth::user()->role, ['owner', 'caretaker']) &&
                                                                ($billing->status == 'pending' || $billing->status == 'failed'))
                                                            <!-- Add Utility Bill button and modal here -->

                                                            <!-- Button to trigger modal -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-primary mt-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#addUtilityBillModal-{{ $billing->id }}">
                                                                Add Utility Bill
                                                            </button>
                                                            <a href="{{ route('tenant.payment.create', $billing->id) }}" class="btn btn-sm btn-primary mt-2 ms-2">
                                                                Pay
                                                            </a>
                                                            

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="addUtilityBillModal-{{ $billing->id }}" tabindex="-1"
                                                                aria-labelledby="addUtilityBillModalLabel-{{ $billing->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form action="{{ route('utilitybill.store') }}"
                                                                        method="POST" class="modal-content">
                                                                        @csrf
                                                                        <input type="hidden" name="billing_id"
                                                                            value="{{ $billing->id }}">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="addUtilityBillModalLabel-{{ $billing->id }}">
                                                                                Add Utility Bill</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
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
                                                                                <label for="amount-{{ $billing->id }}"
                                                                                    class="form-label">Amount</label>
                                                                                <input type="number" step="0.01"
                                                                                    name="amount"
                                                                                    id="amount-{{ $billing->id }}"
                                                                                    class="form-control" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="reading-{{ $billing->id }}"
                                                                                    class="form-label">Reading
                                                                                    (optional)</label>
                                                                                <input type="text" name="reading"
                                                                                    id="reading-{{ $billing->id }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="status-{{ $billing->id }}"
                                                                                    class="form-label">Status</label>
                                                                                <select name="status"
                                                                                    id="status-{{ $billing->id }}"
                                                                                    class="form-select" required>
                                                                                    <option value="pending" selected>
                                                                                        Pending</option>
                                                                                    <option value="paid">Paid</option>
                                                                                    <option value="failed">Failed</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Add Utility
                                                                                Bill</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($billing->status == 'processing')
                                                        <form action="{{ route('billing.approve', $billing->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                        </form>
                                                        <form action="{{ route('billing.decline', $billing->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                                        </form>
                                                    @endif
                                                    


                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>


                                        <!-- Payments -->
                                        <div class="tab-pane fade" id="payment-{{ $listing->id }}" role="tabpanel">
@forelse ($payments->where('listing_id', $listing->id) as $payment)
    <div
        class="mb-3 border rounded p-2 d-flex justify-content-between align-items-center">
        <div>
            @php
                $totalAmount = $payment->amount + $payment->cash_advance_amount;
            @endphp
            <strong>₱{{ number_format($totalAmount, 2) }}</strong><br>
            <small>
                Amount: ₱{{ number_format($payment->amount, 2) }}<br>
                Cash Advance: ₱{{ number_format($payment->cash_advance_amount, 2) }}
            </small>
            @php
                $statusClass = 'warning'; // default to warning
                if ($payment->status === 'completed') {
                    $statusClass = 'success';
                } elseif ($payment->status === 'failed') {
                    $statusClass = 'danger';
                }
            @endphp

            <span class="badge bg-{{ $statusClass }}">
                {{ ucfirst($payment->status) }}
            </span>

            <br><small>{{ $payment->created_at->format('Y-m-d') }}</small>
        </div>
        <a href="{{ route('receipt.download', $payment->id) }}"
            class="btn btn-outline-primary btn-sm">Download</a>
    </div>
@empty
    <p class="text-muted">No payments yet.</p>
@endforelse
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
    <!-- Show modal on load if needed -->
    @if (session('success') || $errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new bootstrap.Modal(document.getElementById('feedbackModal')).show();
            });
            
        </script>
        
    @endif
@endsection
