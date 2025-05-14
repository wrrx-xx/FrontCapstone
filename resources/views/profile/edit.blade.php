@extends('layouts.app')
@section('content')
<!-- Main content START -->
<div class="main-content">
     @if (session('success') || $errors->any())
            <!-- Feedback Modal -->
            @include('components.feedback-modal')
        @endif
    <div class="row">
        <div class="col-12">
            <!-- Page title -->
            <div class="my-5">
                <h3>My Profile</h3>
                <hr>
            </div>
            <!-- Form START -->
            <form class="file-upload" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row mb-5 gx-5">
                    <!-- Basic Information -->
                    <div class="col-xxl-8 mb-5 mb-xxl-0">
                        <div class="bg-secondary-soft px-4 py-5 rounded">
                            <h4 class="mb-4 mt-0">Basic Information</h4>
                            <div class="row g-3">
                                <!-- First Name -->
                                <div class="col-md-4">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" name="fname" class="form-control @error('fname') is-invalid @enderror" value="{{ old('fname', $user->fname) }}" required>
                                    @error('fname')
                                    <div class="invalid-feedback">{{ $errors->first('fname') }}</div>
                                    @enderror
                                </div>
                                <!-- Middle Name -->
                                <div class="col-md-4">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" name="mname" class="form-control @error('mname') is-invalid @enderror" value="{{ old('mname', $user->mname) }}">
                                    @error('mname')
                                    <div class="invalid-feedback">{{ $errors->first('mname') }}</div>
                                    @enderror
                                </div>
                                <!-- Last Name -->
                                <div class="col-md-4">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" name="lname" class="form-control @error('lname') is-invalid @enderror" value="{{ old('lname', $user->lname) }}" required>
                                    @error('lname')
                                    <div class="invalid-feedback">{{ $errors->first('lname') }}</div>
                                    @enderror
                                </div>
                                <!-- Phone number -->
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number *</label>
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $user->phone_number) }}" required>
                                    @error('phone_number')
                                    <div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
                                    @enderror
                                </div>
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @enderror
                                </div>
                            </div> <!-- Row END -->
                        </div>

                        @if($user->isTenant() || $user->isGuest())
                        <!-- Tenant Profile Information -->
                        <div class="bg-secondary-soft px-4 py-5 rounded mt-4">
                            <h4 class="mb-4 mt-0">Tenant Profile</h4>
                            <div class="row g-3">
                                <!-- Current Address -->
                                <div class="col-md-12">
                                    <label class="form-label">Current Address</label>
                                    <input type="text" name="current_address" class="form-control @error('current_address') is-invalid @enderror" value="{{ old('current_address', optional($user->tenantProfile)->current_address) }}">
                                    @error('current_address')
                                    <div class="invalid-feedback">{{ $errors->first('current_address') }}</div>
                                    @enderror
                                </div>
                                <!-- Employment Status -->
                                <div class="col-md-6">
                                    <label class="form-label">Employment Status</label>
                                    <select name="employment_status" class="form-select @error('employment_status') is-invalid @enderror">
                                        <option value="">Select Employment Status</option>
                                        <option value="Employed" {{ old('employment_status', optional($user->tenantProfile)->employment_status) == 'Employed' ? 'selected' : '' }}>Employed</option>
                                        <option value="Self-Employed" {{ old('employment_status', optional($user->tenantProfile)->employment_status) == 'Self-Employed' ? 'selected' : '' }}>Self-Employed</option>
                                        <option value="Unemployed" {{ old('employment_status', optional($user->tenantProfile)->employment_status) == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                                        <option value="Student" {{ old('employment_status', optional($user->tenantProfile)->employment_status) == 'Student' ? 'selected' : '' }}>Student</option>
                                        <option value="Retired" {{ old('employment_status', optional($user->tenantProfile)->employment_status) == 'Retired' ? 'selected' : '' }}>Retired</option>
                                    </select>
                                    @error('employment_status')
                                    <div class="invalid-feedback">{{ $errors->first('employment_status') }}</div>
                                    @enderror
                                </div>
                                <!-- Monthly Income -->
                                <div class="col-md-6">
                                    <label class="form-label">Monthly Income</label>
                                    <input type="number" name="monthly_income" class="form-control @error('monthly_income') is-invalid @enderror" value="{{ old('monthly_income', optional($user->tenantProfile)->monthly_income) }}" min="0" step="0.01">
                                    @error('monthly_income')
                                    <div class="invalid-feedback">{{ $errors->first('monthly_income') }}</div>
                                    @enderror
                                </div>
                                <!-- Emergency Contact Name -->
                                <div class="col-md-6">
                                    <label class="form-label">Emergency Contact Name</label>
                                    <input type="text" name="emergency_contact_name" class="form-control @error('emergency_contact_name') is-invalid @enderror" value="{{ old('emergency_contact_name', optional($user->tenantProfile)->emergency_contact_name) }}">
                                    @error('emergency_contact_name')
                                    <div class="invalid-feedback">{{ $errors->first('emergency_contact_name') }}</div>
                                    @enderror
                                </div>
                                <!-- Emergency Contact Phone -->
                                <div class="col-md-6">
                                    <label class="form-label">Emergency Contact Phone</label>
                                    <input type="text" name="emergency_contact_phone" class="form-control @error('emergency_contact_phone') is-invalid @enderror" value="{{ old('emergency_contact_phone', optional($user->tenantProfile)->emergency_contact_phone) }}">
                                    @error('emergency_contact_phone')
                                    <div class="invalid-feedback">{{ $errors->first('emergency_contact_phone') }}</div>
                                    @enderror
                                </div>
                                <!-- Valid ID Type -->
                                <div class="col-md-6">
                                    <label class="form-label">Valid ID Type</label>
                                    <select name="valid_id_type" class="form-select @error('valid_id_type') is-invalid @enderror">
                                        <option value="">Select Valid ID</option>
                                        <option value="Philippine Passport" {{ old('valid_id_type', optional($user->tenantProfile)->valid_id_type) == 'Philippine Passport' ? 'selected' : '' }}>Philippine Passport</option>
                                        <option value="Driver's License" {{ old('valid_id_type', optional($user->tenantProfile)->valid_id_type) == "Driver's License" ? 'selected' : '' }}>Driver's License</option>
                                        <option value="SSS ID" {{ old('valid_id_type', optional($user->tenantProfile)->valid_id_type) == 'SSS ID' ? 'selected' : '' }}>SSS ID</option>
                                        <option value="GSIS ID" {{ old('valid_id_type', optional($user->tenantProfile)->valid_id_type) == 'GSIS ID' ? 'selected' : '' }}>GSIS ID</option>
                                        <option value="PhilHealth ID" {{ old('valid_id_type', optional($user->tenantProfile)->valid_id_type) == 'PhilHealth ID' ? 'selected' : '' }}>PhilHealth ID</option>
                                        <option value="Voter's ID" {{ old('valid_id_type', optional($user->tenantProfile)->valid_id_type) == "Voter's ID" ? 'selected' : '' }}>Voter's ID</option>
                                        <option value="Postal ID" {{ old('valid_id_type', optional($user->tenantProfile)->valid_id_type) == 'Postal ID' ? 'selected' : '' }}>Postal ID</option>
                                        <option value="Barangay Clearance" {{ old('valid_id_type', optional($user->tenantProfile)->valid_id_type) == 'Barangay Clearance' ? 'selected' : '' }}>Barangay Clearance</option>
                                    </select>
                                    @error('valid_id_type')
                                    <div class="invalid-feedback">{{ $errors->first('valid_id_type') }}</div>
                                    @enderror
                                </div>
                                <!-- Valid ID Front Upload -->
                                <div class="col-md-6">
                                    <label class="form-label">Valid ID Front</label>
                                    <input type="file" name="valid_id_front_path" class="form-control @error('valid_id_front_path') is-invalid @enderror" accept="image/*">
                                    @if(optional($user->tenantProfile)->valid_id_front_path)
                                    <small>Current file: <a href="{{ asset($user->tenantProfile->valid_id_front_path) }}" target="_blank">View</a></small>
                                    @endif
                                    @error('valid_id_front_path')
                                    <div class="invalid-feedback">{{ $errors->first('valid_id_front_path') }}</div>
                                    @enderror
                                </div>
                                <!-- Valid ID Back Upload -->
                                <div class="col-md-6">
                                    <label class="form-label">Valid ID Back</label>
                                    <input type="file" name="valid_id_back_path" class="form-control @error('valid_id_back_path') is-invalid @enderror" accept="image/*">
                                    @if(optional($user->tenantProfile)->valid_id_back_path)
                                    <small>Current file: <a href="{{ asset($user->tenantProfile->valid_id_back_path) }}" target="_blank">View</a></small>
                                    @endif
                                    @error('valid_id_back_path')
                                    <div class="invalid-feedback">{{ $errors->first('valid_id_back_path') }}</div>
                                    @enderror
                                </div>
                            </div> <!-- Row END -->
                        </div>
                        @endif

                        @if($user->isOwner())
                        <!-- Owner Profile Information -->
                        <div class="bg-secondary-soft px-4 py-5 rounded mt-4">
                            <h4 class="mb-4 mt-0">Owner Profile</h4>
                            <div class="row g-3">
                                <!-- Business Name -->
                                <div class="col-md-6">
                                    <label class="form-label">Business Name</label>
                                    <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror" value="{{ old('business_name', optional($user->ownerProfile)->business_name) }}">
                                    @error('business_name')
                                    <div class="invalid-feedback">{{ $errors->first('business_name') }}</div>
                                    @enderror
                                </div>
                                <!-- Business Address -->
                                <div class="col-md-6">
                                    <label class="form-label">Business Address</label>
                                    <input type="text" name="business_address" class="form-control @error('business_address') is-invalid @enderror" value="{{ old('business_address', optional($user->ownerProfile)->business_address) }}">
                                    @error('business_address')
                                    <div class="invalid-feedback">{{ $errors->first('business_address') }}</div>
                                    @enderror
                                </div>
                                <!-- Business Phone -->
                                <div class="col-md-6">
                                    <label class="form-label">Business Phone</label>
                                    <input type="text" name="business_phone" class="form-control @error('business_phone') is-invalid @enderror" value="{{ old('business_phone', optional($user->ownerProfile)->business_phone) }}">
                                    @error('business_phone')
                                    <div class="invalid-feedback">{{ $errors->first('business_phone') }}</div>
                                    @enderror
                                </div>
                                <!-- Business Email -->
                                <div class="col-md-6">
                                    <label class="form-label">Business Email</label>
                                    <input type="email" name="business_email" class="form-control @error('business_email') is-invalid @enderror" value="{{ old('business_email', optional($user->ownerProfile)->business_email) }}">
                                    @error('business_email')
                                    <div class="invalid-feedback">{{ $errors->first('business_email') }}</div>
                                    @enderror
                                </div>
                                <!-- Owner ID Type -->
                                <div class="col-md-6">
                                    <label class="form-label">Owner ID Type</label>
                                    <input type="text" name="owner_id_type" class="form-control @error('owner_id_type') is-invalid @enderror" value="{{ old('owner_id_type', optional($user->ownerProfile)->owner_id_type) }}">
                                    @error('owner_id_type')
                                    <div class="invalid-feedback">{{ $errors->first('owner_id_type') }}</div>
                                    @enderror
                                </div>
                                <!-- Owner ID Front Upload -->
                                <div class="col-md-6">
                                    <label class="form-label">Owner ID Front</label>
                                    <input type="file" name="owner_id_front_path" class="form-control @error('owner_id_front_path') is-invalid @enderror" accept="image/*">
                                    @if(optional($user->ownerProfile)->owner_id_front_path)
                                    <small>Current file: <a href="{{ asset(optional($user->ownerProfile)->owner_id_front_path) }}" target="_blank">View</a></small>
                                    @endif
                                    @error('owner_id_front_path')
                                    <div class="invalid-feedback">{{ $errors->first('owner_id_front_path') }}</div>
                                    @enderror
                                </div>
                                <!-- Owner ID Back Upload -->
                                <div class="col-md-6">
                                    <label class="form-label">Owner ID Back</label>
                                    <input type="file" name="owner_id_back_path" class="form-control @error('owner_id_back_path') is-invalid @enderror" accept="image/*">
                                    @if(optional($user->ownerProfile)->owner_id_back_path)
                                    <small>Current file: <a href="{{asset($user->ownerProfile->owner_id_back_path) }}" target="_blank">View</a></small>
                                    @endif
                                    @error('owner_id_back_path')
                                    <div class="invalid-feedback">{{ $errors->first('owner_id_back_path') }}</div>
                                    @enderror
                                </div>
                                <!-- Additional Info -->
                                <div class="col-md-12">
                                    <label class="form-label">Additional Info</label>
                                    <textarea name="additional_info" class="form-control @error('additional_info') is-invalid @enderror" rows="3">{{ old('additional_info', optional($user->ownerProfile)->additional_info) }}</textarea>
                                    @error('additional_info')
                                    <div class="invalid-feedback">{{ $errors->first('additional_info') }}</div>
                                    @enderror
                                </div>
                            </div> <!-- Row END -->
                        </div>
                        @endif
                    </div>
                    <!-- Upload profile photo -->
                    <div class="col-xxl-4">
                        <div class="bg-secondary-soft px-4 py-5 rounded">
                            <h4 class="mb-4 mt-0">Upload your profile photo</h4>
                            <div class="text-center">
                                <!-- Image upload -->
                                <div class="square position-relative display-2 mb-3">
                                    @if($user->profile_photo)
                                    <img src="{{ asset( $user->profile_photo) }}" alt="Profile Photo" class="img-fluid rounded-circle" style="max-width: 250px; max-height: 250px;">
                                    @else
                                    <i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
                                    @endif
                                </div>
                                <!-- Button -->
                                <input type="file" id="customFile" name="profile_photo" hidden accept="image/*">
                                <label class="btn btn-success-soft btn-block" for="customFile">Upload</label>
                                <button type="button" class="btn btn-danger-soft" id="removeProfilePhotoBtn">Remove</button>
                                <!-- Content -->
                                <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row END -->

                <!-- Buttons -->
                <div class="gap-3 d-md-flex justify-content-md-end text-center">
                    <button type="button" class="btn btn-danger btn-lg" id="deleteProfileBtn">Delete profile</button>
                    <button type="submit" class="btn btn-primary btn-lg">Update Profile</button>
                </div>
            </form> <!-- Form END -->
        </div>
    </div>
</div>
<!-- Main content END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Template Functions -->
<script src="assets/js/functions.js"></script>

<script>
    document.getElementById('removeProfilePhotoBtn').addEventListener('click', function() {
        // Clear the file input
        document.getElementById('customFile').value = '';
        // Optionally, add logic to remove the profile photo on the server side
        alert('Profile photo removal functionality to be implemented.');
    });

    document.getElementById('deleteProfileBtn').addEventListener('click', function() {
        if(confirm('Are you sure you want to delete your profile? This action cannot be undone.')) {
            // Redirect or submit a form to delete profile
            alert('Profile deletion functionality to be implemented.');
        }
    });
</script>

 @if (session('success') || $errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Modal(document.getElementById('feedbackModal')).show()
        });
    
</script>
@endif
@endsection
