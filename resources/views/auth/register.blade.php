@extends('layouts.app')

@section('content')
<main>
    <section class="pt-3 pt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-5 mt-lg-0 order-2 order-lg-1">
                    <h3 class="fw-bold mb-4">Create Your New Account</h3>
                    <p class="mb-4 mb-lg-5 text-muted">Join us and explore amazing properties.</p>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <!-- Step 1: User Information -->
                        <div class="mb-4">
                            <x-input-label for="role" :value="__('Register As')" />
                            <select id="role" name="role" class="form-control bg-light border-0 rounded-pill" required>
                                <option value="tenant" {{ old('role') == 'tenant' ? 'selected' : '' }}>Tenant</option>
                                <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Property Owner</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>
                        <div id="step1">
                            <h5 class="fw-bold mb-4">Step 1: User Information</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <x-input-label for="fname" :value="__('Firstname')" />
                                    <x-text-input id="fname" class="form-control bg-light border-0 rounded-pill" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
                                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <x-input-label for="mname" :value="__('Middlename')" />
                                    <x-text-input id="mname" class="form-control bg-light border-0 rounded-pill" type="text" name="mname" :value="old('mname')" required autofocus autocomplete="mname" />
                                    <x-input-error :messages="$errors->get('mname')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <x-input-label for="lname" :value="__('Lastname')" />
                                    <x-text-input id="lname" class="form-control bg-light border-0 rounded-pill" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
                                    <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mb-3">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control bg-light border-0 rounded-pill" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-text-input id="phone_number" class="form-control bg-light border-0 rounded-pill" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control bg-light border-0 rounded-pill" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="form-control bg-light border-0 rounded-pill" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            

                            <div class="d-flex justify-content-between">
                                <button type="button" id="nextStep1" class="btn btn-primary rounded-pill px-4">
                                    {{ __('Next Step') }} <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Profile Information -->
                        <div id="step2" style="display: none;">
                            <h5 class="fw-bold mb-4">Step 2: Profile Information</h5>

                            <div class="mb-3">
                                <x-input-label for="current_address" :value="__('Current Address')" />
                                <x-text-input id="current_address" class="form-control bg-light border-0 rounded-pill" type="text" name="current_address" :value="old('current_address')" required />
                                <x-input-error :messages="$errors->get('current_address')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="employment_status" :value="__('Employment Status')" />
                                <select id="employment_status" name="employment_status" class="form-control bg-light border-0 rounded-pill" required>
                                    <option value="" disabled selected>Select Employment Status</option>
                                    <option value="employed" {{ old('employment_status') == 'employed' ? 'selected' : '' }}>Employed</option>
                                    <option value="unemployed" {{ old('employment_status') == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                                    <option value="student" {{ old('employment_status') == 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="self-employed" {{ old('employment_status') == 'self-employed' ? 'selected' : '' }}>Self-Employed</option>
                                    <option value="retired" {{ old('employment_status') == 'retired' ? 'selected' : '' }}>Retired</option>
                                </select>
                                <x-input-error :messages="$errors->get('employment_status')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="monthly_income" :value="__('Monthly Income')" />
                                <x-text-input id="monthly_income" class="form-control bg-light border-0 rounded-pill" type="number" name="monthly_income" :value="old('monthly_income')" required />
                                <x-input-error :messages="$errors->get('monthly_income')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="emergency_contact_name" :value="__('Emergency Contact Name')" />
                                <x-text-input id="emergency_contact_name" class="form-control bg-light border-0 rounded-pill" type="text" name="emergency_contact_name" :value="old('emergency_contact_name')" required />
                                <x-input-error :messages="$errors->get('emergency_contact_name')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="emergency_contact_phone" :value="__('Emergency Contact Phone')" />
                                <x-text-input id="emergency_contact_phone" class="form-control bg-light border-0 rounded-pill" type="text" name="emergency_contact_phone" :value="old('emergency_contact_phone')" required />
                                <x-input-error :messages="$errors->get('emergency_contact_phone')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="valid_id_type" :value="__('Valid ID Type')" />
                                <select id="valid_id_type" name="valid_id_type" class="form-control bg-light border-0 rounded-pill" required>
                                    <option value="" disabled selected>Select ID Type</option>
                                    <option value="passport" {{ old('valid_id_type') == 'passport' ? 'selected' : '' }}>Passport</option>
                                    <option value="driver_license" {{ old('valid_id_type') == 'driver_license' ? 'selected' : '' }}>Driver's License</option>
                                    <option value="national_id" {{ old('valid_id_type') == 'national_id' ? 'selected' : '' }}>National ID</option>
                                    <option value="student_id" {{ old('valid_id_type') == 'student_id' ? 'selected' : '' }}>Student ID</option>
                                    <option value="other" {{ old('valid_id_type') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('valid_id_type')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="valid_id_front" :value="__('Upload Valid ID Front')" />
                                <input type="file" id="valid_id_front" class="form-control bg-light border-0 rounded-pill" name="valid_id_front" required />
                                <x-input-error :messages="$errors->get('valid_id_front')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="valid_id_back" :value="__('Upload Valid ID Back')" />
                                <input type="file" id="valid_id_back" class="form-control bg-light border-0 rounded-pill" name="valid_id_back" required />
                                <x-input-error :messages="$errors->get('valid_id_back')" class="mt-2" />
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" id="prevStep2" class="btn btn-secondary rounded-pill px-4">
                                    {{ __('Previous Step') }} <i class="fas fa-arrow-left ms-2"></i>
                                </button>
                                <button type="button" id="nextStep2" class="btn btn-primary rounded-pill px-4">
                                    {{ __('Next Step') }} <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Owner Profile Information -->
                        <div id="step3" style="display: none;">
                            <h5 class="fw-bold mb-4">Step 3: Owner Profile Information</h5>

                            <div class="mb-3">
                                <x-input-label for="business_name" :value="__('Business Name')" />
                                <x-text-input id="business_name" class="form-control bg-light border-0 rounded-pill" type="text" name="business_name" :value="old('business_name')" />
                                <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="business_address" :value="__('Business Address')" />
                                <x-text-input id="business_address" class="form-control bg-light border-0 rounded-pill" type="text" name="business_address" :value="old('business_address')" />
                                <x-input-error :messages="$errors->get('business_address')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="business_phone" :value="__('Business Phone')" />
                                <x-text-input id="business_phone" class="form-control bg-light border-0 rounded-pill" type="text" name="business_phone" :value="old('business_phone')" />
                                <x-input-error :messages="$errors->get('business_phone')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="owner_id_type" :value="__('Owner ID Type')" />
                                <select id="owner_id_type" name="owner_id_type" class="form-control bg-light border-0 rounded-pill">
                                    <option value="" disabled selected>Select ID Type</option>
                                    <option value="passport" {{ old('owner_id_type') == 'passport' ? 'selected' : '' }}>Passport</option>
                                    <option value="driver_license" {{ old('owner_id_type') == 'driver_license' ? 'selected' : '' }}>Driver's License</option>
                                    <option value="national_id" {{ old('owner_id_type') == 'national_id' ? 'selected' : '' }}>National ID</option>
                                </select>
                                <x-input-error :messages="$errors->get('owner_id_type')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="owner_id_front" :value="__('Upload Owner ID Front')" />
                                <input type="file" id="owner_id_front" class="form-control bg-light border-0 rounded-pill" name="owner_id_front" />
                                <x-input-error :messages="$errors->get('owner_id_front')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="owner_id_back" :value="__('Upload Owner ID Back')" />
                                <input type="file" id="owner_id_back" class="form-control bg-light border-0 rounded-pill" name="owner_id_back" />
                                <x-input-error :messages="$errors->get('owner_id_back')" class="mt-2" />
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" id="prevStep3" class="btn btn-secondary rounded-pill px-4">
                                    {{ __('Previous Step') }} <i class="fas fa-arrow-left ms-2"></i>
                                </button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    {{ __('Register') }} <i class="fas fa-check ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 order-1 text-center">
                    <img src="assets/images/signin-signup/01.png" alt="Sign Up Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.getElementById('nextStep1').addEventListener('click', function() {
        document.getElementById('step1').style.display = 'none';
        const role = document.getElementById('role').value;
        if (role === 'owner') {
            document.getElementById('step3').style.display = 'block';
        } else {
            document.getElementById('step2').style.display = 'block';
        }
    });

    document.getElementById('nextStep2').addEventListener('click', function() {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
    });

    document.getElementById('prevStep2').addEventListener('click', function() {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
    });

    document.getElementById('prevStep3').addEventListener('click', function() {
        document.getElementById('step3').style.display = 'none';
        const role = document.getElementById('role').value;
        if (role === 'owner') {
            document.getElementById('step1').style.display = 'block';
        } else {
            document.getElementById('step2').style.display = 'block';
        }
    });
</script>
@endsection
