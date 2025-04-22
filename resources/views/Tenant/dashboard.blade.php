<!-- **************** TENANT DASHBOARD **************** -->
@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container-fluid px-4">
        <h2 class="mt-4">Welcome {{ Auth::user()->fname }}!</h2>
        <div class="row">
            <!-- Rental Information -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-primary text-white h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-home"></i> My Rental</h5>
                        <p class="card-text">Current Unit: <strong>Apartment A - Room 101</strong></p>
                        <p class="card-text">Lease Expiry: <strong>June 30, 2025</strong></p>
                    </div>
                </div>
            </div>
            
            <!-- Payment Due -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-warning text-dark h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-money-bill-wave"></i> Upcoming Payment</h5>
                        <p class="card-text">Amount Due: <strong>$500</strong></p>
                        <p class="card-text">Due Date: <strong>April 10, 2025</strong></p>
                        <a href="#" class="btn btn-dark">Pay Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Maintenance Requests -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-danger text-white h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-tools"></i> Maintenance Requests</h5>
                        <p class="card-text">Pending Requests: <strong>2</strong></p>
                        <a href="#" class="btn btn-light">View Requests</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Support Section -->
            <div class="col-xl-6 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-headset"></i> Need Help?</h5>
                        <p class="card-text">Contact support for any issues related to your rental.</p>
                        <a href="#" class="btn btn-primary">Contact Support</a>
                    </div>
                </div>
            </div>
            
            <!-- Messages Section -->
            <div class="col-xl-6 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-envelope"></i> Messages</h5>
                        <p class="card-text">You have <strong>3 new messages</strong> from the landlord.</p>
                        <a href="#" class="btn btn-secondary">View Messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection