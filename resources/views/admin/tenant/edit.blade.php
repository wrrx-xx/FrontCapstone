@extends('layouts.app')

@section('content')
<div class="main-content py-4">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary bg-gradient">
                <h1 class="h3 mb-0 text-black">Edit Tenant Profile</h1>
            </div>
            
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-circle me-2"></i>Please correct the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.tenant.update', $tenant->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Personal Information Section -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label for="fname" class="form-label">First Name</label>
                                            <input type="text" name="fname" class="form-control" value="{{ old('fname', $tenant->fname) }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mname" class="form-label">Middle Name</label>
                                            <input type="text" name="mname" class="form-control" value="{{ old('mname', $tenant->mname) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lname" class="form-label">Last Name</label>
                                            <input type="text" name="lname" class="form-control" value="{{ old('lname', $tenant->lname) }}" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" name="email" class="form-control" value="{{ old('email', $tenant->email) }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $tenant->phone_number) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Section -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fas fa-lock me-2"></i>Security</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">New Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Information Section -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fas fa-address-card me-2"></i>Profile Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="current_address" class="form-label">Current Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                <input type="text" name="current_address" class="form-control" value="{{ old('current_address', $tenant->tenantProfile->current_address ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="employment_status" class="form-label">Employment Status</label>
                                            <select name="employment_status" class="form-select">
                                                @php
                                                    $statuses = ['Employed', 'Self-Employed', 'Unemployed', 'Student', 'Retired'];
                                                    $currentStatus = old('employment_status', $tenant->tenantProfile->employment_status ?? '');
                                                @endphp
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status }}" {{ $currentStatus == $status ? 'selected' : '' }}>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="monthly_income" class="form-label">Monthly Income</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" name="monthly_income" class="form-control" value="{{ old('monthly_income', $tenant->tenantProfile->monthly_income ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Emergency Contact Section -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fas fa-ambulance me-2"></i>Emergency Contact</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="emergency_contact_name" class="form-label">Contact Name</label>
                                            <input type="text" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name', $tenant->tenantProfile->emergency_contact_name ?? '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="emergency_contact_phone" class="form-label">Contact Phone</label>
                                            <input type="text" name="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone', $tenant->tenantProfile->emergency_contact_phone ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ID Verification Section -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fas fa-id-card me-2"></i>ID Verification</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="valid_id_type" class="form-label">ID Type</label>
                                            <select name="valid_id_type" class="form-select">
                                                @php
                                                    $idTypes = ['Driver\'s License', 'Passport', 'National ID', 'Social Security', 'Other'];
                                                    $currentType = old('valid_id_type', $tenant->tenantProfile->valid_id_type ?? '');
                                                @endphp
                                                @foreach($idTypes as $type)
                                                    <option value="{{ $type }}" {{ $currentType == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">ID Front Image</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                <input type="file" name="valid_id_front_path" class="form-control" accept="image/*">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">ID Back Image</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                <input type="file" name="valid_id_back_path" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="{{ route('admin.tenant.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Update Tenant
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 0.5rem;
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
    }

    .input-group-text {
        background-color: #f8f9fa;
    }

    .btn {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }

    .alert {
        border-radius: 0.5rem;
    }

    .main-content {
        background-color: #f8f9fa;
        min-height: calc(100vh - 60px);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Password matching validation
    const password = document.querySelector('input[name="password"]');
    const confirmPassword = document.querySelector('input[name="password_confirmation"]');
    
    if (password && confirmPassword) {
        confirmPassword.addEventListener('input', function() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords don't match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        });
    }
});
</script>
@endpush
@endsection