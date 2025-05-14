@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>User Profile</h1>

    <div class="card mb-4">
        <div class="card-header">Basic Information</div>
        <div class="card-body">
            <p><strong>First Name:</strong> {{ Auth::user()->fname }}</p>
            <p><strong>Middle Name:</strong> {{ Auth::user()->mname }}</p>
            <p><strong>Last Name:</strong> {{ Auth::user()->lname }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Phone Number:</strong> {{ Auth::user()->phone_number }}</p>
            <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>
        </div>
    </div>

    @if(Auth::user()->tenantProfile)
    <div class="card mb-4">
        <div class="card-header">Tenant Profile</div>
        <div class="card-body">
            <p><strong>Current Address:</strong> {{ Auth::user()->tenantProfile->current_address }}</p>
            <p><strong>Employment Status:</strong> {{ Auth::user()->tenantProfile->employment_status }}</p>
            <p><strong>Monthly Income:</strong> {{ Auth::user()->tenantProfile->monthly_income }}</p>
            <p><strong>Emergency Contact Name:</strong> {{ Auth::user()->tenantProfile->emergency_contact_name }}</p>
            <p><strong>Emergency Contact Phone:</strong> {{ Auth::user()->tenantProfile->emergency_contact_phone }}</p>
            <p><strong>Valid ID Type:</strong> {{ Auth::user()->tenantProfile->valid_id_type }}</p>
            <p><strong>Valid ID Front:</strong> 
                @if(Auth::user()->tenantProfile->valid_id_front_path)
                    <img src="{{ asset(Auth::user()->tenantProfile->valid_id_front_path) }}" alt="Valid ID Front" style="max-width: 200px;">
                @else
                    N/A
                @endif
            </p>
            <p><strong>Valid ID Back:</strong> 
                @if(Auth::user()->tenantProfile->valid_id_back_path)
                    <img src="{{ asset(Auth::user()->tenantProfile->valid_id_back_path) }}" alt="Valid ID Back" style="max-width: 200px;">
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>
    @endif
</div>
@endsection
