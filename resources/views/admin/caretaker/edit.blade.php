@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Caretaker: {{ $caretaker->fname }} {{ $caretaker->lname }}</h1>

    <form action="{{ route('admin.caretaker.update', $caretaker->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" value="{{ old('fname', $caretaker->fname) }}" required>
            @error('fname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
<div class="mb-3">
            <label for="mname" class="form-label">Middle Name</label>
            <input type="text" class="form-control @error('mname') is-invalid @enderror" id="mname" name="mname" value="{{ old('mname', $caretaker->mname) }}" required>
            @error('mname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" value="{{ old('lname', $caretaker->lname) }}" required>
            @error('lname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $caretaker->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $caretaker->phone_number) }}" required>
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (leave blank to keep current password)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Update Caretaker</button>
        <a href="{{ route('admin.caretaker.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
