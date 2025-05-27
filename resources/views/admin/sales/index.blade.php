@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container py-5">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-bottom mb-4 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-dark">
                    {{ __('Sales Report by Owners') }}
                </h1>
                <p class="text-muted mb-0">Track property rental performance and payments by owner</p>
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
                            <p class="small text-muted mb-2">Filtered Period</p>
                            <h3 class="mb-0 text-success">₱{{ number_format($query->sum('total_sales'), 2) }}</h3>
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
                            <h3 class="mb-0 text-warning">₱{{ number_format($query->sum('pending_payments'), 2) }}</h3>
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
                            <h3 class="mb-0 text-primary">{{ $query->sum('total_properties') }}</h3>
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

    <!-- Owners Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Owners Sales Summary</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Owner Name</th>
                            <th>Email</th>
                            <th>Total Properties</th>
                            <th>Total Sales</th>
                            <th>Pending Payments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($query as $owner)
                        <tr>
                            <td>{{ $owner->fname }} {{ $owner->lname }}</td>
                            <td>{{ $owner->email }}</td>
                            <td>{{ $owner->total_properties }}</td>
                            <td>₱{{ number_format($owner->total_sales, 2) }}</td>
                            <td>₱{{ number_format($owner->pending_payments, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $query->withQueryString()->links() }}
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
