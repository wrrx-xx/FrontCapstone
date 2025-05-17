@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tenants</h1>
    <a href="{{ route('admin.tenant.create') }}" class="btn btn-primary mb-3">Add New Tenant</a>

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
            @foreach($tenants as $tenant)
            <tr>
                <td>{{ $tenant->fname }} {{ $tenant->mname }} {{ $tenant->lname }}</td>
                <td>{{ $tenant->email }}</td>
                <td>{{ $tenant->phone_number }}</td>
                <td>{{ $tenant->tenantProfile->current_address ?? '' }}</td>
                <td>
                    <a href="{{ route('admin.tenant.edit', $tenant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.tenant.destroy', $tenant->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this tenant?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
