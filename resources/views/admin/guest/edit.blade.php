@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header with animated gradient background -->
    <div class="card shadow-lg mb-5">
        <div class="card-header bg-gradient text-white p-4" style="background: linear-gradient(135deg, #36b9cc 0%, #1a8a98 100%);">
            <div class="d-flex align-items-center">
                <i class="fas fa-user-friends fa-2x me-3"></i>
                <h1 class="mb-0 fw-bold">Edit Guest Profile</h1>
            </div>
        </div>
        
        <div class="card-body p-4">
            <!-- Error alerts -->
            @if ($errors->any())
                <div class="alert alert-danger border-left-danger shadow-sm" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h4 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Please check the form</h4>
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="mb-1"><i class="fas fa-arrow-right me-2 small"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.guest.update', $guest->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="fname" class="form-label fw-bold">First Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname', $guest->fname) }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="mname" class="form-label fw-bold">Middle Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" name="mname" id="mname" class="form-control" value="{{ old('mname', $guest->mname) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="lname" class="form-label fw-bold">Last Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" name="lname" id="lname" class="form-control" value="{{ old('lname', $guest->lname) }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $guest->email) }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $guest->phone_number) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-lock me-2"></i>Security</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-bold">Password</label>
                                        <small class="text-muted d-block mb-1">(leave blank to keep current)</small>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                        <small class="text-muted d-block mb-1">&nbsp;</small>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-id-card me-2"></i>Identification</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="valid_id_type" class="form-label fw-bold">ID Type</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                            <select name="valid_id_type" id="valid_id_type" class="form-select">
                                                <option value="" selected disabled>Select ID Type</option>
                                                <option value="Passport" {{ old('valid_id_type', $guest->tenantProfile->valid_id_type ?? '') == 'Passport' ? 'selected' : '' }}>Passport</option>
                                                <option value="Driver's License" {{ old('valid_id_type', $guest->tenantProfile->valid_id_type ?? '') == "Driver's License" ? 'selected' : '' }}>Driver's License</option>
                                                <option value="National ID" {{ old('valid_id_type', $guest->tenantProfile->valid_id_type ?? '') == 'National ID' ? 'selected' : '' }}>National ID</option>
                                                <option value="Other" {{ old('valid_id_type', $guest->tenantProfile->valid_id_type ?? '') && !in_array(old('valid_id_type', $guest->tenantProfile->valid_id_type ?? ''), ['Passport', "Driver's License", 'National ID']) ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="valid_id_front_path" class="form-label fw-bold">ID Front Image</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                                            <input type="text" name="valid_id_front_path" id="valid_id_front_path" class="form-control" value="{{ old('valid_id_front_path', $guest->tenantProfile->valid_id_front_path ?? '') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="valid_id_back_path" class="form-label fw-bold">ID Back Image</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                                            <input type="text" name="valid_id_back_path" id="valid_id_back_path" class="form-control" value="{{ old('valid_id_back_path', $guest->tenantProfile->valid_id_back_path ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-home me-2"></i>Residence Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="current_address" class="form-label fw-bold">Current Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            <textarea name="current_address" id="current_address" class="form-control" rows="3">{{ old('current_address', $guest->tenantProfile->current_address ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-briefcase me-2"></i>Employment & Income</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="employment_status" class="form-label fw-bold">Employment Status</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                            <select name="employment_status" id="employment_status" class="form-select">
                                                <option value="" selected disabled>Select Status</option>
                                                <option value="Full-time" {{ old('employment_status', $guest->tenantProfile->employment_status ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                                <option value="Part-time" {{ old('employment_status', $guest->tenantProfile->employment_status ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                                <option value="Self-employed" {{ old('employment_status', $guest->tenantProfile->employment_status ?? '') == 'Self-employed' ? 'selected' : '' }}>Self-employed</option>
                                                <option value="Unemployed" {{ old('employment_status', $guest->tenantProfile->employment_status ?? '') == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                                                <option value="Student" {{ old('employment_status', $guest->tenantProfile->employment_status ?? '') == 'Student' ? 'selected' : '' }}>Student</option>
                                                <option value="Retired" {{ old('employment_status', $guest->tenantProfile->employment_status ?? '') == 'Retired' ? 'selected' : '' }}>Retired</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="monthly_income" class="form-label fw-bold">Monthly Income</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            <input type="number" name="monthly_income" id="monthly_income" class="form-control" value="{{ old('monthly_income', $guest->tenantProfile->monthly_income ?? '') }}" min="0" step="0.01">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0"><i class="fas fa-phone-alt me-2"></i>Emergency Contact</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="emergency_contact_name" class="form-label fw-bold">Contact Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name', $guest->tenantProfile->emergency_contact_name ?? '') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="emergency_contact_phone" class="form-label fw-bold">Contact Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                                            <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone', $guest->tenantProfile->emergency_contact_phone ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i>Update Guest
                    </button>
                    <a href="{{ route('admin.guest.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Form validation
(function () {
  'use strict'
  
  // Fetch all forms we want to apply validation to
  var forms = document.querySelectorAll('.needs-validation')
  
  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        
        form.classList.add('was-validated')
      }, false)
    })
})()

// Password toggle to show/hide
document.addEventListener('DOMContentLoaded', function() {
    const passwordFields = document.querySelectorAll('input[type="password"]');
    
    passwordFields.forEach(field => {
        // Create container for the field
        const container = document.createElement('div');
        container.className = 'position-relative';
        
        // Move the field into the container
        field.parentNode.insertBefore(container, field);
        container.appendChild(field);
        
        // Create the toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.type = 'button';
        toggleBtn.className = 'btn btn-sm position-absolute end-0 top-0 h-100';
        toggleBtn.style.zIndex = '5';
        toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
        toggleBtn.addEventListener('click', function() {
            if (field.type === 'password') {
                field.type = 'text';
                toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                field.type = 'password';
                toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
        
        container.appendChild(toggleBtn);
    });
});
</script>
@endsection