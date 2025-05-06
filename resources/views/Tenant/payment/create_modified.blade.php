@extends('layouts.app')

@section('content')
    <div class="main-content py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <!-- Back navigation -->
                    <button type="button" class="btn btn-outline-primary me-md-2" onclick="window.history.back();" aria-label="Go back">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </button>

                    <!-- Page header -->
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                        <h2 class="mb-0 text-primary">
                            <i class="fas fa-credit-card me-2"></i>Complete Your Payment
                        </h2>
                        <span class="badge bg-info fs-6">Invoice #{{ $billing->id }}</span>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm rounded">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-exclamation-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Oops! Please fix these errors:</h5>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                <!-- Payment details card -->
                <div class="col-lg-5">
                    <div class="card border-primary shadow-sm h-100">
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="card-title mb-0">
                                Payment Summary
                            </h4>
                        </div>
                        <div class="card-body">
                            <h5 class="text-secondary mb-3">Property Details</h5>
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-info bg-opacity-15 p-3 me-3">
                                    <i class="fas fa-building fa-lg text-info"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold fs-5">{{ $billing->listing->title ?? 'N/A' }}</p>
                                    <small class="text-muted">Property ID: {{ $billing->listing_id }}</small>
                                </div>
                            </div>

                            <h5 class="text-secondary mb-3">Bill Breakdown</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
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
                                                    <td class="text-end pe-0 py-1">
                                                        ₱{{ number_format($utility->amount, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="ps-0 text-muted fst-italic">No utilities</td>
                                                <td class="text-end pe-0">₱0.00</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th class="ps-0 border-top border-3">Total Amount Due:</th>
                                            <td class="text-end pe-0 fw-bold fs-4 text-info border-top border-3">
                                                ₱{{ number_format($grandTotal, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-warning mt-4 mb-0 d-flex align-items-center" role="alert">
                                <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Payment Due Date</h6>
                                    <p class="mb-0">Kindly complete your payment by
                                        <strong>{{ \Carbon\Carbon::parse($billing->due_date)->format('F j, Y') }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment form card -->
                <div class="col-lg-7">
                    <div class="card border-info shadow-sm">
                        <div class="card-header bg-info text-white py-3">
                            <h4 class="card-title mb-0">
                                Choose Payment Method
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tenant.payment.store') }}" method="POST" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                <input type="hidden" name="billing_id" value="{{ $billing->id }}">
                                <input type="hidden" name="listing_id" value="{{ $billing->listing_id }}">
                                <input type="hidden" name="rent" value="{{ $billing->listing->price }}">
                                <input type="hidden" name="total_amount" value="{{ $grandTotal }}">

                                <div class="mb-4">
                                    <label for="payment_method" class="form-label fw-bold">Select Payment Method <span
                                            class="text-danger">*</span></label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-check payment-method-option border rounded p-3 mb-3 shadow-sm">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method_cash" value="cash" checked>
                                                <label class="form-check-label w-100" for="payment_method_cash" tabindex="0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="rounded-circle bg-success bg-opacity-15 p-3 me-3">
                                                            <i class="fas fa-money-bill-wave text-success fa-lg"></i>
                                                        </div>
                                                        <span class="fs-5">Cash</span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check payment-method-option border rounded p-3 mb-3 shadow-sm">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method_gcash" value="gcash">
                                                <label class="form-check-label w-100" for="payment_method_gcash" tabindex="0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="rounded-circle bg-primary bg-opacity-15 p-3 me-3">
                                                            <i class="fas fa-mobile-alt text-primary fa-lg"></i>
                                                        </div>
                                                        <span class="fs-5">GCash</span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="gcash_fields" style="display: none;">
                                    <div class="alert alert-primary mb-4 d-flex align-items-center">
                                        <i class="fas fa-info-circle fa-lg me-3"></i>
                                        <div>
                                            <h6 class="alert-heading">GCash Payment Instructions</h6>
                                            @if ($owner)
                                                <p class="mb-0">Please send your payment to
                                                    <strong>{{ $owner->phone_number }}</strong> ({{ $owner->fname }}
                                                    {{ $owner->mname }} {{ $owner->lname }}) and upload a screenshot
                                                    of your transaction.</p>
                                            @else
                                                <p class="mb-0">Please send your payment to
                                                    <strong>09123456789</strong> (Landlord Name) and upload a screenshot
                                                    of your transaction.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="reference_number" class="form-label">Reference Number <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                            <input type="text" name="reference_number" id="reference_number"
                                                class="form-control" placeholder="Enter GCash reference number" required>
                                        </div>
                                        <div class="form-text">Enter the reference number from your GCash transaction</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="screenshot" class="form-label">Upload Screenshot <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                            <input type="file" name="screenshot" id="screenshot" class="form-control"
                                                accept="image/*" required>
                                        </div>
                                        <div class="form-text">Please upload a screenshot of your payment confirmation
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="cash_advance_checkbox"
                                            name="cash_advance_checkbox" value="1">
                                        <label class="form-check-label" for="cash_advance_checkbox">
                                            Request a cash advance
                                        </label>
                                    </div>
                                </div>

                                <div id="cash_advance_amount_group" style="display:none;" class="mb-4">
                                    <label for="cash_advance_amount" class="form-label">Cash Advance Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" name="cash_advance_amount" id="cash_advance_amount"
                                            class="form-control" min="0" step="0.01"
                                            placeholder="Enter amount">
                                    </div>
                                    <div class="form-text">Specify the amount you want to request as cash advance</div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <button type="button" class="btn btn-outline-primary" onclick="window.history.back();">
                                        <i class="fas fa-arrow-left me-1"></i>Back
                                    </button>

                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-check-circle me-1"></i>Submit Payment
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
            user-select: none;
        }

        .payment-method-option:hover {
            border-color: #0dcaf0 !important;
            background-color: rgba(13, 202, 240, 0.1);
        }

        .form-check-input:checked + .form-check-label .payment-method-option,
        .payment-method-option:has(.form-check-input:checked) {
            border-color: #0dcaf0 !important;
            background-color: rgba(13, 202, 240, 0.15);
            box-shadow: 0 0 8px rgba(13, 202, 240, 0.4);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cash advance toggle
            const cashAdvanceCheckbox = document.getElementById('cash_advance_checkbox');
            const cashAdvanceAmountGroup = document.getElementById('cash_advance_amount_group');

            function toggleCashAdvanceAmount() {
                if (cashAdvanceCheckbox.checked) {
                    cashAdvanceAmountGroup.style.display = 'block';
                } else {
                    cashAdvanceAmountGroup.style.display = 'none';
                    document.getElementById('cash_advance_amount').value = '';
                }
            }

            cashAdvanceCheckbox.addEventListener('change', toggleCashAdvanceAmount);

            // Initialize cash advance display on load
            toggleCashAdvanceAmount();

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

            // Make entire payment method box clickable
            const paymentMethodOptions = document.querySelectorAll('.payment-method-option');
            paymentMethodOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;

                    // Trigger the change event
                    const event = new Event('change');
                    radio.dispatchEvent(event);
                });
            });
        });
    </script>
@endsection
