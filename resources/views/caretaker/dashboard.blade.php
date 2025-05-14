@extends('layouts.app')

@push('styles')
<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('chartJSContainer').getContext('2d');
    
    // Get the listings data from PHP
    const payments = @json($payments);
    const listings = @json($listings);
    
    // Process payments data by month
    const monthlyPayments = payments.reduce((acc, payment) => {
        const date = new Date(payment.created_at);
        const monthYear = date.toLocaleString('default', { month: 'short', year: 'numeric' });
        
        if (!acc[monthYear]) {
            acc[monthYear] = {
                total: 0,
                count: 0
            };
        }
        acc[monthYear].total += parseFloat(payment.amount);
        acc[monthYear].count += 1;
        return acc;
    }, {});

    // Convert to arrays for Chart.js
    const labels = Object.keys(monthlyPayments);
    const amounts = Object.values(monthlyPayments).map(p => p.total);
    const counts = Object.values(monthlyPayments).map(p => p.count);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Monthly Revenue',
                    data: amounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1,
                    yAxisID: 'y'
                },
                {
                    label: 'Number of Payments',
                    data: counts,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgb(255, 159, 64)',
                    borderWidth: 1,
                    type: 'line',
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Monthly Payment Analytics'
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Revenue (₱)'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Number of Payments'
                    },
                    grid: {
                        drawOnChartArea: false
                    }
                }
            }
        }
    });
});
</script>
@endpush

@section('content')
<!-- Main content START -->
<div class="main-content dashboard-container">
    <div class="container">
            @if (session('success') || $errors->any())
            <!-- Feedback Modal -->
            @include('components.feedback-modal')
        @endif
    <div class="row">
        <div class="col-12">
            <!-- Page title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0">Caretaker Dashboard</h2>
                <p class="text-muted mb-0">Welcome back! Here's what's happening today.</p>
            </div>
            <div class="text-end">
                <p class="mb-0 text-muted"><i class="fas fa-calendar-alt me-2"></i>{{ now()->format('F d, Y') }}</p>
                <small class="text-muted">Last updated: {{ now()->format('h:i A') }}</small>
            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <!-- Svg -->
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                    </svg>

                    @if($maintenanceRequests->isNotEmpty())
                    <!-- Maintenance Alert -->
                    <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show custom-alert" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            You have {{ $maintenanceRequests->count() }} pending maintenance request(s)
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if($payments->isNotEmpty())
                    <!-- Payment Alert -->
                    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show mb-5 custom-alert" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>
                            You have received {{ $payments->count() }} new payment(s)
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row align-item-center">
                        <!-- Item -->
                        <div class="col-sm-9 col-xxl-3 mb-5 mb-xxl-0">
                            <div class="bg-danger d-flex justify-content-between align-items-center p-3 rounded stats-card">
                                <span class="display-5 text-white opacity-5"><i class="fas fa-fw fa-home"></i></span>
                                <div class="text-center">
                                    <h3 class="mb-0 text-white">{{ $listings->count() }}</h3>
                                    <p class="mb-0 text-white">Total Properties</p>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Item -->
                        <div class="col-sm-9 col-xxl-3 mb-5 mb-xxl-0">
                            <div class="bg-info d-flex justify-content-between align-items-center p-3 rounded stats-card">
                                <span class="display-5 text-white opacity-5"><i class="fas fa-fw fa-eye"></i></span>
                                <div class="text-center">
                                    <h3 class="mb-0 text-white">{{ $listings->sum('view_count') }}</h3>
                                    <p class="mb-0 text-white">Bookings</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="col-sm-9 col-xxl-3 mb-5 mb-xxl-0">
                            <div class="bg-orange d-flex justify-content-between align-items-center p-3 rounded stats-card">
                                <span class="display-5 text-white opacity-5"><i class="fas fa-hand-holding-usd"></i></span>
                                <div class="text-center">
                                    <h3 class="mb-0 text-white">{{ $payments->count() }}</h3>
                                    <p class="mb-0 text-white">Total Payments</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row END -->

                    <div class="row mt-5">
                        <!-- Chart -->
                        <div class="col-xl-7 mb-5 mb-xl-0">
                           <div class="bg-secondary-soft p-4 rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Maintenance Tasks Overview</h4>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-outline-primary active">Week</button>
            <button type="button" class="btn btn-sm btn-outline-primary">Month</button>
        </div>
    </div>

    <!-- Task Categories -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="p-3 bg-danger bg-opacity-10 rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-danger mb-1">Urgent</h6>
                        <h4 class="mb-0">{{ $maintenanceRequests->where('priority', 'Urgent')->count() }}</h4>
                    </div>
                    <div class="fs-4 text-danger">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="p-3 bg-warning bg-opacity-10 rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-warning mb-1">In Progress</h6>
                        <h4 class="mb-0">{{ $maintenanceRequests->where('status', 'In Progress')->count() }}</h4>
                    </div>
                    <div class="fs-4 text-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="p-3 bg-success bg-opacity-10 rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-success mb-1">Completed</h6>
                        <h4 class="mb-0">{{ $maintenanceRequests->where('status', 'Completed')->count() }}</h4>
                    </div>
                    <div class="fs-4 text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="p-3 bg-info bg-opacity-10 rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-info mb-1">Pending</h6>
                        <h4 class="mb-0">{{ $maintenanceRequests->where('status', 'Pending')->count() }}</h4>
                    </div>
                    <div class="fs-4 text-info">
                        <i class="fas fa-hourglass-start"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tasks List -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Room</th>
                    <th>Issue</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Scheduled</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maintenanceRequests->take(5) as $task)
                <tr>
                    <td>{{ $task->listing->title }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="me-2">
                                @if($task->category === 'Plumbing')
                                    <i class="fas fa-faucet text-primary"></i>
                                @elseif($task->category === 'Electrical')
                                    <i class="fas fa-bolt text-warning"></i>
                                @elseif($task->category === 'Appliance')
                                    <i class="fas fa-tv text-info"></i>
                                @else
                                    <i class="fas fa-tools text-secondary"></i>
                                @endif
                            </span>
                            {{ $task->title }}
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-{{ $task->priority === 'Urgent' ? 'danger' : ($task->priority === 'High' ? 'warning' : 'info') }}">
                            {{ $task->priority }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $task->status === 'Completed' ? 'success' : ($task->status === 'In Progress' ? 'primary' : 'secondary') }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td>{{ $task->preferred_schedule ? \Carbon\Carbon::parse($task->preferred_schedule)->format('M d, Y') : 'Not set' }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('owner.maintenance.index', $task->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('owner.maintenance.index', $task->id) }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3">
                        <div class="text-muted">
                            <i class="fas fa-clipboard-check fs-4 mb-3"></i>
                            <p class="mb-0">No maintenance tasks found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Actions -->
    <div class="text-end mt-3">
        <a href="{{ route('owner.maintenance.index') }}" class="btn btn-primary">
            View All Tasks
        </a>
    </div>
</div>
                        </div>
                        <div class="col-xl-5">
                            <div class="bg-secondary-soft p-4 rounded activity-container">
                                <!-- Title -->
                                <h4 class="mb-4 mt-0 fw-bold">Recent Activity</h4>
                                <ul class="list-inline mb-4">
                                    @foreach($maintenanceRequests->take(3) as $request)
                                    <li class="list-inline-item activity-item">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 text-warning activity-icon">
                                                <i class="fas fa-tools"></i>
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark">Maintenance request for {{ $request->listing->title }}</p>
                                                <div class="small">{{ $request->created_at->format('d F Y') }}</div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                    @foreach($payments->take(2) as $payment)
                                    <li class="list-inline-item activity-item">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 text-success activity-icon">
                                                <i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark">Payment received for {{ $payment->listing->title }}</p>
                                                <div class="small">{{ $payment->created_at->format('d F Y') }}</div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                    @foreach($viewings->take(2) as $viewing)
                                    <li class="list-inline-item activity-item">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 text-primary activity-icon">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark">Viewing request for {{ $viewing->listing->title }}</p>
                                                <div class="small">{{ $viewing->created_at->format('d F Y') }}</div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <!-- button -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary-soft">View all</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Row END -->
        </div>
    </div> <!-- Row END -->
    @if (session('success') || $errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Modal(document.getElementById('feedbackModal')).show();
    });
    
</script>
@endif
</div>
<!-- Main content END -->
@endsection
