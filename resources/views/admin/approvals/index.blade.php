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
                    <h2 class="mb-4 text-primary">Pending Owner Approvals</h2>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-sm text-left">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Business</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingApprovals as $approval)
                                    <tr>
                                        <td class="align-middle">{{ $approval->user->fname }} {{ $approval->user->lname }}</td>
                                        <td class="align-middle">{{ $approval->business_name }}</td>
                                        <td class="align-middle">{{ $approval->user->email }}</td>
                                        <td class="align-middle">{{ $approval->business_phone }}</td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ownerProfileModal{{ $approval->id }}">
                                                View Detail
                                            </button>

                                            <div class="modal fade" id="ownerProfileModal{{ $approval->id }}" tabindex="-1" aria-labelledby="ownerProfileModalLabel{{ $approval->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ownerProfileModalLabel{{ $approval->id }}">Owner Profile</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Name:</strong> {{ $approval->user->fname }} {{ $approval->user->lname }}</p>
                                                            <p><strong>Email:</strong> {{ $approval->user->email }}</p>
                                                            <p><strong>Phone:</strong> {{ $approval->business_phone }}</p>
                                                            <p><strong>Business Name:</strong> {{ $approval->business_name }}</p>
                                                            <p><strong>Business Address:</strong> {{ $approval->business_address }}</p>
                                                            <p><strong>Owner ID Type:</strong> {{ ucfirst(str_replace('_', ' ', $approval->owner_id_type)) }}</p>
                                                            @if($approval->owner_id_front_path)
                                                                <p><strong>Owner ID Front:</strong></p>
                                                                <img src="{{ asset('storage/' . $approval->owner_id_front_path) }}" alt="Owner ID Front" class="img-fluid" style="max-width: 100%; height: auto;">
                                                            @endif
                                                            @if($approval->owner_id_back_path)
                                                                <p><strong>Owner ID Back:</strong></p>
                                                                <img src="{{ asset('storage/' . $approval->owner_id_back_path) }}" alt="Owner ID Back" class="img-fluid" style="max-width: 100%; height: auto;">
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.approvals.approve', $approval->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Approve</button>
                                                            </form>
                                                            <form action="{{ route('admin.approvals.reject', $approval->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Reject</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500">No pending approvals</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($pendingApprovals->hasPages())
                        <div class="px-6 py-4 bg-gray-50">
                            {{ $pendingApprovals->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-responsive {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            table-layout: auto;
        }
        .table th, .table td {
            vertical-align: middle;
            white-space: nowrap;
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
        .bg-secondary {
            background-color: #6c757d !important;
        }
        @media (max-width: 768px) {
            .table th, .table td {
                white-space: normal;
                font-size: 14px;
            }
        }
    </style>
@endsection