@extends('layouts.app')

@section('content')
<div class="main-content"> 
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h2>Pay Billing</h2>
    
    <form action="{{ route('tenant.payment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="billing_id" value="{{ $billing->id }}">
        <input type="hidden" name="listing_id" value="{{ $billing->listing_id }}">
        <input type="hidden" name="rent" value="{{ $billing->listing->price }}">
        <input type="hidden" name="total_amount" value="{{ $grandTotal }}">

        <p><strong>Rent:</strong> ₱{{ number_format($billing->amount, 2) }}</p>

        <h4>Utility Bills:</h4>
        <ul>
            @foreach($billing->utility as $utility)
                <li>{{ ucfirst($utility->type) }}: ₱{{ number_format($utility->amount, 2) }}</li>
            @endforeach
        </ul>
        
        <p><strong>Grand Total:</strong> ₱{{ number_format($grandTotal, 2) }}</p>   
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="gcash">GCash</option>
            </select>
        </div>
        <div class="form-group">
            <input type="checkbox" id="cash_advance_checkbox" name="cash_advance_checkbox">
            <label for="cash_advance_checkbox">I want a cash advance</label>
        </div>
        
        <div class="form-group" id="cash_advance_amount_group" style="display:none;">
            <label for="cash_advance_amount">Cash Advance Amount</label>
            <input type="number" name="cash_advance_amount" id="cash_advance_amount" class="form-control" min="0" step="0.01">
        </div>

        <div class="form-group">
            <label for="reference_number">Reference Number</label>
            <input type="text" name="reference_number" id="reference_number" class="form-control">
        </div>

        <div class="form-group">
            <label for="screenshot">Upload Screenshot</label>
            <input type="file" name="screenshot" id="screenshot" class="form-control" accept="image/*">
        </div>
        
        <button  type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
    
    <script>
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

// Initialize on page load
toggleCashAdvanceAmount();
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethodSelect = document.getElementById('payment_method');
            const referenceNumberField = document.getElementById('reference_number').parentElement;
            const screenshotField = document.getElementById('screenshot').parentElement;
        
            function toggleFields() {
                if (paymentMethodSelect.value === 'gcash') {
                    referenceNumberField.style.display = 'block';
                    screenshotField.style.display = 'block';
                } else {
                    referenceNumberField.style.display = 'none';
                    screenshotField.style.display = 'none';
                }
            }
        
            paymentMethodSelect.addEventListener('change', toggleFields);
        
            // Initialize on page load
            toggleFields();
        });
        </script>
</div>
</div>
@endsection
