@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container">
    <div class="card shadow rounded-4">
        <div class="card-body p-4">
            <h4 class="mb-4 text-black"><i class="fas fa-user-plus me-2"></i>Create Caretaker Account</h4>

            <form action="{{ route('caretaker.store') }}" method="POST">
                @csrf

                {{-- First Name --}}
                <div class="mb-3">
                    <label for="fname" class="form-label"><i class="fas fa-user text-secondary me-1"></i>First Name</label>
                    <input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" placeholder="e.g. John" required>
                    @error('fname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Middle Name --}}
                <div class="mb-3">
                    <label for="mname" class="form-label"><i class="fas fa-user text-secondary me-1"></i>Middle Name</label>
                    <input type="text" class="form-control @error('mname') is-invalid @enderror" id="mname" name="mname" placeholder="(Optional)">
                    @error('mname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Last Name --}}
                <div class="mb-3">
                    <label for="lname" class="form-label"><i class="fas fa-user text-secondary me-1"></i>Last Name</label>
                    <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="e.g. Doe" required>
                    @error('lname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope text-secondary me-1"></i>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="e.g. john@example.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone Number --}}
                <div class="mb-3">
                    <label for="phone_number" class="form-label"><i class="fas fa-phone text-secondary me-1"></i>Phone Number</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="e.g. 09123456789" required>
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="fas fa-lock text-secondary me-1"></i>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label"><i class="fas fa-lock text-secondary me-1"></i>Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                {{-- Submit --}}
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus me-1"></i>Create Caretaker
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
