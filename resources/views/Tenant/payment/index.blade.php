@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container">
    <div class="mt-4">
        <h3>Payment Summary</h3>
        <div class="row justify-content-between"> <!-- Space cards evenly -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Amount Paid</h5>
                        <p class="card-text">${{ number_format($payments->sum('amount'), 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Cash Advance</h5>
                        <p class="card-text">${{ number_format($payments->sum('cash_advance_amount'), 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Payments</h5>
                        <p class="card-text">{{ $billings->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Combined Billings and Utility Bills Table -->
    <div class="mt-4">
        <h2>Billings</h2>
        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;"> <!-- Scrollable container -->
            <table class="table-auto w-full border-collapse border border-gray-400">
                <thead>
                    <tr class="bg-gray-200">
        
                        <th class="border border-gray-400 px-4 py-2">Listing</th>
                        <th class="border border-gray-400 px-4 py-2">Due Date</th>
                        <th class="border border-gray-400 px-4 py-2">Status</th>
                        <th class="border border-gray-400 px-4 py-2">Utilities</th>
                        <th class="border border-gray-400 px-4 py-2">Total Amount</th>
                        <th class="border border-gray-400 px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billings as $billing)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">{{ $billing->listing->title ?? 'N/A' }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $billing->due_date->format('F j, Y') }}</td>

                        <td class="border border-gray-400 px-4 py-2">
                            @if($billing->status == 'processing')
                                <i class="fas fa-spinner fa-spin"></i> Processing
                            @else
                                {{ ucfirst($billing->status) }}
                            @endif
                        </td>
                        <td class="border border-gray-400 px-4 py-2">
                            <ul class="list-disc list-inside">
                                @foreach($billing->utility as $utility)
                                    <li>
                                        <strong>{{ ucfirst($utility->type) }}</strong>:
                                        ₱{{ number_format($utility->amount, 2) }}
                                    </li>
                                    @endforeach
                            </ul>
                        </td>
                        @php
                        $utilityTotal = $billing->utility->sum('amount');
                        $grandTotal = $billing->amount + $utilityTotal;
                    @endphp
                  <td class="border border-gray-400 px-4 py-2">
                    ₱{{ number_format($grandTotal, 2) }} <br>
                    <small class="text-gray-500 text-sm">
                        (₱{{ number_format($billing->amount, 2) }} + ₱{{ number_format($utilityTotal, 2) }})
                    </small>
                   
                </td>
                <td>
                    @if($billing->status == 'pending')
        <form action="{{ route('tenant.payment.create', $billing->id) }}">
            @csrf   
            <button type="submit" class="btn btn-primary mt-2">Pay</button>
        </form>
    @endif
                </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <div class="container">
    <h2>Payment History</h2>
    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
        <table class="table-auto w-full border-collapse border border-gray-400">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-400 px-4 py-2">Amount</th>
                    <th class="border border-gray-400 px-4 py-2">Payment Method</th>
                    <th class="border border-gray-400 px-4 py-2">Date</th>
                    <th class="border border-gray-400 px-4 py-2">Status</th>
                    <th class="border border-gray-400 px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">₱{{ number_format($payment->amount, 2) }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ ucfirst($payment->payment_method) }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $payment->created_at->format('F j, Y') }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ ucfirst($payment->status) }}</td>
                        <td class="border border-gray-400 px-4 py-2"><a href="{{ route('receipt.download', $payment->id) }}">Receipt</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
<!-- Modal for Billing Details -->
<div class="modal fade" id="billingDetailsModal" tabindex="-1" role="dialog" aria-labelledby="billingDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="billingDetailsModalLabel">Billing Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Details will be populated here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
                </div>
            </table>
        </div>
    </div>
</div>
</div>
</div
@endsection
