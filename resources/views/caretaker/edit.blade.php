@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container">
        <h2>Edit Caretaker</h2>

        <form action="{{ route('caretaker.update', $caretaker->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" 
                       value="{{ old('fname', $caretaker->fname) }}" required>
            </div>

            <div class="mb-3">
                <label for="mname" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="mname" name="mname" 
                       value="{{ old('mname', $caretaker->mname) }}">
            </div>

            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" 
                       value="{{ old('lname', $caretaker->lname) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="{{ old('email', $caretaker->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" 
                       value="{{ old('phone_number', $caretaker->phone_number) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Caretaker</button>
            <a href="{{ route('caretaker.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
