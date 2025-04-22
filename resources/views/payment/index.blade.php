@extends('layouts.app')

@section('content')
    <div class="main-content">
        <h1 class="mb-4 text-primary">Your Listings</h1>
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Listing</th>
                    <th>Tenant Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listings as $listing)
                            <tr class="align-middle">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            @if ($listing->photos->isNotEmpty())
                                                <img class="rounded shadow"
                                                    src="{{ asset('storage/' . $listing->photos->first()->photo_url) }}"
                                                    alt="{{ $listing->title }}" style="max-width: 120px; height: auto;">
                                            @else
                                                <img class="rounded shadow" src="{{ asset('path/to/default/image.jpg') }}"
                                                    alt="Default Image" style="max-width: 120px; height: auto;">
                                            @endif
                                        </div>
                                        <a data-bs-toggle="collapse" href="#listing-{{ $listing->id }}" role="button"
                                            aria-expanded="false" aria-controls="listing-{{ $listing->id }}"
                                            class="text-decoration-none">
                                            <strong class="text-dark">{{ $listing->title }}</strong>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    @if ($listing->tenant)
                                        <span class="text-success">{{ $listing->tenant->fname }} {{ $listing->tenant->mname }}
                                            {{ $listing->tenant->lname }}</span>
                                    @else
                                        <span class="text-danger">No Tenant</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" data-bs-toggle="collapse"
                                        data-bs-target="#listing-{{ $listing->id }}" aria-expanded="false"
                                        aria-controls="listing-{{ $listing->id }}">
                                        Toggle Details
                                    </button>
                                </td>
                            </tr>
                            <tr class="collapse" id="listing-{{ $listing->id }}">
                                <td colspan="3" class="bg-light">
                                    <div class="p-3">


                                        <h5 class="text-primary mt-3">Billings</h5>
                                        @php
                                            $listingUtilities = $billings
                                                ->where('listing_id', $listing->id)
                                                ->flatMap->utility->sum('amount');
                                            $listingBillingAmount = $billings->where('listing_id', $listing->id)->sum('amount');
                                            $listingGrandTotal = $listingUtilities + $listingBillingAmount;
                                        @endphp
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                            </li>

                                            @foreach ($billings as $billing)
                                                        @if ($billing->listing_id == $listing->id)
                                                        <li class="list-group-item py-1">
                                                            <div class="row text-center text-md-start">
                                                                <!-- Total Amount -->
                                                                <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex flex-column justify-content-center align-items-center align-items-md-start">
                                                                    <strong>Total Amount:</strong>
                                                                    <div>₱{{ number_format($billing->amount + $billing->utility->sum('amount'), 2) }}</div>
                                                                    <small class="text-muted d-block mt-1">
                                                                        (₱{{ number_format($billing->amount, 2) }} +
                                                                        ₱{{ number_format($billing->utility->sum('amount'), 2) }})
                                                                    </small>
                                                                </div>
                                                        
                                                                <!-- Utilities -->
                                                                <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex flex-column justify-content-center">
                                                                    <strong>Utilities:</strong>
                                                                    <ul class="list-unstyled mb-0">
                                                                        @foreach ($billing->utility as $utility)
                                                                            <li>
                                                                                {{ $utility->type ?? 'Utility' }}:
                                                                                ₱{{ number_format($utility->amount, 2) }}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                        
                                                                <!-- Billing Info -->
                                                                <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-items-center align-items-md-end">
                                                                    <div class="mb-1">Due Date: {{ $billing->due_date->format('m-d-Y') }}</div>
                                                                    <div class="mb-1">
                                                                        Status: 
                                                                        <span class="badge bg-{{ $billing->status === 'paid' ? 'success' : ($billing->status === 'failed' ? 'danger' : 'warning') }}">
                                                                            @if ($billing->status == 'processing')
                                                                                <i class="fas fa-spinner fa-spin"></i> Waiting for Approval
                                                                            @else
                                                                                {{ ucfirst($billing->status) }}
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                    @if ($billing->status == 'processing')
                                                                        <div class="mt-2">
                                                                            <form action="{{ route('billing.approve', $billing->id) }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-success btn-sm me-1">Approve</button>
                                                                            </form>
                                                                            <form action="{{ route('billing.decline', $billing->id) }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                                                            </form>
                                                                            
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        @endif
                                            @endforeach
                                    </ul>
                                    <h5 class="text-primary mt-3">Payments</h5>
                                    <ul class="list-group">
                                        @foreach ($payments as $payment)
                                            @if ($payment->listing_id == $listing->id)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>

                                                        Amount: ₱{{ number_format($payment->amount, 2) }} -
                                                        Status: <span
                                                            class="badge bg-{{ $payment->status === 'completed' ? 'success' : 'warning' }}">{{ ucfirst($payment->status) }}</span>
                                                        -
                                                        Date: {{ $payment->created_at->format('Y-m-d') }}
                                                    </span>
                                                    <a href="{{ route('receipt.download', $payment->id) }}"
                                                        class="btn btn-outline-primary btn-sm ms-2">Download Receipt</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                @endforeach
            </tbody>
        </table>
    

     <style>
        .table-hover tbody tr:hover {
            background-color: #f 0f0f0;
        }

        .rounded {
            border-radius: 0.5rem;
        }

        .shadow {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }
        </style>
    </div>
@endsection