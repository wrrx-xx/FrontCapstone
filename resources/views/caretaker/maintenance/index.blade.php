@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Maintenance Requests Assigned to You</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($requests->isEmpty())
        <div class="alert alert-info">No maintenance requests assigned to you at the moment.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Listing</th>
                    <th>Tenant</th>
                    <th>Issue</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $index => $request)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $request->listing->title ?? 'N/A' }}</td>
                    <td>{{ $request->tenant->name ?? 'N/A' }}</td>
                    <td>{{ $request->title }}</td>
                    <td>{{ $request->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($request->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($request->status === 'in_progress')
                            <span class="badge bg-primary">In Progress</span>
                        @elseif($request->status === 'resolved')
                            <span class="badge bg-success">Resolved</span>
                        @else
                            <span class="badge bg-secondary">Unknown</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">View</a>
                        {{-- Optional: status update --}}
                        {{-- <a href="{{ route('caretaker.maintenance.edit', $request->id) }}" class="btn btn-sm btn-secondary">Update</a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
