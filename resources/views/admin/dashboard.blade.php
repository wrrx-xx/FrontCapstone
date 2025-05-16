@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold text-primary">Admin Dashboard</h1>
                
            </div>

            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <!-- Total Owners -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                                <h6 class="text-muted m-0">Total Owners</h6>
                            </div>
                            <h2 class="mb-0 mt-auto fw-bold">{{ $totalOwners }}</h2>
                            <div class="text-success small mt-2">
                                <i class="fas fa-arrow-up me-1"></i> 12% increase
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Listings -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                    <i class="fas fa-home text-success"></i>
                                </div>
                                <h6 class="text-muted m-0">Total Listings</h6>
                            </div>
                            <h2 class="mb-0 mt-auto fw-bold">{{ $totalListings }}</h2>
                            <div class="text-success small mt-2">
                                <i class="fas fa-arrow-up me-1"></i> 8% increase
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Maintenance Requests -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                                    <i class="fas fa-tools text-warning"></i>
                                </div>
                                <h6 class="text-muted m-0">Maintenance Requests</h6>
                            </div>
                            <h2 class="mb-0 mt-auto fw-bold">{{ $totalMaintenanceRequests }}</h2>
                            <div class="text-danger small mt-2">
                                <i class="fas fa-arrow-down me-1"></i> 3% decrease
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Payments -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                                    <i class="fas fa-credit-card text-info"></i>
                                </div>
                                <h6 class="text-muted m-0">Payments Processed</h6>
                            </div>
                            <h2 class="mb-0 mt-auto fw-bold">{{ $totalPayments }}</h2>
                            <div class="text-success small mt-2">
                                <i class="fas fa-arrow-up me-1"></i> 15% increase
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Recent Listings -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0 fw-bold">Recent Listings</h5>
                            <a href="#" class="text-decoration-none">View All</a>
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
                                        <div class="list-group-item border-0 py-3">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <a href="{{ route('listing.detail', $listing->id) }}"
                                                        class="text-decoration-none fw-semibold">{{ $listing->title }}</a>
                                                    <p class="text-muted mb-0 small">
                                                        {{ $listing->user->fname ?? 'Unknown' }}
                                                        {{ $listing->user->lname ?? '' }}</p>
                                                </div>
                                                <div class="text-end">
                                                    <span
                                                        class="badge bg-light text-dark">{{ $listing->created_at->format('M d, Y') }}</span>
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
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0 fw-bold">Recent Maintenance Requests</h5>
                            <a href="#" class="text-decoration-none">View All</a>
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
                                        <div class="list-group-item border-0 py-3">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-1">{{ $request->title }}</h6>
                                                    <span
                                                        class="
                                                badge
                                                @if ($request->status == 'Pending') bg-warning text-dark 
                                                @elseif($request->status == 'In Progress') bg-info text-dark
                                                @elseif($request->status == 'Completed') bg-success
                                                @else bg-secondary @endif
                                            ">{{ $request->status }}</span>
                                                </div>
                                                <div class="text-end">
                                                    <span
                                                        class="badge bg-light text-dark">{{ $request->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Analytics Summary -->
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">Monthly Activity Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info bg-info bg-opacity-10 border-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Add your analytics charts and graphs here for a visual representation of your data
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            .card {
                transition: transform 0.2s;
            }

            .card:hover {
                transform: translateY(-5px);
            }
        </style>
    @endpush
@endsection
