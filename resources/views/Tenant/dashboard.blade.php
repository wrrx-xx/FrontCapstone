@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
                <h2 class="m-0">Welcome {{ Auth::user()->fname }}!</h2>
                <div class="current-date text-muted">
                    <i class="fas fa-calendar-alt me-2"></i>{{ now()->format('F d, Y') }}
                </div>
            </div>

            <!-- Stats Overview Cards -->
            <div class="row">
                <!-- Current Rental Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary h-100 shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-3">
                                        <i class="fas fa-home text-primary me-2"></i>Current Rental
                                    </h5>
                                    @if ($listings->count() > 0)
                                        @foreach ($listings as $listing)
                                            <h6 class="mb-2">{{ $listing->title }}</h6>
                                            <p class="card-text mb-1">
                                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                                {{ $listing->address }}
                                            </p>
                                            <p class="card-text mb-0">
                                                <i class="fas fa-calendar-check text-muted me-2"></i>
                                                Lease start:
                                                @php
                                                    $firstCompletedPayment = \App\Models\Payment::where(
                                                        'listing_id',
                                                        $listing->id,
                                                    )
                                                        ->where('status', 'completed')
                                                        ->orderBy('created_at', 'asc')
                                                        ->first();
                                                @endphp
                                                @if ($firstCompletedPayment)
                                                    {{ \Carbon\Carbon::parse($firstCompletedPayment->created_at)->format('M d, Y') }}
                                                @else
                                                    Not started
                                                @endif
                                            </p>
                                        @endforeach
                                    @else
                                        <p class="card-text text-muted">No active rental</p>
                                    @endif
                                </div>
                                <div class="ms-3">
                                    <a href="{{ route('tenant.rental.index') }}" class="btn btn-light btn-sm">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Due Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning h-100 shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-3">
                                        <i class="fas fa-money-bill-wave text-warning me-2"></i>Upcoming Payment
                                    </h5>
                                    @if ($upcomingBilling)
                                        <h4 class="mb-2">₱{{ number_format($upcomingBilling->amount, 2) }}</h4>
                                        <p class="card-text mb-1">
                                            Due on:
                                            {{ \Carbon\Carbon::parse($upcomingBilling->due_date)->format('M d, Y') }}
                                        </p>
                                        <div class="mt-3">
                                            <a href="{{ route('tenant.payment.create', $upcomingBilling->id) }}"
                                                class="btn btn-warning btn-sm">Pay Now</a>
                                        </div>
                                    @else
                                        <p class="card-text text-muted">No pending payments</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maintenance Requests Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-danger h-100 shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-3">
                                        <i class="fas fa-tools text-danger me-2"></i>Maintenance
                                    </h5>
                                    <h4 class="mb-2">{{ $pendingMaintenanceCount }}</h4>
                                    <p class="card-text mb-1">Pending Requests</p>
                                    <div class="mt-3">
                                        <a href="{{ route('tenant.maintenance.create') }}"
                                            class="btn btn-outline-danger btn-sm">New Request</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="row">
                <div class="col-xl-8 col-lg-7 mb-4">
                    <div class="card shadow">
                        <div class="card-header bg-transparent">
                            <h6 class="m-0 font-weight-bold text-primary">Recent Maintenance Requests</h6>
                        </div>
                        <div class="card-body">
                            @if ($maintenanceRequests->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Title</th>
                                                <th>Priority</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($maintenanceRequests as $request)
                                                <tr>
                                                    <td>{{ $request->title }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $request->priority === 'High' ? 'danger' : ($request->priority === 'Medium' ? 'warning' : 'success') }}">
                                                            {{ $request->priority }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $request->status === 'Pending' ? 'secondary' : ($request->status === 'In Progress' ? 'primary' : 'success') }}">
                                                            {{ $request->status }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $request->created_at->format('M d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted mb-0">No maintenance requests yet.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="col-xl-4 col-lg-5 mb-4">
                    <div class="card shadow">
                        <div class="card-header bg-transparent">
                            <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                        </div>
                        <div class="card-body">
                            <div class="quick-actions">
                                <a href="{{ route('tenant.maintenance.create') }}"
                                    class="btn btn-light btn-block mb-3 w-100 text-start">
                                    <i class="fas fa-tools text-primary me-2"></i>Submit Maintenance Request
                                </a>
                                <a href="{{ route('tenant.payment.index') }}"
                                    class="btn btn-light btn-block mb-3 w-100 text-start">
                                    <i class="fas fa-file-invoice-dollar text-success me-2"></i>View Payment History
                                </a>
                                {{-- <a href="{{ route('tenant.support.create') }}" class="btn btn-light btn-block mb-3 w-100 text-start"> --}}
                                <i class="fas fa-headset text-info me-2"></i>Contact Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .border-left-primary {
                border-left: 4px solid #4e73df !important;
            }

            .border-left-warning {
                border-left: 4px solid #f6c23e !important;
            }

            .border-left-danger {
                border-left: 4px solid #e74a3b !important;
            }

            .quick-actions .btn {
                transition: all 0.3s;
            }

            .quick-actions .btn:hover {
                transform: translateX(5px);
                background-color: #f8f9fa;
            }

            .card {
                transition: transform 0.2s;
            }

            .card:hover {
                transform: translateY(-5px);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize any JavaScript functionality here
            });
        </script>
    @endpush
@endsection
