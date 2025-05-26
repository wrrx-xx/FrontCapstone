@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container">
    <h1>Owners</h1>
    <a href="{{ route('admin.owner.create') }}" class="btn btn-primary mb-3">Add New Owner</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Business Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($owners as $owner)
            <tr>
                <td>{{ $owner->fname }} {{ $owner->mname }} {{ $owner->lname }}</td>
                <td>{{ $owner->email }}</td>
                <td>{{ $owner->phone_number }}</td>
                <td>{{ $owner->ownerProfile->business_name ?? '' }}</td>
                <td>
                    <a href="{{ route('admin.owner.edit', $owner->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.owner.destroy', $owner->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this owner?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
