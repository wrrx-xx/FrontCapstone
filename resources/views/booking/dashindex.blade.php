@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-primary">Viewings List</h2>

                <!-- Viewings -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-sm text-left">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Listing</th>
                                <th scope="col">Requested By</th>
                                <th scope="col">Visit Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewings as $viewing)
                                <tr>
                                    <td class="align-middle">{{ $viewing->listing->title }}</td>
                                    <td class="align-middle">
                                        {{ $viewing->requestedBy->fname }} {{ $viewing->requestedBy->mname }} {{ $viewing->requestedBy->lname }}
                                    </td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}</td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }}</td>
                                    <td class="align-middle">
                                        <span class="badge 
                                            @if ($viewing->viewing_status == 'approved') bg-success 
                                            @elseif($viewing->viewing_status == 'declined') bg-danger 
                                            @elseif($viewing->viewing_status == 'cancelled') bg-warning 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($viewing->viewing_status) }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('booking.accept', $viewing->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button class="btn btn-sm btn-success" type="submit">Accept</button>
                                        </form>
                                        <form action="{{ route('booking.decline', $viewing->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit">Decline</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($viewings->isEmpty())
                    <p class="text-center">You have no viewings at this time.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .table-responsive {
        margin-top: 20px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .text-primary {
        color: #007bff !important;
    }
    .bg-success {
        background-color: #28a745 !important;
    }
    .bg-danger {
        background-color: #dc3545 !important;
    }
    .bg-warning {
        background-color: #ffc107 !important;
    }
    .bg-secondary {
        background-color: #6c757d !important;
    }
</style>
@endsection