@extends('layouts.app')

@section('content')
<div class="main-content">
    <h2>Process Payment for Viewing</h2>
    
    @php
        $totalAmount = $viewing->listing->price + $viewing->listing->reservation_amount; // Total amount
    @endphp

    <p>Total Amount Due: <strong>${{ number_format($totalAmount, 2) }}</strong></p>

    <form action="{{ route('payment.store') }}" method="POST">
        @csrf
        <input type="hidden" name="viewing_id" value="{{ $viewing->id }}">
        
        <label for="payment_method">Select Payment Method:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="gcash">GCash</option>
            <option value="cash">Cash</option>
        </select>

        <label for="cash_advance">Cash Advance (if applicable):</label>
        <input type="number" name="cash_advance" id="cash_advance" min="0" max="{{ $totalAmount }}" step="0.01" placeholder="Enter cash advance amount">

        <button type="submit">Pay Now</button>
    </form>
</div>
@endsection