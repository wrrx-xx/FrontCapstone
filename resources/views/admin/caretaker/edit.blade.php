@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-gradient-primary text-white p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold">Edit Caretaker Profile</h2>
                <span class="badge bg-light text-dark fs-6">ID: {{ $caretaker->id }}</span>
            </div>
        </div>
        
        <div class="card-body p-4">
            <div class="profile-summary mb-4 p-3 bg-light rounded">
                <div class="d-flex align-items-center">
                    <div class="profile-avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                        {{ substr($caretaker->fname, 0, 1) }}{{ substr($caretaker->lname, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="mb-0">{{ $caretaker->fname }} {{ $caretaker->lname }}</h3>
                        <p class="text-muted mb-0">Caretaker Record</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.caretaker.update', $caretaker->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Personal Information Section -->
                    <div class="col-md-12 mb-4">
                        <div class="section-header d-flex align-items-center mb-3">
                            <i class="fas fa-user me-2 text-primary"></i>
                            <h4 class="mb-0">Personal Information</h4>
                        </div>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" value="{{ old('fname', $caretaker->fname) }}" placeholder="First Name" required>
                                    <label for="fname">First Name</label>
                                    @error('fname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('mname') is-invalid @enderror" id="mname" name="mname" value="{{ old('mname', $caretaker->mname) }}" placeholder="Middle Name">
                                    <label for="mname">Middle Name</label>
                                    @error('mname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" value="{{ old('lname', $caretaker->lname) }}" placeholder="Last Name" required>
                                    <label for="lname">Last Name</label>
                                    @error('lname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="col-md-12 mb-4">
                        <div class="section-header d-flex align-items-center mb-3">
                            <i class="fas fa-address-card me-2 text-primary"></i>
                            <h4 class="mb-0">Contact Information</h4>
                        </div>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $caretaker->email) }}" placeholder="Email Address" required>
                                    <label for="email">Email Address</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $caretaker->phone_number) }}" placeholder="Phone Number" required>
                                    <label for="phone_number">Phone Number</label>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="col-md-12 mb-4">
                        <div class="section-header d-flex align-items-center mb-3">
                            <i class="fas fa-lock me-2 text-primary"></i>
                            <h4 class="mb-0">Security Settings</h4>
                        </div>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                    <label for="password">New Password (leave blank to keep current)</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    <label for="password_confirmation">Confirm New Password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.caretaker.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Back to List
                    </a>
                    <div>
                        <button type="reset" class="btn btn-outline-danger me-2">
                            <i class="fas fa-undo me-2"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Update Caretaker
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Last Updated Info -->
    <div class="text-center mt-3 text-muted small">
        <p>Last updated: {{ $caretaker->updated_at->format('F d, Y at h:i A') }}</p>
    </div>
</div>
@endsection