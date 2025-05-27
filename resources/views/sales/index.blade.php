@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container py-5">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-bottom mb-4 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-dark">
                    {{ __('Sales Report') }}
                </h1>
                <p class="text-muted mb-0">Track your property rental performance and payments</p>
            </div>
            <div class="text-end">
                <div class="text-muted small">Last updated</div>
                <div class="fw-semibold">
                    {{ now()->format('M d, Y H:i') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics Section -->
    <div class="row g-4 mb-4">
        <!-- Total Revenue Card -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Revenue</h6>
                            <p class="small text-muted mb-2">This Month</p>
                            <h3 class="mb-0 text-success">₱{{ number_format($monthlyRevenue, 2) }}</h3>
                        </div>
                        <div class="bg-success rounded-circle p-3">
                            <i class="fas fa-wallet text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Payments Card -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Pending Payments</h6>
                            <p class="small text-muted mb-2">Awaiting Collection</p>
                            <h3 class="mb-0 text-warning">₱{{ number_format($pendingPayments, 2) }}</h3>
                        </div>
                        <div class="bg-warning rounded-circle p-3">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Properties Card -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Properties</h6>
                            <p class="small text-muted mb-2">Active Listings</p>
                            <h3 class="mb-0 text-primary">{{ $totalProperties }}</h3>
                        </div>
                        <div class="bg-primary rounded-circle p-3">
                            <i class="fas fa-home text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Monthly Revenue Trend</h5>
                    <div style="height: 300px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Payments</h5>
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

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('sales.index') }}" method="GET">
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
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartElement = document.getElementById('revenueChart');
        
        if (chartElement) {
            try {
                const ctx = chartElement.getContext('2d');
                const monthlyLabels = {!! json_encode($monthlyLabels ?? []) !!};
                const monthlyValues = {!! json_encode($monthlyValues ?? []) !!};
                
                if (!Array.isArray(monthlyLabels) || !Array.isArray(monthlyValues)) {
                    console.warn('Chart data is not in expected format');
                    return;
                }
                
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthlyLabels,
                        datasets: [{
                            label: 'Monthly Revenue (₱)',
                            data: monthlyValues,
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13, 110, 253, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '₱' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error creating revenue chart:', error);
                chartElement.parentElement.innerHTML = `
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <h5>Unable to load chart</h5>
                        <p class="small">Please refresh the page or contact support</p>
                    </div>
                `;
            }
        }
    });
</script>
@endpush
@endsection
