@extends('layouts.app')

@section('content')
<div class="main-content">
    @if (session('success') || $errors->any())
        @include('components.feedback-modal')
    @endif

    <div class="container">
        <div class="mt-4">
            <h3><i class="fas fa-receipt"></i> Payment Summary</h3>
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <div class="card text-success">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-wallet"></i> Total Amount Paid</h5>
                            <p class="card-text">₱{{ number_format($payments->sum('amount'), 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-info">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-hand-holding-usd"></i> Total Cash Advance</h5>
                            <p class="card-text">₱{{ number_format($payments->where('status', 'completed')->sum('cash_advance_amount'), 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-warning">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-clock"></i> Pending Payments</h5>
                            <p class="card-text">{{ $billings->where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billings Table -->
        <div class="mt-4">
            <h2><i class="fas fa-file-invoice-dollar"></i> Billings</h2>
            <div class="overflow-x-auto" style="max-height: 300px; overflow-y: auto;">
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Listing</th>
                            <th class="px-4 py-2">Due Date</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Utilities</th>
                            <th class="px-4 py-2">Total Amount</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($billings as $billing)
                        <tr>
                            <td class="px-4 py-2">{{ $billing->listing->title ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $billing->due_date->format('F j, Y') }}</td>
                            <td class="px-4 py-2">
                                @if ($billing->status == 'processing')
                                    <i class="fas fa-spinner fa-spin text-primary"></i> Processing
                                @else
                                    <i class="fas fa-info-circle text-secondary"></i> {{ ucfirst($billing->status) }}
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <ul class="list-disc list-inside">
                                    @foreach ($billing->utility as $utility)
                                    <li>
                                        <i class="fas fa-bolt"></i> <strong>{{ ucfirst($utility->type) }}</strong>:
                                        ₱{{ number_format($utility->amount, 2) }}
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            @php
                                $utilityTotal = $billing->utility->sum('amount');
                                $grandTotal = $billing->amount + $utilityTotal;
                            @endphp
                            <td class="px-4 py-2">
                                ₱{{ number_format($grandTotal, 2) }}<br>
                                <small class="text-gray-500 text-sm">(₱{{ number_format($billing->amount, 2) }} + ₱{{ number_format($utilityTotal, 2) }})</small>
                            </td>
                            <td class="px-4 py-2">
                                @if ($billing->status == 'pending' || $billing->status == 'failed')
                                    <form action="{{ route('tenant.payment.create', $billing->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mt-2">
                                            <i class="fas fa-credit-card"></i> Pay
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Payment History -->
            <div class="mt-5">
                <h2><i class="fas fa-history"></i> Payment History</h2>
                <div class="overflow-x-auto" style="max-height: 300px; overflow-y: auto;">
                    <table class="table-auto w-full border-collapse border border-gray-400">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-400 px-4 py-2">Amount</th>
                                <th class="border border-gray-400 px-4 py-2">Payment Method</th>
                                <th class="border border-gray-400 px-4 py-2">Cash Advance</th>
                                <th class="border border-gray-400 px-4 py-2">Date</th>
                                <th class="border border-gray-400 px-4 py-2">Status</th>
                                <th class="border border-gray-400 px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td class="border border-gray-400 px-4 py-2">₱{{ number_format($payment->amount, 2) }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    <i class="fas fa-university"></i> {{ ucfirst($payment->payment_method) }}
                                </td>
                                <td class="border border-gray-400 px-4 py-2">
                                    ₱{{ number_format($payment->cash_advance_amount, 2) }}
                                </td>
                                <td class="border border-gray-400 px-4 py-2">{{ $payment->created_at->format('F j, Y') }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    <i class="fas fa-check-circle text-success"></i> {{ ucfirst($payment->status) }}
                                </td>
                                <td class="border border-gray-400 px-4 py-2">
                                    <a href="{{ route('receipt.download', $payment->id) }}">
                                        <i class="fas fa-download"></i> Receipt
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (session('success') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.Modal(document.getElementById('feedbackModal')).show();
        });
    </script>
    @endif
</div>
@endsection
