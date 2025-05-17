@extends('layouts.app')

@section('content')
<div class="main-content py-4">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary bg-gradient">
                <div class="d-flex align-items-center">
                    <div>
                        <h1 class="h3 mb-0 text-white">
                            <i class="fas fa-user-shield me-2"></i>Add New Caretaker
                        </h1>
                        <p class="text-white-50 mb-0">
                            for Owner: {{ $owner->fname }} {{ $owner->lname }}
                        </p>
                    </div>
                </div>
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

                <form action="{{ route('admin.caretaker.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="owner_id" value="{{ $owner->id }}">

                    <div class="row">
                        <!-- Personal Information -->
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
                                            <input type="text" 
                                                   class="form-control @error('fname') is-invalid @enderror" 
                                                   id="fname" 
                                                   name="fname" 
                                                   value="{{ old('fname') }}" 
                                                   required>
                                            @error('fname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="mname" class="form-label">Middle Name</label>
                                            <input type="text" 
                                                   class="form-control @error('mname') is-invalid @enderror" 
                                                   id="mname" 
                                                   name="mname" 
                                                   value="{{ old('mname') }}">
                                            @error('mname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="lname" class="form-label">Last Name*</label>
                                            <input type="text" 
                                                   class="form-control @error('lname') is-invalid @enderror" 
                                                   id="lname" 
                                                   name="lname" 
                                                   value="{{ old('lname') }}" 
                                                   required>
                                            @error('lname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email Address*</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" 
                                                       class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" 
                                                       name="email" 
                                                       value="{{ old('email') }}" 
                                                       required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="phone_number" class="form-label">Phone Number*</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                <input type="tel" 
                                                       class="form-control @error('phone_number') is-invalid @enderror" 
                                                       id="phone_number" 
                                                       name="phone_number" 
                                                       value="{{ old('phone_number') }}" 
                                                       pattern="[0-9]{10,}"
                                                       required>
                                                @error('phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Format: 10-digit number without spaces or dashes</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Credentials -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center">
                                    <i class="fas fa-lock me-2 text-primary"></i>
                                    <h4 class="mb-0">Security Credentials</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Password*</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                <input type="password" 
                                                       class="form-control @error('password') is-invalid @enderror" 
                                                       id="password" 
                                                       name="password" 
                                                       required 
                                                       minlength="8">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Minimum 8 characters</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                                <input type="password" 
                                                       class="form-control" 
                                                       id="password_confirmation" 
                                                       name="password_confirmation" 
                                                       required 
                                                       minlength="8">
                                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="text-end mt-4">
                                <a href="{{ route('admin.caretaker.index') }}" class="btn btn-secondary me-2">
                                    <i class="fas fa-times me-1"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-1"></i>Add Caretaker
                                </button>
                            </div>
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

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
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

    // Toggle password visibility
    function togglePasswordVisibility(inputId, buttonId) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);
        
        button.addEventListener('click', () => {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            button.querySelector('i').classList.toggle('fa-eye');
            button.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }

    togglePasswordVisibility('password', 'togglePassword');
    togglePasswordVisibility('password_confirmation', 'toggleConfirmPassword');

    // Phone number formatting
    const phoneInput = document.getElementById('phone_number');
    phoneInput.addEventListener('input', function(e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : !x[3] ? x[1] + '-' + x[2] : x[1] + '-' + x[2] + '-' + x[3];
    });
});
</script>
@endpush
@endsection