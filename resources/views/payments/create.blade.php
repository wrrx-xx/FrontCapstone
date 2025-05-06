@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Payment for Reservation</h2>
                </div>
                <div class="card-body">
                    <form id="paymentForm" action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                        <input type="hidden" name="listing_id" value="{{ $reservation->listing_id }}">
                        <input type="hidden" name="amount" value="{{ $reservation->listing->price }}">

                        <!-- Reservation Details -->
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h4 class="border-bottom pb-2">Reservation Details</h4>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-bold">Monthly Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" name="price" id="price"
                                        value="{{ $reservation->listing->price }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reservation_amount" class="form-label fw-bold">Reservation Fee</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" name="reservation_amount" id="reservation_amount"
                                        value="{{ $reservation->listing->reservation_amount }}" readonly>
                                </div>
                            </div>
                        </div>

                        @php
                        $price = $reservation->listing->price;
                        $reservationAmount = $reservation->listing->reservation_amount;
                        $advanceMonths = $reservation->listing->advance_payment_months ?? 0;
                    
                        if ($advanceMonths > 0) {
                            // Total = advance months * price + reservation fee
                            $advancePaymentAmount = $price * $advanceMonths;
                            $totalAmount = $advancePaymentAmount + $reservationAmount;
                            $initialAmount = $price + $reservationAmount; // What the user paid now
                            $kulang = $totalAmount - $initialAmount;
                            $nabaytan = $initialAmount;
                        } else {
                            // If no advance, charge 1 month + reservation
                            $advancePaymentAmount = 0;
                            $totalAmount = $price + $reservationAmount;
                            $initialAmount = $totalAmount;
                            $kulang = 0;
                            $nabaytan = $initialAmount;
                        }
                    @endphp
                                        

                        <!-- Payment Details -->
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h4 class="border-bottom pb-2">Payment Information</h4>
                            </div>

                            <!-- Required Advance Months -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Required Advance Payment (Months)</label>
                                <input type="text" class="form-control bg-light" value="{{ $advanceMonths }}" readonly>
                            </div>

                            <!-- Total Amount -->
                            <div class="col-md-6 mb-3">
                                <label for="total_amount" class="form-label fw-bold">Total Amount Due</label>
                                <div class="input-group">
                                    <span class="input-group-text">P </span>
                                    <input type="text" class="form-control bg-light" name="total_amount" id="total_amount" 
                                        value="{{ $totalAmount }}" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Cash Advance Section (Shown based on advanceMonths) -->
                        @if($advanceMonths > 0)
                            <div id="cash-advance-section" class="mb-4 p-3 bg-light rounded">
                                <h5 class="mb-3 text-primary">Advance Payment Required</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="cash_advance_amount" class="form-label fw-bold">Advance Payment Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">P </span>
                                            <input type="number" class="form-control" name="cash_advance_amount" 
                                                id="cash_advance_amount" value="{{ $kulang }}" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">First Month + Reservation</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control" value="{{ $initialAmount }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div id="cash-advance-section" class="mb-4 p-3 bg-light rounded" style="display: none;">
                                <h5 class="mb-3 text-primary">Advance Payment</h5>
                                <div class="mb-3">
                                    <label for="cash_advance_amount" class="form-label fw-bold">Advance Payment Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">P </span>
                                        <input type="number" class="form-control" name="cash_advance_amount" 
                                            id="cash_advance_amount" value="0">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Payment Method Selection -->
                        <div class="mb-4">
                            <h4 class="border-bottom pb-2">Payment Method</h4>
                            <div class="d-flex gap-3 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" value="cash" checked>
                                    <label class="form-check-label" for="payment_cash">
                                        Cash
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_gcash" value="gcash">
                                    <label class="form-check-label" for="payment_gcash">
                                        GCash
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- GCash Fields (Hidden by default) -->
                        <div id="gcash-fields" class="mb-4 p-3 bg-light rounded" style="display: none;">
                            <h5 class="mb-3 text-primary">GCash Payment Details</h5>
                            <div class="mb-3">
                                <label for="reference_number" class="form-label fw-bold">Reference Number</label>
                                <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="Enter GCash reference number">
                            </div>

                            <div class="mb-3">
                                <label for="screenshot" class="form-label fw-bold">Upload Payment Screenshot</label>
                                <input type="file" class="form-control" name="screenshot" id="screenshot" accept="image/*">
                                <div class="form-text">Please upload a screenshot of your GCash payment confirmation</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Proceed to Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Payment Status Modal -->
<div class="modal fade" id="paymentStatusModal" tabindex="-1" aria-labelledby="paymentStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="modal-header" class="modal-header">
                <h5 class="modal-title" id="paymentStatusModalLabel">Payment Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div id="status-icon" class="mb-3">
                        <!-- Icon will be inserted here via JavaScript -->
                    </div>
                    <h4 id="status-message" class="mb-3">Processing your payment...</h4>
                    <p id="status-details" class="text-muted"></p>
                </div>
                
                <!-- Payment details will be shown here for successful payments -->
                <div id="payment-details" class="mt-4" style="display: none;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Payment Details</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Payment ID:</span>
                                    <span id="payment-id" class="fw-bold"></span>
                                </li>`
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Property:</span>
                                    <span id="property-title"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Amount Paid:</span>
                                    <span id="amount-paid" class="fw-bold"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Payment Method:</span>
                                    <span id="payment-method"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Date:</span>
                                    <span id="payment-date"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('booking.owner') }}" id="home-button" class="btn btn-primary">Go to Dashboard</a>
                <a href="#" id="downloadReceipt" class="btn btn-success" style="display: none;">Download Receipt</a>
            </div>
        </div>
    </div>
</div>

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
        document.getElementById('status-icon').innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
        document.getElementById('status-message').textContent = 'Processing your payment...';
        document.getElementById('status-details').textContent = 'Please wait while we process your transaction.';
        document.getElementById('payment-details').style.display = 'none';
        document.getElementById('downloadReceipt').style.display = 'none';
        
        // Set neutral header color
        document.getElementById('modal-header').className = 'modal-header bg-light';
        
        modal.show();
        
        // Submit the form via AJAX
        fetch('{{ route('payment.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
    if (data.success) {
        // Show success state
        document.getElementById('modal-header').className = 'modal-header bg-success text-white';
        document.getElementById('status-icon').innerHTML = '<i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>';
        if (!document.querySelector('.fas')) {
            // Fallback if Font Awesome is not available
            document.getElementById('status-icon').innerHTML = '<div class="bg-success text-white rounded-circle p-3 d-inline-block"><span style="font-size: 2rem;">✓</span></div>';
        }
        document.getElementById('status-message').textContent = 'Payment Successful!';
        document.getElementById('status-details').textContent = 'Your payment has been processed successfully.';
        
        // Show payment details
        document.getElementById('payment-details').style.display = 'block';
        document.getElementById('payment-id').textContent = data.payment_id;
        document.getElementById('property-title').textContent = '{{ $reservation->listing->title }}';
        document.getElementById('amount-paid').textContent = 'P ' + (document.getElementById('total_amount').value);
        document.getElementById('payment-method').textContent = document.querySelector('input[name="payment_method"]:checked').value === 'cash' ? 'Cash' : 'GCash';
        document.getElementById('payment-date').textContent = new Date().toLocaleDateString();
        
        // Show download receipt button with correct URL
        const downloadBtn = document.getElementById('downloadReceipt');
downloadBtn.style.display = 'inline-block';
downloadBtn.href = "{{ url('receipt/download') }}/" + data.payment_id;

    } else {
                // Show error state
                document.getElementById('modal-header').className = 'modal-header bg-danger text-white';
                document.getElementById('status-icon').innerHTML = '<i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>';
                if (!document.querySelector('.fas')) {
                    // Fallback if Font Awesome is not available
                    document.getElementById('status-icon').innerHTML = '<div class="bg-danger text-white rounded-circle p-3 d-inline-block"><span style="font-size: 2rem;">✗</span></div>';
                }
                document.getElementById('status-message').textContent = 'Payment Failed';
                document.getElementById('status-details').textContent = data.message || 'There was an error processing your payment. Please try again.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Show error state
            document.getElementById('modal-header').className = 'modal-header bg-danger text-white';
            document.getElementById('status-icon').innerHTML = '<i class="fas fa-exclamation-triangle text-danger" style="font-size: 4rem;"></i>';
            if (!document.querySelector('.fas')) {
                // Fallback if Font Awesome is not available
                document.getElementById('status-icon').innerHTML = '<div class="bg-danger text-white rounded-circle p-3 d-inline-block"><span style="font-size: 2rem;">!</span></div>';
            }
            document.getElementById('status-message').textContent = 'System Error';
            document.getElementById('status-details').textContent = 'An unexpected error occurred. Please try again or contact support.';
        });
    });
});
</script>
@endsection