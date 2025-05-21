@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            <i class="fas fa-file-invoice text-primary me-2"></i>Bill Details
                        </h4>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                        <i class="fas fa-home text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">{{ $billing->listing->title ?? 'N/A' }}</p>
                                        <small class="text-muted">Property ID: {{ $billing->listing_id }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <h5 class="text-muted mb-3">Bill Summary</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th class="ps-0">Monthly Rent:</th>
                                                <td class="text-end pe-0">₱{{ number_format($billing->amount, 2) }}</td>
                                            </tr>

                                            @if ($billing->utility->count() > 0)
                                                <tr>
                                                    <th class="ps-0 border-0">Utilities:</th>
                                                    <td class="text-end pe-0 border-0"></td>
                                                </tr>
                                                @foreach ($billing->utility as $utility)
                                                    <tr>
                                                        <td class="ps-0 py-1 text-muted">
                                                            @if ($utility->type == 'electricity')
                                                                <i class="fas fa-bolt text-warning me-1"></i>
                                                            @elseif($utility->type == 'water')
                                                                <i class="fas fa-tint text-primary me-1"></i>
                                                            @elseif($utility->type == 'internet')
                                                                <i class="fas fa-wifi text-info me-1"></i>
                                                            @else
                                                                <i class="fas fa-file-invoice text-secondary me-1"></i>
                                                            @endif
                                                            {{ ucfirst($utility->type) }}:
                                                        </td>
                                                        <td class="text-end pe-0 py-1">₱{{ number_format($utility->amount, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th class="ps-0 border-top">Total Utilities:</th>
                                                    <td class="text-end pe-0 border-top">₱{{ number_format($utilityTotal, 2) }}</td>
                                                </tr>
                                            @endif

                                            @if($availableCashAdvance > 0)
                                                <tr id="cash-advance-row">
                                                    <th class="ps-0 text-success">
                                                        <i class="fas fa-piggy-bank me-1"></i>Available Cash Advance:
                                                    </th>
                                                    <td class="text-end pe-0 text-success">₱{{ number_format($availableCashAdvance, 2) }}</td>
                                                </tr>
                                                @php
                                                    $cashAdvanceUsed = min($availableCashAdvance, $grandTotal);
                                                    $remainingAmount = $availableCashAdvance - $cashAdvanceUsed;
                                                @endphp
                                                @if($remainingAmount > 0)
                                                    <tr id="after-cash-advance-row">
                                                        <th class="ps-0">Available Cash Advance for Next Payment:</th>
                                                        <td class="text-end pe-0">₱{{ number_format($remainingAmount, 2) }}</td>
                                                    </tr>
                                                @endif
                                            @endif

                                            <tr>
                                                <th class="ps-0 border-top border-2">Total Amount Due:</th>
                                                <td class="text-end pe-0 fw-bold fs-5 text-primary border-top border-2">
                                                    ₱{{ number_format($grandTotal, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="alert alert-info mt-3 mb-0">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-info-circle fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="alert-heading">Payment Due Date</h6>
                                            <p class="mb-0">Please complete your payment by
                                                <strong>{{ \Carbon\Carbon::parse($billing->due_date)->format('F j, Y') }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment form card -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-credit-card text-primary me-2"></i>Payment Methods
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tenant.payment.store') }}" method="POST" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="billing_id" value="{{ $billing->id }}">
                            <input type="hidden" name="listing_id" value="{{ $billing->listing_id }}">
                            <input type="hidden" name="total_amount" value="{{ $grandTotal }}">

                            @if($availableCashAdvance > 0)
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="use_cash_advance"
                                            name="use_cash_advance" value="1" checked>
                                        <label class="form-check-label" for="use_cash_advance">
                                            <i class="fas fa-piggy-bank text-success me-1"></i>
                                            Use available cash advance (₱{{ number_format($availableCashAdvance, 2) }})
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" id="cash_advance_used" name="cash_advance_used" value="{{ min($availableCashAdvance, $grandTotal) }}">
                            @endif

                            <div class="mb-4">
                                <label for="payment_method" class="form-label fw-bold">Select Payment Method <span
                                        class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check payment-method-option border rounded p-3 mb-3">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="payment_method_cash" value="cash" checked>
                                            <label class="form-check-label w-100" for="payment_method_cash">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                                                        <i class="fas fa-money-bill-wave text-success"></i>
                                                    </div>
                                                    <span>Cash</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check payment-method-option border rounded p-3 mb-3">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="payment_method_gcash" value="gcash">
                                            <label class="form-check-label w-100" for="payment_method_gcash">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                                        <i class="fas fa-mobile-alt text-primary"></i>
                                                    </div>
                                                    <span>GCash</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="gcash_fields" style="display: none;">
                                <div class="alert alert-primary mb-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-info-circle fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="alert-heading">GCash Payment Instructions</h6>
                                            @if ($owner)
                                                <p class="mb-0">Please send your payment to
                                                    <strong>{{ $owner->phone_number }}</strong> ({{ $owner->fname }}
                                                    {{ $owner->mname }} {{ $owner->lname }}) and upload a screenshot
                                                    of your transaction.</p>
                                            @else
                                                <p class="mb-0">Please send your payment to the provided GCash number and upload a screenshot
                                                    of your transaction.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="reference_number" class="form-label fw-bold">Reference Number <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        <input type="text" name="reference_number" id="reference_number" class="form-control"
                                            placeholder="Enter GCash reference number" required>
                                    </div>
                                    <div class="form-text">Enter the reference number from your GCash transaction</div>
                                </div>

                                <div class="mb-4">
                                    <label for="screenshot" class="form-label fw-bold">Upload Screenshot <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        <input type="file" name="screenshot" id="screenshot" class="form-control"
                                            accept="image/*" required>
                                    </div>
                                    <div class="form-text">Please upload a screenshot of your payment confirmation</div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="new_cash_advance_checkbox"
                                        name="new_cash_advance_checkbox" value="1">
                                    <label class="form-check-label" for="new_cash_advance_checkbox">
                                        I want to request a new cash advance
                                    </label>
                                </div>
                            </div>

                            <div id="new_cash_advance_amount_group" style="display:none;" class="mb-4">
                                <label for="new_cash_advance_amount" class="form-label">New Cash Advance Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="number" name="cash_advance_amount" id="new_cash_advance_amount"
                                        class="form-control" min="0" step="0.01"
                                        placeholder="Enter amount">
                                </div>
                                <div class="form-text">Enter the amount you wish to request as new cash advance</div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="button" class="btn btn-outline-secondary me-md-2" onclick="window.history.back();">
                                    <i class="fas fa-arrow-left me-1"></i>Back
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle me-1"></i>Complete Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-method-option {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-method-option:hover {
        border-color: #0d6efd !important;
        background-color: rgba(13, 110, 253, 0.03);
    }

    .form-check-input:checked + .form-check-label .payment-method-option,
    .payment-method-option:has(.form-check-input:checked) {
        border-color: #0d6efd !important;
        background-color: rgba(13, 110, 253, 0.05);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cash advance toggle for new requests
        const newCashAdvanceCheckbox = document.getElementById('new_cash_advance_checkbox');
        const newCashAdvanceAmountGroup = document.getElementById('new_cash_advance_amount_group');

        function toggleNewCashAdvanceAmount() {
            if (newCashAdvanceCheckbox.checked) {
                newCashAdvanceAmountGroup.style.display = 'block';
            } else {
                newCashAdvanceAmountGroup.style.display = 'none';
                document.getElementById('new_cash_advance_amount').value = '';
            }
        }

        newCashAdvanceCheckbox.addEventListener('change', toggleNewCashAdvanceAmount);

        // Initialize new cash advance display on load
        toggleNewCashAdvanceAmount();

        // Payment method toggle
        const cashOption = document.getElementById('payment_method_cash');
        const gcashOption = document.getElementById('payment_method_gcash');
        const gcashFields = document.getElementById('gcash_fields');

        function togglePaymentFields() {
            if (gcashOption.checked) {
                gcashFields.style.display = 'block';
                document.getElementById('reference_number').setAttribute('required', 'required');
                document.getElementById('screenshot').setAttribute('required', 'required');
            } else {
                gcashFields.style.display = 'none';
                document.getElementById('reference_number').removeAttribute('required');
                document.getElementById('screenshot').removeAttribute('required');
            }
        }

        cashOption.addEventListener('change', togglePaymentFields);
        gcashOption.addEventListener('change', togglePaymentFields);

        // Initialize payment fields on load
        togglePaymentFields();

        // Cash advance deduction toggle
        const useCashAdvance = document.getElementById('use_cash_advance');
        const cashAdvanceRow = document.getElementById('cash-advance-row');
        const afterCashAdvanceRow = document.getElementById('after-cash-advance-row');
        const cashAdvanceUsedInput = document.getElementById('cash_advance_used');
        const grandTotal = {{ $grandTotal }};
        const availableCashAdvance = {{ $availableCashAdvance }};

        if (useCashAdvance) {
            useCashAdvance.addEventListener('change', function() {
                if (this.checked) {
                    if (cashAdvanceRow) cashAdvanceRow.style.display = '';
                    if (afterCashAdvanceRow) afterCashAdvanceRow.style.display = '';
                    if (cashAdvanceUsedInput) cashAdvanceUsedInput.value = Math.min(availableCashAdvance, grandTotal);
                } else {
                    if (cashAdvanceRow) cashAdvanceRow.style.display = 'none';
                    if (afterCashAdvanceRow) afterCashAdvanceRow.style.display = 'none';
                    if (cashAdvanceUsedInput) cashAdvanceUsedInput.value = 0;
                }
            });
        }

        // Enable Bootstrap form validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>
@endsection
