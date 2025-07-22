@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-primary mb-1">Booking Management</h1>
            <p class="text-muted">View and manage property viewings organized by owner</p>
        </div>
        <div>
           
                 <a href="{{ route('admin.booking.create') }}" class="btn btn-outline-primary">
        <i class="fas fa-plus me-1"></i> Create Booking
    </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Owner Cards Container -->
    <div class="row g-4 owners-container">
        @if($ownersViewings->isEmpty())
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="empty-state mb-4">
                        <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No Bookings Found</h4>
                        <p class="text-muted">There are currently no property viewings to display.</p>
                        <a href="{{ route('admin.booking.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus me-1"></i> Create New Booking
                        </a>
                    </div>
                </div>
            </div>
        @else
            @foreach($ownersViewings as $ownerId => $viewings)
                @php
                    $owner = $viewings->first()->listing->user;
                    $pendingCount = $viewings->where('viewing_status', 'pending')->count();
                    $approvedCount = $viewings->where('viewing_status', 'approved')->count();
                    $declinedCount = $viewings->where('viewing_status', 'declined')->count();
                    $cancelledCount = $viewings->where('viewing_status', 'cancelled')->count();
                @endphp
                
                <div class="col-12">
                    <div class="owner-card mb-4">
                        <!-- Owner Header -->
                        <div class="owner-card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="owner-avatar me-3">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">{{ $owner->fname }} {{ $owner->lname }}</h5>
                                            <span class="badge bg-primary">Owner</span>
                                            <span class="text-muted ms-2">{{ $viewings->count() }} viewings</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-md-end mt-3 mt-md-0">
                                        <div class="d-flex status-pills">
                                            <div class="status-pill">
                                                <span class="badge rounded-pill bg-warning text-dark">{{ $pendingCount }} Pending</span>
                                            </div>
                                            <div class="status-pill">
                                                <span class="badge rounded-pill bg-success">{{ $approvedCount }} Approved</span>
                                            </div>
                                            <div class="status-pill">
                                                <span class="badge rounded-pill bg-danger">{{ $declinedCount }} Declined</span>
                                            </div>
                                            <div class="status-pill">
                                                <span class="badge rounded-pill bg-secondary">{{ $cancelledCount }} Cancelled</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Owner Bookings Table -->
                        <div class="owner-card-body">
                            <div class="table-responsive">
                                <table class="table table-hover booking-table">
                                    <thead>
                                        <tr>
                                            <th>Listing</th>
                                            <th>Tenant</th>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viewings as $viewing)
                                            <tr class="align-middle @if($viewing->viewing_status == 'pending') table-warning-subtle @endif">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="listing-icon me-3">
                                                            <i class="fas fa-home"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $viewing->listing->title }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="tenant-icon me-2">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $viewing->requestedBy->fname }} {{ $viewing->requestedBy->lname }}</h6>
                                                            <small class="text-muted">{{ $viewing->requestedBy->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                                            <span>{{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-clock me-2 text-primary"></i>
                                                            <span>{{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                    @if ($viewing->viewing_status == 'approved') bg-success 
                                                    @elseif($viewing->viewing_status == 'declined') bg-danger 
                                                    @elseif($viewing->viewing_status == 'cancelled') bg-warning 
                                                    @else bg-secondary text-black @endif">
                                                        {{ ucfirst($viewing->viewing_status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button type="button" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                                            data-bs-target="#viewingModal{{ $viewing->id }}">
                                                            <i class="fas fa-eye me-1"></i> View
                                                        </button>
                                                        
                                                        @if($viewing->viewing_status == 'pending')
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $viewing->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-cog"></i>
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $viewing->id }}">
                                                                    <li>
                                                                        <form action="{{ route('booking.accept', $viewing->id) }}" method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="dropdown-item text-success">
                                                                                <i class="fas fa-check me-2"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                    <li>
                                                                        <form action="{{ route('booking.decline', $viewing->id) }}" method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="dropdown-item text-danger">
                                                                                <i class="fas fa-times me-2"></i> Decline
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @elseif($viewing->viewing_status == 'approved')
                                                            <form action="{{ route('booking.decline', $viewing->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                    <i class="fas fa-times me-1"></i> Decline
                                                                </button>
                                                            </form>
                                                        @elseif($viewing->viewing_status == 'declined')
                                                            <form action="{{ route('booking.accept', $viewing->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                                    <i class="fas fa-check me-1"></i> Accept
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <!-- Viewing Modal -->
                                            <div class="modal fade" id="viewingModal{{ $viewing->id }}" tabindex="-1"
                                                aria-labelledby="viewingModalLabel{{ $viewing->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewingModalLabel{{ $viewing->id }}">
                                                                Viewing Details
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <!-- Valid ID Flip Card -->
                                                            @if ($viewing->requestedBy->tenantProfile && $viewing->requestedBy->tenantProfile->valid_id_front_path && $viewing->requestedBy->tenantProfile->valid_id_back_path)
                                                                <div class="id-card-container mb-4">
                                                                    <h6 class="mb-3 id-card-title">
                                                                        <i class="fas fa-id-card me-2"></i> Tenant ID
                                                                        <small class="text-muted ms-2">(Click to flip)</small>
                                                                    </h6>
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="id-flip-card" onclick="this.classList.toggle('flipped')">
                                                                            <div class="id-flip-card-inner">
                                                                                <div class="id-flip-card-front">
                                                                                    <img src="{{ asset($viewing->requestedBy->tenantProfile->valid_id_front_path) }}" alt="ID Front" class="img-fluid rounded">
                                                                                </div>
                                                                                <div class="id-flip-card-back">
                                                                                    <img src="{{ asset($viewing->requestedBy->tenantProfile->valid_id_back_path) }}" alt="ID Back" class="img-fluid rounded">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            
                                                            <div class="row g-4">
                                                                <!-- Viewing Information Section -->
                                                                <div class="col-md-12">
                                                                    <div class="info-card">
                                                                        <div class="info-card-header">
                                                                            <h6 class="mb-0">
                                                                                <i class="fas fa-calendar-check me-2"></i>
                                                                                Viewing Information
                                                                            </h6>
                                                                        </div>
                                                                        <div class="info-card-body">
                                                                            <div class="row g-3">
                                                                                <div class="col-md-12">
                                                                                    <div class="d-flex align-items-center listing-info mb-3">
                                                                                        <i class="fas fa-building listing-icon me-3"></i>
                                                                                        <div>
                                                                                            <label class="info-label">Listing</label>
                                                                                            <h6 class="mb-0">{{ $viewing->listing->title }}</h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-md-6">
                                                                                    <div class="info-item">
                                                                                        <label class="info-label"><i class="fas fa-calendar-alt me-2"></i>Visit Date</label>
                                                                                        <p class="info-value">{{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="info-item">
                                                                                        <label class="info-label"><i class="fas fa-clock me-2"></i>Visit Time</label>
                                                                                        <p class="info-value">{{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="info-item">
                                                                                        <label class="info-label"><i class="fas fa-tag me-2"></i>Current Status</label>
                                                                                        <p class="info-value">
                                                                                            <span class="status-badge 
                                                                                                @if ($viewing->viewing_status == 'approved') status-approved
                                                                                                @elseif($viewing->viewing_status == 'declined') status-declined
                                                                                                @elseif($viewing->viewing_status == 'cancelled') status-cancelled
                                                                                                @else status-pending @endif">
                                                                                                <i class="fas fa-circle status-dot me-1"></i>
                                                                                                {{ ucfirst($viewing->viewing_status) }}
                                                                                            </span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Tenant Profile Details -->
                                                                <div class="col-md-12">
                                                                    <div class="info-card">
                                                                        <div class="info-card-header">
                                                                            <h6 class="mb-0">
                                                                                <i class="fas fa-user me-2"></i>
                                                                                Tenant Profile
                                                                            </h6>
                                                                        </div>
                                                                        <div class="info-card-body">
                                                                            <div class="tenant-header mb-3">
                                                                                <h6 class="fw-bold mb-1">{{ $viewing->requestedBy->fname }} {{ $viewing->requestedBy->mname }} {{ $viewing->requestedBy->lname }}</h6>
                                                                            </div>
                                                                        
                                                                            @if ($viewing->requestedBy->tenantProfile)
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6">
                                                                                        <div class="info-item">
                                                                                            <label class="info-label"><i class="fas fa-map-marker-alt me-2"></i>Current Address</label>
                                                                                            <p class="info-value">{{ $viewing->requestedBy->tenantProfile->current_address }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="info-item">
                                                                                            <label class="info-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                                                                            <p class="info-value">{{ $viewing->requestedBy->email }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="info-item">
                                                                                            <label class="info-label"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                                                                            <p class="info-value">{{ $viewing->requestedBy->phone_number }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="info-item">
                                                                                            <label class="info-label"><i class="fas fa-briefcase me-2"></i>Employment Status</label>
                                                                                            <p class="info-value">{{ $viewing->requestedBy->tenantProfile->employment_status }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="info-item">
                                                                                            <label class="info-label"><i class="fas fa-money-bill-wave me-2"></i>Monthly Income</label>
                                                                                            <p class="info-value">{{ number_format($viewing->requestedBy->tenantProfile->monthly_income, 2) }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="info-item">
                                                                                            <label class="info-label"><i class="fas fa-id-card me-2"></i>Valid ID Type</label>
                                                                                            <p class="info-value">
                                                                                                @switch($viewing->requestedBy->tenantProfile->valid_id_type)
                                                                                                    @case('driver_license') Driver's License @break
                                                                                                    @case('student_id') School ID @break
                                                                                                    @case('passport') Passport @break
                                                                                                    @case('national_id') National ID @break
                                                                                                    @case('voter_id') Voter ID @break
                                                                                                    @case('other') Other @break
                                                                                                    @default Not specified
                                                                                                @endswitch
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="info-item">
                                                                                            <label class="info-label"><i class="fas fa-user-friends me-2"></i>Emergency Contact</label>
                                                                                            <p class="info-value">{{ $viewing->requestedBy->tenantProfile->emergency_contact_name }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="info-item">
                                                                                            <label class="info-label"><i class="fas fa-phone-alt me-2"></i>Emergency Phone</label>
                                                                                            <p class="info-value">{{ $viewing->requestedBy->tenantProfile->emergency_contact_phone }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="alert alert-warning">
                                                                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                                                                    No tenant profile information available.
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer">
                                                            @if($viewing->viewing_status == 'pending')
                                                                <form action="{{ route('booking.accept', $viewing->id) }}" method="POST" class="me-2">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">
                                                                        <i class="fas fa-check me-1"></i> Accept Booking
                                                                    </button>
                                                                </form>
                                                                <form action="{{ route('booking.decline', $viewing->id) }}" method="POST" class="me-2">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fas fa-times me-1"></i> Decline Booking
                                                                    </button>
                                                                </form>
                                                            @elseif($viewing->viewing_status == 'approved')
                                                                <form action="{{ route('booking.decline', $viewing->id) }}" method="POST" class="me-2">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fas fa-times me-1"></i> Cancel Approval
                                                                    </button>
                                                                </form>
                                                            @elseif($viewing->viewing_status == 'declined')
                                                                <form action="{{ route('booking.accept', $viewing->id) }}" method="POST" class="me-2">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">
                                                                        <i class="fas fa-check me-1"></i> Approve Instead
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fas fa-times me-1"></i> Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
</div>
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    /* ID Card Styles */
    .id-flip-card {
        background-color: transparent;
        width: 500px;
        height: 250px;
        perspective: 1000px;
        cursor: pointer;
    }

    .id-flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .id-flip-card.flipped .id-flip-card-inner {
        transform: rotateY(180deg);
    }

    .id-flip-card-front, .id-flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 10px;
    }

    .id-flip-card-front {
        background-color: #fff;
    }

    .id-flip-card-back {
        background-color: #fff;
        transform: rotateY(180deg);
    }
    
    /* Owner Card Styles */
    .owner-card {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid #edf2f9;
        transition: all 0.3s ease;
    }
    
    .owner-card:hover {
        box-shadow: 0 12px 20px rgba(0,0,0,0.1);
    }
    
    .owner-card-header {
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid #edf2f9;
    }
    
    .owner-avatar {
        font-size: 2.5rem;
        color: #4e73df;
    }
    
    .owner-card-body {
        padding: 0;
    }
    
    .status-pills {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    /* Table styles */
    .booking-table {
        margin-bottom: 0;
    }
    
    .booking-table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e3e6f0;
        font-weight: 600;
        color: #5a5c69;
        padding: 0.75rem 1.5rem;
    }
    
    .booking-table tbody tr {
        border-bottom: 1px solid #f1f1f1;
    }
    
    .booking-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .listing-icon, .tenant-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e8f0fe;
        color: #4e73df;
    }
    
    .tenant-icon {
        background-color: #e0f2f1;
        color: #26a69a;
    }
    
    /* Status badges */
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
    
    .status-dot {
        font-size: 0.5rem;
    }
    
    .status-approved {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-declined {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-cancelled {
        background-color: #e2e3e5;
        color: #383d41;
    }
    
    /* Table subtile hover effect */
    .booking-table tbody tr:hover {
        background-color: #f8f9fc;
    }
    
    /* Warning subtle background */
    .table-warning-subtle {
        background-color: #fff8e1;
    }
    
    /* Modal Styling */
    .info-card {
        border: 1px solid #edf2f9;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1rem;
    }
    
    .info-card-header {
        background-color: #f8f9fa;
        padding: 1rem;
        border-bottom: 1px solid #edf2f9;
    }
    
    .info-card-body {
        padding: 1.5rem;
        background-color: #fff;
    }
    
    .info-label {
        display: block;
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    
    .info-value {
        font-weight: 500;
        margin-bottom: 0;
    }
    
    .info-item {
        margin-bottom: 0.5rem;
    }
    
    .listing-info {
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    
    .listing-icon {
        font-size: 1.5rem;
        width: 50px;
        height: 50px;
    }
    
    .id-card-title {
        color: #495057;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .status-pills {
            justify-content: flex-start;
            margin-top: 1rem;
        }
        
        .id-flip-card {
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
        }
    }

    /* Empty State Styles */
    .empty-state {
        padding: 3rem;
        background-color: #f8f9fa;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .empty-state i {
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .empty-state h4 {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        margin-bottom: 1.5rem;
    }
</style>
@endpush
@endsection