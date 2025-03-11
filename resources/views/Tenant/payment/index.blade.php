@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Billings and Services</h2>
    <div class="mt-4">
        <h3>Payment Summary</h3>
        <div class="row justify-content-between"> <!-- Space cards evenly -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Amount Paid</h5>
                        <a href="{{ route('tenant.services') }}" class="btn btn-primary mt-2">Access Services</a>
                        <p class="card-text">${{ number_format($payments->sum('amount'), 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Cash Advance</h5>
                        <a href="{{ route('tenant.services') }}" class="btn btn-primary mt-2">Access Services</a>
                        <p class="card-text">${{ number_format($payments->sum('cash_advance_amount'), 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Payments</h5>
                        <a href="{{ route('tenant.services') }}" class="btn btn-primary mt-2">Access Services</a>
                        <p class="card-text">{{ $billings->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Billings Table -->
    <div class="mt-4">
        <h2>Billings</h2>
        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;"> <!-- Scrollable container -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billings as $billing)
                        <tr>
                            <td>${{ number_format($billing->amount, 2) }}</td>
                            <td>{{ $billing->due_date->format('Y-m-d') }}</td>
                            <td>{{ ucfirst($billing->status) }}</td>
                            <td>
                                {{-- <a href="{{ route('billing.details', $billing->id) }}" class="btn btn-sm btn-info">View Details</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="mt-4">
        <h2>Payments and Services</h2>
        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;"> <!-- Scrollable container -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th> ID</th>
                        <th>Amount</th>
                        <th class="d-none d-md-table-cell">Cash Advance</th> <!-- Hide on mobile -->
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->listing_id }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td class="d-none d-md-table-cell">${{ number_format($payment->cash_advance_amount ?? 0, 2) }}</td> <!-- Hide on mobile -->
                            <td>{{ ucfirst($payment->payment_method) }}</td>
                            <td>{{ ucfirst($payment->status) }}</td>
                            <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                            <td>
                                {{-- <a href="{{ route('payment.details', $payment->id) }}" class="btn btn-sm btn-info">View Details</ </a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
