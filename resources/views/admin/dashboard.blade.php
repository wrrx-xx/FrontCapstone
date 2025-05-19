@extends('layouts.app')

@section('content')
    <div class="main-content">
        
        <div class="container py-4">
            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 bg-primary text-white shadow-lg rounded-4 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h1 class="text-white display-6 fw-bold mb-0">Welcome to Dashboard</h1>
                                    <p class="mb-0 opacity-75">Here's what's happening with your properties today</p>
                                </div>
                                <div class="d-none d-md-block">
                                    <i class="fas fa-chart-line fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-primary bg-opacity-75 py-3">
                            <div class="d-flex gap-3">
                                <span><i class="fas fa-calendar-alt me-2"></i>{{ date('F d, Y') }}</span>
                                <span><i class="fas fa-clock me-2"></i>Last update: 2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <!-- Total Owners -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body position-relative p-4">
                            <div class="position-absolute top-0 end-0 mt-3 me-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                            </div>
                            <h6 class="text-muted mb-4">Total Owners</h6>
                            <div class="d-flex align-items-baseline">
                                <h2 class="fw-bold mb-0 me-2">{{ $totalOwners }}</h2>
                                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">
                                    <i class="fas fa-arrow-up me-1"></i>12%
                                </span>
                            </div>
                            <div class="progress mt-3" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 72%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Listings -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body position-relative p-4">
                            <div class="position-absolute top-0 end-0 mt-3 me-3">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                    <i class="fas fa-home text-success"></i>
                                </div>
                            </div>
                            <h6 class="text-muted mb-4">Total Listings</h6>
                            <div class="d-flex align-items-baseline">
                                <h2 class="fw-bold mb-0 me-2">{{ $totalListings }}</h2>
                                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">
                                    <i class="fas fa-arrow-up me-1"></i>8%
                                </span>
                            </div>
                            <div class="progress mt-3" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Maintenance Requests -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body position-relative p-4">
                            <div class="position-absolute top-0 end-0 mt-3 me-3">
                                <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                                    <i class="fas fa-tools text-warning"></i>
                                </div>
                            </div>
                            <h6 class="text-muted mb-4">Maintenance Requests</h6>
                            <div class="d-flex align-items-baseline">
                                <h2 class="fw-bold mb-0 me-2">{{ $totalMaintenanceRequests }}</h2>
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1">
                                    <i class="fas fa-arrow-down me-1"></i>3%
                                </span>
                            </div>
                            <div class="progress mt-3" style="height: 6px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 43%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Payments -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body position-relative p-4">
                            <div class="position-absolute top-0 end-0 mt-3 me-3">
                                <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                    <i class="fas fa-credit-card text-info"></i>
                                </div>
                            </div>
                            <h6 class="text-muted mb-4">Payments Processed</h6>
                            <div class="d-flex align-items-baseline">
                                <h2 class="fw-bold mb-0 me-2">{{ $totalPayments }}</h2>
                                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">
                                    <i class="fas fa-arrow-up me-1"></i>15%
                                </span>
                            </div>
                            <div class="progress mt-3" style="height: 6px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity & Overview Section -->
            <div class="row g-4 mb-4">
                <!-- Activity Chart -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0 fw-bold">Monthly Activity Summary</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="activityTimeRange" data-bs-toggle="dropdown" aria-expanded="false">
                                    Last 30 Days
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="activityTimeRange">
                                    <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                                    <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                                    <li><a class="dropdown-item" href="#">Last 3 Months</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="chart-container" style="position: relative; height:280px;">
                                <canvas id="activityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
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

            <!-- Recent Activities Section -->
            <div class="row g-4">
                <!-- Recent Listings -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0 fw-bold">Recent Listings</h5>
                            <a href="#" class="btn btn-sm btn-primary">View All</a>
                        </div>
                        <div class="card-body p-0">
                            @if ($recentListings->isEmpty())
                                <div class="p-4 text-center text-muted">
                                    <i class="fas fa-home fa-3x mb-3 opacity-50"></i>
                                    <p>No recent listings found.</p>
                                </div>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach ($recentListings as $listing)
                                        <div class="list-group-item border-0 py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-circle bg-primary bg-opacity-10 text-primary">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <a href="{{ route('listing.detail', $listing->id) }}"
                                                                class="text-decoration-none fw-semibold">{{ $listing->title }}</a>
                                                            <p class="text-muted mb-0 small">
                                                                By {{ $listing->user->fname ?? 'Unknown' }}
                                                                {{ $listing->user->lname ?? '' }}
                                                            </p>
                                                        </div>
                                                        <div class="text-end">
                                                            <span class="badge bg-light text-dark">{{ $listing->created_at->format('M d') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Recent Maintenance Requests -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0 fw-bold">Recent Maintenance Requests</h5>
                            <a href="#" class="btn btn-sm btn-primary">View All</a>
                        </div>
                        <div class="card-body p-0">
                            @if ($recentMaintenanceRequests->isEmpty())
                                <div class="p-4 text-center text-muted">
                                    <i class="fas fa-tools fa-3x mb-3 opacity-50"></i>
                                    <p>No recent maintenance requests found.</p>
                                </div>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach ($recentMaintenanceRequests as $request)
                                        <div class="list-group-item border-0 py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="
                                                    avatar-circle
                                                    @if ($request->status == 'Pending') bg-warning bg-opacity-10 text-warning
                                                    @elseif($request->status == 'In Progress') bg-info bg-opacity-10 text-info
                                                    @elseif($request->status == 'Completed') bg-success bg-opacity-10 text-success
                                                    @else bg-secondary bg-opacity-10 text-secondary @endif
                                                    ">
                                                        <i class="fas fa-tools"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <h6 class="mb-1">{{ $request->title }}</h6>
                                                            <span class="
                                                            badge
                                                            @if ($request->status == 'Pending') bg-warning text-dark
                                                            @elseif($request->status == 'In Progress') bg-info text-dark
                                                            @elseif($request->status == 'Completed') bg-success
                                                            @else bg-secondary @endif
                                                            ">{{ $request->status }}</span>
                                                        </div>
                                                        <div class="text-end">
                                                            <span class="badge bg-light text-dark">{{ $request->created_at->format('M d') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            .main-content {
                background-color: #f8f9fa;
                min-height: 100vh;
                padding: 1.5rem 0;
            }
            
            .card {
                transition: all 0.3s ease;
                border-radius: 15px;
            }
            
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
            }
            
            .avatar-circle {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .progress {
                border-radius: 10px;
                background-color: #f0f0f0;
            }
            
            .list-group-item:hover {
                background-color: #f8f9fa;
            }
            
            .rounded-4 {
                border-radius: 15px !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Activity Chart
                const ctx = document.getElementById('activityChart').getContext('2d');
                const activityChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Listings',
                            data: [12, 19, 13, 15, 20, 25, 22, 30, 28, 25, 22, 24],
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13, 110, 253, 0.1)',
                            tension: 0.4,
                            fill: true
                        }, {
                            label: 'Maintenance Requests',
                            data: [8, 15, 9, 12, 17, 13, 18, 15, 22, 19, 16, 14],
                            borderColor: '#fd7e14',
                            backgroundColor: 'rgba(253, 126, 20, 0.1)',
                            tension: 0.4,
                            fill: true
                        }, {
                            label: 'Payments',
                            data: [5, 10, 8, 15, 12, 18, 15, 22, 20, 25, 22, 20],
                            borderColor: '#198754',
                            backgroundColor: 'rgba(25, 135, 84, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'end',
                                labels: {
                                    boxWidth: 10,
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        },
                        elements: {
                            point: {
                                radius: 3,
                                hoverRadius: 6
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
