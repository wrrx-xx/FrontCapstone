@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container">
    <h1>Guests</h1>
    <a href="{{ route('admin.guest.create') }}" class="btn btn-primary mb-3">Add New Guest</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Current Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
            <tr>
                <td>{{ $guest->fname }} {{ $guest->mname }} {{ $guest->lname }}</td>
                <td>{{ $guest->email }}</td>
                <td>{{ $guest->phone_number }}</td>
                <td>{{ $guest->tenantProfile->current_address ?? '' }}</td>
                <td>
                    <a href="{{ route('admin.guest.edit', $guest->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.guest.destroy', $guest->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this guest?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
