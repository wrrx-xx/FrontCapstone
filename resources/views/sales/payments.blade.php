@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-bottom mb-4 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-dark">All Payments</h1>
                <p class="text-muted mb-0">View and manage all payment records</p>
            </div>
            <div>
                <button class="btn btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Export
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('sales.payments') }}" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter Payments</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Payment Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date Range</label>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col">
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Date & Time</th>
                            <th>Property Details</th>
                            <th>Tenant Information</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td>
                                <div class="fw-medium">{{ $payment->created_at->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $payment->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                <div class="fw-medium">{{ Str::limit($payment->listing->title, 40) }}</div>
                                <small class="text-muted">ID: #{{ $payment->listing->id }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white me-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        {{ substr($payment->listing->tenant->fname ?? 'N', 0, 1) }}{{ substr($payment->listing->tenant->lname ?? 'A', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{ $payment->listing->tenant->fname ?? 'N/A' }} {{ $payment->listing->tenant->lname ?? '' }}</div>
                                        <small class="text-muted">Tenant</small>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-bold">₱{{ number_format($payment->amount, 2) }}</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'completed' => 'success',
                                        'pending' => 'warning',
                                        'failed' => 'danger',
                                        'overdue' => 'danger'
                                    ][$payment->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">{{ ucfirst($payment->status) }}</span>
                            </td>
                            <td>
                                <a href="{{ route('sales.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-file-invoice fa-3x mb-3"></i>
                                    <h5 class="mb-2">No Payments Found</h5>
                                    <p class="mb-3">There are no payment records matching your criteria.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($payments->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $payments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection 