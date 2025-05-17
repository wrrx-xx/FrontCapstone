@extends('layouts.app')

@section('content')
<div class="main-content py-4">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-success bg-gradient">
                <h1 class="h3 mb-0 text-white">
                    <i class="fas fa-user-plus me-2"></i>Add New Tenant
                </h1>
            </div>
            
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle me-2"></i>Please correct the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.tenant.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="row">
                        <!-- Personal Information Section -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-user me-2 text-primary"></i>
                                    <h4 class="mb-0">Personal Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label for="fname" class="form-label">First Name*</label>
                                            <input type="text" name="fname" class="form-control" value="{{ old('fname') }}" required>
                                            <div class="invalid-feedback">First name is required</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mname" class="form-label">Middle Name</label>
                                            <input type="text" name="mname" class="form-control" value="{{ old('mname') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lname" class="form-label">Last Name*</label>
                                            <input type="text" name="lname" class="form-control" value="{{ old('lname') }}" required>
                                            <div class="invalid-feedback">Last name is required</div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email Address*</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                                <div class="invalid-feedback">Please provide a valid email address</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="phone_number" class="form-label">Phone Number*</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                <input type="tel" name="phone_number" class="form-control" value="{{ old('phone_number') }}" 
                                                       pattern="[0-9]{10,}" required>
                                                <div class="invalid-feedback">Please provide a valid phone number</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Section -->
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-lock me-2 text-black"></i>
                                    <h4 class="mb-0">Security Credentials</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Password*</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                <input type="password" name="password" class="form-control" 
                                                       required minlength="8" id="password">
                                                <div class="invalid-feedback">Password must be at least 8 characters</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                                <input type="password" name="password_confirmation" class="form-control" 
                                                       required minlength="8" id="password_confirmation">
                                                <div class="invalid-feedback">Passwords must match</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Information Section -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-address-card me-2 text-black"></i>
                                    <h4 class="mb-0">Profile Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="current_address" class="form-label">Current Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                <input type="text" name="current_address" class="form-control" 
                                                       value="{{ old('current_address') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="employment_status" class="form-label">Employment Status</label>
                                            <select name="employment_status" class="form-select">
                                                <option value="">Select Status</option>
                                                <option value="Employed" {{ old('employment_status') == 'Employed' ? 'selected' : '' }}>Employed</option>
                                                <option value="Self-Employed" {{ old('employment_status') == 'Self-Employed' ? 'selected' : '' }}>Self-Employed</option>
                                                <option value="Unemployed" {{ old('employment_status') == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                                                <option value="Student" {{ old('employment_status') == 'Student' ? 'selected' : '' }}>Student</option>
                                                <option value="Retired" {{ old('employment_status') == 'Retired' ? 'selected' : '' }}>Retired</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="monthly_income" class="form-label">Monthly Income</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" name="monthly_income" class="form-control" 
                                                       value="{{ old('monthly_income') }}" min="0" step="0.01">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Emergency Contact Section -->
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-ambulance me-2 text-black"></i>
                                    <h4 class="mb-0">Emergency Contact</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="emergency_contact_name" class="form-label">Contact Name</label>
                                            <input type="text" name="emergency_contact_name" class="form-control" 
                                                   value="{{ old('emergency_contact_name') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="emergency_contact_phone" class="form-label">Contact Phone</label>
                                            <input type="tel" name="emergency_contact_phone" class="form-control" 
                                                   value="{{ old('emergency_contact_phone') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ID Verification Section -->
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-id-card me-2 text-black"></i>
                                    <h4 class="mb-0">ID Verification</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="valid_id_type" class="form-label">ID Type</label>
                                            <select name="valid_id_type" class="form-select">
                                                <option value="">Select ID Type</option>
                                                <option value="Driver's License" {{ old('valid_id_type') == "Driver's License" ? 'selected' : '' }}>Driver's License</option>
                                                <option value="Passport" {{ old('valid_id_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                                                <option value="National ID" {{ old('valid_id_type') == 'National ID' ? 'selected' : '' }}>National ID</option>
                                                <option value="Social Security" {{ old('valid_id_type') == 'Social Security' ? 'selected' : '' }}>Social Security</option>
                                                <option value="Other" {{ old('valid_id_type') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">ID Front Image</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                <input type="file" name="valid_id_front_path" class="form-control" 
                                                       accept="image/*">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">ID Back Image</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                <input type="file" name="valid_id_back_path" class="form-control" 
                                                       accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="{{ route('admin.tenant.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus-circle me-1"></i>Create Tenant
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
        margin-bottom: 1.5rem;
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

    .required-field::after {
        content: "*";
        color: red;
        margin-left: 4px;
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
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    
    function validatePassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity("Passwords don't match");
        } else {
            confirmPassword.setCustomValidity('');
        }
    }

    password.addEventListener('change', validatePassword);
    confirmPassword.addEventListener('keyup', validatePassword);
});
</script>
@endpush
@endsection