@extends('layouts.app')

@section('content')
    <div class="payment-container">
        <!-- Background Elements -->
        <div class="payment-bg-elements">
            <div class="floating-shape shape-1"></div>
            <div class="floating-shape shape-2"></div>
            <div class="floating-shape shape-3"></div>
        </div>

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <!-- Header Section -->
                    <div class="payment-header text-center mb-5">
                        <div class="payment-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h1 class="payment-title">Complete Your Payment</h1>
                        <p class="payment-subtitle">Secure your reservation with just a few clicks</p>
                    </div>

                    <div class="row g-4">
                        <!-- Left Column - Payment Form -->
                        <div class="col-lg-7">
                            <div class="payment-card">
                                <form id="paymentForm" action="{{ route('payment.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                    <input type="hidden" name="listing_id" value="{{ $reservation->listing_id }}">
                                    <input type="hidden" name="amount" value="{{ $reservation->listing->price }}">

                                    @php
                                        $price = $reservation->listing->price;
                                        $reservationAmount = $reservation->listing->reservation_amount;
                                        $advanceMonths = $reservation->listing->advance_payment_months ?? 0;

                                        if ($advanceMonths > 0) {
                                            $advancePaymentAmount = $price * $advanceMonths;
                                            $totalAmount = $advancePaymentAmount + $reservationAmount;
                                            $initialAmount = $price + $reservationAmount;
                                            $kulang = $totalAmount - $initialAmount;
                                            $nabaytan = $initialAmount;
                                        } else {
                                            $advancePaymentAmount = 0;
                                            $totalAmount = $price + $reservationAmount;
                                            $initialAmount = $totalAmount;
                                            $kulang = 0;
                                            $nabaytan = $initialAmount;
                                        }
                                    @endphp
                                    <input type="hidden" name="total_amount" value="{{ $totalAmount }}" required>

                                    <!-- Payment Method Selection -->
                                    <div class="form-section">
                                        <div class="section-header">
                                            <i class="fas fa-wallet section-icon"></i>
                                            <h3>Choose Payment Method</h3>
                                        </div>
                                        
                                        <div class="payment-methods">
                                            <div class="payment-method-card">
                                                <input type="radio" id="payment_cash" name="payment_method" value="cash" checked>
                                                <label for="payment_cash" class="payment-method-label">
                                                    <div class="method-icon">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </div>
                                                    <div class="method-info">
                                                        <span class="method-name">Cash Payment</span>
                                                        <span class="method-desc">Pay in person</span>
                                                    </div>
                                                    <div class="method-check">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="payment-method-card">
                                                <input type="radio" id="payment_gcash" name="payment_method" value="gcash">
                                                <label for="payment_gcash" class="payment-method-label">
                                                    <div class="method-icon gcash">
                                                        <i class="fas fa-mobile-alt"></i>
                                                    </div>
                                                    <div class="method-info">
                                                        <span class="method-name">GCash</span>
                                                        <span class="method-desc">Digital payment</span>
                                                    </div>
                                                    <div class="method-check">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- GCash Payment Details -->
                                    <div id="gcash-fields" class="form-section gcash-section" style="display: none;">
                                        <div class="section-header">
                                            <i class="fas fa-mobile-alt section-icon"></i>
                                            <h3>GCash Payment Details</h3>
                                        </div>
                                        
                                        <div class="gcash-form">
                                            <div class="form-group">
                                                <label for="reference_number" class="form-label">
                                                    <i class="fas fa-hashtag"></i>
                                                    Reference Number
                                                </label>
                                                <input type="text" class="form-control modern-input" name="reference_number"
                                                    id="reference_number" placeholder="Enter GCash reference number">
                                            </div>

                                            <div class="form-group">
                                                <label for="screenshot" class="form-label">
                                                    <i class="fas fa-camera"></i>
                                                    Payment Screenshot
                                                </label>
                                                <div class="file-upload-area">
                                                    <input type="file" name="screenshot" id="screenshot" accept="image/*" hidden>
                                                    <div class="file-upload-content" onclick="document.getElementById('screenshot').click()">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                        <span>Click to upload screenshot</span>
                                                        <small>PNG, JPG up to 10MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Advance Payment Section -->
                                    @if ($advanceMonths > 0)
                                        <div class="form-section advance-section">
                                            <div class="section-header">
                                                <i class="fas fa-calendar-plus section-icon"></i>
                                                <h3>Advance Payment Required</h3>
                                            </div>
                                            <div class="advance-details">
                                                <div class="advance-item">
                                                    <span class="advance-label">Required Months:</span>
                                                    <span class="advance-value">{{ $advanceMonths }} months</span>
                                                </div>
                                                <div class="advance-item">
                                                    <span class="advance-label">Advance Amount:</span>
                                                    <span class="advance-value">₱{{ number_format($kulang, 2) }}</span>
                                                </div>
                                                <input type="hidden" name="cash_advance_amount" value="{{ $kulang }}">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-actions">
                                        <button type="submit" class="btn-payment-submit">
                                            <i class="fas fa-lock"></i>
                                            <span>Secure Payment</span>
                                            <div class="btn-shine"></div>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Right Column - Summary -->
                        <div class="col-lg-5">
                            <div class="payment-summary-card">
                                <div class="summary-header">
                                    <i class="fas fa-receipt"></i>
                                    <h3>Payment Summary</h3>
                                </div>

                                <div class="property-info">
                                    <div class="property-image">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <div class="property-details">
                                        <h4>{{ $reservation->listing->title }}</h4>
                                        <p>{{ $reservation->listing->address ?? 'Property Address' }}</p>
                                    </div>
                                </div>

                                <div class="payment-breakdown">
                                    <div class="breakdown-item">
                                        <span>Monthly Rent</span>
                                        <span>₱{{ number_format($price, 2) }}</span>
                                    </div>
                                    <div class="breakdown-item">
                                        <span>Reservation Fee</span>
                                        <span>₱{{ number_format($reservationAmount, 2) }}</span>
                                    </div>
                                    @if ($advanceMonths > 0)
                                        <div class="breakdown-item">
                                            <span>Advance Payment ({{ $advanceMonths }} months)</span>
                                            <span>₱{{ number_format($kulang, 2) }}</span>
                                        </div>
                                    @endif
                                    <div class="breakdown-divider"></div>
                                    <div class="breakdown-item total">
                                        <span>Total Amount</span>
                                        <span>₱{{ number_format($totalAmount, 2) }}</span>
                                    </div>
                                </div>

                                <div class="security-badges">
                                    <div class="badge-item">
                                        <i class="fas fa-shield-alt"></i>
                                        <span>256-bit SSL</span>
                                    </div>
                                    <div class="badge-item">
                                        <i class="fas fa-lock"></i>
                                        <span>Secure Payment</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Payment Status Modal -->
    <div class="modal fade" id="paymentStatusModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content payment-modal">
                <div class="modal-body p-0">
                    <div class="payment-status-content">
                        <div class="status-animation">
                            <div id="status-icon-container">
                                <!-- Dynamic content -->
                            </div>
                        </div>
                        <div class="status-text">
                            <h2 id="status-message">Processing Payment...</h2>
                            <p id="status-details">Please wait while we process your transaction.</p>
                        </div>
                        
                        <div id="payment-details" class="payment-details-card" style="display: none;">
                            <h4>Payment Confirmation</h4>
                            <div class="details-grid">
                                <div class="detail-item">
                                    <span class="label">Payment ID</span>
                                    <span class="value" id="payment-id"></span>
                                </div>
                                <div class="detail-item">
                                    <span class="label">Property</span>
                                    <span class="value" id="property-title"></span>
                                </div>
                                <div class="detail-item">
                                    <span class="label">Amount</span>
                                    <span class="value" id="amount-paid"></span>
                                </div>
                                <div class="detail-item">
                                    <span class="label">Method</span>
                                    <span class="value" id="payment-method"></span>
                                </div>
                                <div class="detail-item">
                                    <span class="label">Date</span>
                                    <span class="value" id="payment-date"></span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @if (auth()->user()->isOwner())
                                <a href="{{ route('owner.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                            @elseif (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                            @endif
                            <a href="#" id="downloadReceipt" class="btn btn-success" style="display: none;">
                                <i class="fas fa-download"></i>
                                Download Receipt
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .payment-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%);
            position: relative;
            overflow: hidden;
        }

        .payment-bg-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite linear;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: -5%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            top: 60%;
            right: -5%;
            animation-delay: -7s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            top: 30%;
            right: 20%;
            animation-delay: -14s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .payment-header {
            position: relative;
            z-index: 1;
        }

        .payment-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
        }

        .payment-icon i {
            font-size: 2rem;
            color: white;
        }

        .payment-title {
            color: white;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 2.5rem;
        }

        .payment-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        .payment-card, .payment-summary-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .section-header h3 {
            margin: 0;
            color: #2d3748;
            font-weight: 600;
        }

        .payment-methods {
            display: grid;
            gap: 15px;
        }

        .payment-method-card {
            position: relative;
        }

        .payment-method-card input[type="radio"] {
            display: none;
        }

        .payment-method-label {
            display: flex;
            align-items: center;
            padding: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .payment-method-label:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }

        .payment-method-card input:checked + .payment-method-label {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea15, #764ba215);
        }

        .method-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            margin-right: 15px;
        }

        .method-icon.gcash {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        }

        .method-info {
            flex: 1;
        }

        .method-name {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .method-desc {
            color: #718096;
            font-size: 0.9rem;
        }

        .method-check {
            width: 30px;
            height: 30px;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .payment-method-card input:checked + .payment-method-label .method-check {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }

        .gcash-section {
            background: linear-gradient(135deg, #00b4d815, #0077b615);
            border-radius: 15px;
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .form-label i {
            margin-right: 8px;
            color: #667eea;
        }

        .modern-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .modern-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .file-upload-area {
            border: 2px dashed #cbd5e0;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-area:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }

        .file-upload-content i {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }

        .file-upload-content span {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .file-upload-content small {
            color: #718096;
        }

        .advance-section {
            background: linear-gradient(135deg, #fef5e7, #fed7aa15);
            border-radius: 15px;
            padding: 25px;
        }

        .advance-details {
            display: grid;
            gap: 15px;
        }

        .advance-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: white;
            border-radius: 10px;
            border-left: 4px solid #f59e0b;
        }

        .advance-label {
            font-weight: 500;
            color: #92400e;
        }

        .advance-value {
            font-weight: 700;
            color: #92400e;
            font-size: 1.1rem;
        }

        .btn-payment-submit {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-payment-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-payment-submit:hover .btn-shine {
            left: 100%;
        }

        .payment-summary-card {
            height: fit-content;
        }

        .summary-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .summary-header i {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .summary-header h3 {
            margin: 0;
            color: #2d3748;
            font-weight: 600;
        }

        .property-info {
            display: flex;
            align-items: center;
            padding: 20px;
            background: #f8fafc;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .property-image {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .property-details h4 {
            margin: 0 0 5px 0;
            color: #2d3748;
            font-weight: 600;
        }

        .property-details p {
            margin: 0;
            color: #718096;
            font-size: 0.9rem;
        }

        .payment-breakdown {
            margin-bottom: 25px;
        }

        .breakdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            color: #4a5568;
        }

        .breakdown-item.total {
            font-weight: 700;
            font-size: 1.2rem;
            color: #2d3748;
            padding-top: 15px;
        }

        .breakdown-divider {
            height: 2px;
            background: #e2e8f0;
            margin: 15px 0;
        }

        .security-badges {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .badge-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background: #f0fff4;
            border-radius: 8px;
            color: #065f46;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .payment-modal .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .payment-status-content {
            text-align: center;
            padding: 40px 30px;
        }

        .status-animation {
            margin-bottom: 30px;
        }

        .status-text h2 {
            color: #2d3748;
            margin-bottom: 10px;
        }

        .status-text p {
            color: #718096;
        }

        .payment-details-card {
            background: #f8fafc;
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
        }

        .payment-details-card h4 {
            margin-bottom: 20px;
            color: #2d3748;
        }

        .details-grid {
            display: grid;
            gap: 15px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: white;
            border-radius: 8px;
        }

        .detail-item .label {
            color: #718096;
            font-weight: 500;
        }

        .detail-item .value {
            color: #2d3748;
            font-weight: 600;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .modal-actions .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .payment-title {
                font-size: 2rem;
            }
            
            .payment-card, .payment-summary-card {
                padding: 20px;
            }
            
            .row.g-4 {
                --bs-gutter-x: 1.5rem;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle payment method change
            const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
            const gcashFields = document.getElementById('gcash-fields');

            paymentMethodRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'gcash') {
                        gcashFields.style.display = 'block';
                        document.getElementById('reference_number').setAttribute('required', 'required');
                        document.getElementById('screenshot').setAttribute('required', 'required');
                    } else {
                        gcashFields.style.display = 'none';
                        document.getElementById('reference_number').removeAttribute('required');
                        document.getElementById('screenshot').removeAttribute('required');
                    }
                });
            });

            // Handle form submission
            const paymentForm = document.getElementById('paymentForm');

            paymentForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Show confirmation dialog
                if (!confirm("Are you sure you want to proceed with this payment?")) {
                    return;
                }

                // Create FormData object
                const formData = new FormData(this);

                // Show the payment status modal with processing state
                const modal = new bootstrap.Modal(document.getElementById('paymentStatusModal'));
                document.getElementById('status-icon-container').innerHTML = `
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>`;
                document.getElementById('status-message').textContent = 'Processing Payment...';
                document.getElementById('status-details').textContent = 'Please wait while we process your transaction.';
                document.getElementById('payment-details').style.display = 'none';
                document.getElementById('downloadReceipt').style.display = 'none';
                modal.show();

                // Submit form data
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Show success state
                        document.getElementById('status-icon-container').innerHTML = `
                            <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                        `;
                        document.getElementById('status-message').textContent = 'Payment Successful!';
                        document.getElementById('status-details').textContent = 'Your payment has been processed successfully.';
                        
                        // Update payment details
                        document.getElementById('payment-id').textContent = data.payment_id || 'N/A';
                        document.getElementById('property-title').textContent = data.property_title || '{{ $reservation->listing->title }}';
                        document.getElementById('amount-paid').textContent = `₱${data.amount || formData.get('total_amount')}`;
                        document.getElementById('payment-method').textContent = formData.get('payment_method') === 'cash' ? 'Cash' : 'GCash';
                        document.getElementById('payment-date').textContent = new Date().toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        
                        // Show payment details section
                        document.getElementById('payment-details').style.display = 'block';

                        // Show download receipt button with correct URL
                        if (data.payment_id) {
                            const downloadBtn = document.getElementById('downloadReceipt');
                            downloadBtn.style.display = 'inline-flex';
                            downloadBtn.href = `{{ url('receipt/download') }}/${data.payment_id}`;
                            
                            // Add click event listener for download
                            downloadBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                window.location.href = this.href;
                            });
                        }

                        // Redirect after delay if specified
                        if (data.redirect) {
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 3000);
                        }
                    } else {
                        throw new Error(data.message || 'Payment failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show error state
                    document.getElementById('status-icon-container').innerHTML = `
                        <i class="fas fa-times-circle text-danger" style="font-size: 3rem;"></i>
                    `;
                    document.getElementById('status-message').textContent = 'Payment Failed';
                    document.getElementById('status-details').textContent = error.message || 'An error occurred while processing your payment.';
                });
            });
        });
    </script>
    @endsection