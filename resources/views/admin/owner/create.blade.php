@extends('layouts.app')

@section('content')
<div class="main-content">
    <h1>Add New Owner</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.owner.store') }}" method="POST">
        @csrf

        <h4>User Information</h4>
        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" name="fname" class="form-control" value="{{ old('fname') }}" required>
        </div>
        <div class="mb-3">
            <label for="mname" class="form-label">Middle Name</label>
            <input type="text" name="mname" class="form-control" value="{{ old('mname') }}">
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" name="lname" class="form-control" value="{{ old('lname') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <h4>Owner Profile</h4>
        <div class="mb-3">
            <label for="business_name" class="form-label">Business Name</label>
            <input type="text" name="business_name" class="form-control" value="{{ old('business_name') }}">
        </div>
        <div class="mb-3">
            <label for="business_address" class="form-label">Business Address</label>
            <input type="text" name="business_address" class="form-control" value="{{ old('business_address') }}">
        </div>
        <div class="mb-3">
            <label for="business_phone" class="form-label">Business Phone</label>
            <input type="text" name="business_phone" class="form-control" value="{{ old('business_phone') }}">
        </div>
        <div class="mb-3">
            <label for="business_email" class="form-label">Business Email</label>
            <input type="email" name="business_email" class="form-control" value="{{ old('business_email') }}">
        </div>
        <div class="mb-3">
            <label for="owner_id_type" class="form-label">Owner ID Type</label>
            <input type="text" name="owner_id_type" class="form-control" value="{{ old('owner_id_type') }}">
        </div>
        <div class="mb-3">
            <label for="owner_id_front_path" class="form-label">Owner ID Front Path</label>
            <input type="text" name="owner_id_front_path" class="form-control" value="{{ old('owner_id_front_path') }}">
        </div>
        <div class="mb-3">
            <label for="owner_id_back_path" class="form-label">Owner ID Back Path</label>
            <input type="text" name="owner_id_back_path" class="form-control" value="{{ old('owner_id_back_path') }}">
        </div>
        <div class="mb-3">
            <label for="additional_info" class="form-label">Additional Info</label>
            <textarea name="additional_info" class="form-control">{{ old('additional_info') }}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="approved" class="form-check-input" id="approved" {{ old('approved') ? 'checked' : '' }}>
            <label class="form-check-label" for="approved">Approved</label>
        </div>

        <button type="submit" class="btn btn-primary">Create Owner</button>
    </form>
</div>
@endsection
