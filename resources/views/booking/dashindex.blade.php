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
                                                {{ $viewing->requestedBy->fname }} {{ $viewing->requestedBy->mname }}
                                                {{ $viewing->requestedBy->lname }}
                                            </td>
                                            <td class="align-middle">
                                                {{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}</td>
                                            <td class="align-middle">
                                                {{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }}</td>
                                            <td class="align-middle">
                                                <span
                                                    class="badge 
                                                @if ($viewing->viewing_status == 'approved') bg-success 
                                                @elseif($viewing->viewing_status == 'declined') bg-danger 
                                                @elseif($viewing->viewing_status == 'cancelled') bg-warning 
                                                @else bg-secondary @endif">
                                                    {{ ucfirst($viewing->viewing_status) }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <!-- Button to trigger modal -->
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#viewingModal{{ $viewing->id }}">
                                                    View Detail
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="viewingModal{{ $viewing->id }}" tabindex="-1"
                                                    aria-labelledby="viewingModalLabel{{ $viewing->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="viewingModalLabel{{ $viewing->id }}">Viewing
                                                                    Details</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Viewing Details -->
                                                                <h6 class="mb-3">Viewing Information</h6>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p><strong>Listing:</strong>
                                                                            {{ $viewing->listing->title }}</p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <p><strong>Time:</strong>
                                                                            {{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <p><strong>Visit Date:</strong>
                                                                            {{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}
                                                                        </p>
                                                                    </div>
                                                                   
                                                                  


                                                                    <!-- Tenant Profile Details -->
                                                                    <hr>
                                                                    <h6 class="mb-3">Tenant Profile</h6>
                                                                    <p><strong>Requested By:</strong>
                                                                        {{ $viewing->requestedBy->fname }}
                                                                        {{ $viewing->requestedBy->mname }}
                                                                        {{ $viewing->requestedBy->lname }}</p>
                                                                    @if ($viewing->requestedBy->tenantProfile)
                                                                        <p><strong>Current Address:</strong>
                                                                            {{ $viewing->requestedBy->tenantProfile->current_address }}
                                                                        </p>
                                                                        <p><strong>Email:</strong>
                                                                            {{ $viewing->requestedBy->email }}</p>
                                                                        <p><strong>Phone Number:</strong>
                                                                            {{ $viewing->requestedBy->phone_number }}</p>
                                                                        <p><strong>Employment Status:</strong>
                                                                            {{ $viewing->requestedBy->tenantProfile->employment_status }}
                                                                        </p>
                                                                        <p><strong>Monthly Income:</strong>
                                                                            ${{ number_format($viewing->requestedBy->tenantProfile->monthly_income, 2) }}
                                                                        </p>
                                                                        <p><strong>Emergency Contact Name:</strong>
                                                                            {{ $viewing->requestedBy->tenantProfile->emergency_contact_name }}
                                                                        </p>
                                                                        <p><strong>Emergency Contact Phone:</strong>
                                                                            {{ $viewing->requestedBy->tenantProfile->emergency_contact_phone }}
                                                                        </p>
                                                                        <p><strong>Valid ID Type:</strong>
                                                                            @switch($viewing->requestedBy->tenantProfile->valid_id_type)
                                                                                @case('driver_license')
                                                                                    Driver's License
                                                                                    @break
                                                                                    @case('student_id')
                                                                                    School ID
                                                                                    @break
                                                                                @case('passport')
                                                                                    Passport
                                                                                    @break
                                                                                @case('national_id')
                                                                                    National ID
                                                                                    @break
                                                                                @case('voter_id')
                                                                                    Voter ID
                                                                                    @break
                                                                                @case('other')
                                                                                    Other
                                                                                    @break
                                                                                @default
                                                                                    Not specified
                                                                            @endswitch
                                                                        </p>
                                                                        <p><strong>Valid ID Front:</strong>
                                                                            @if ($viewing->requestedBy->tenantProfile->valid_id_front_path)
                                                                                <img src="{{ asset('storage/' . $viewing->requestedBy->tenantProfile->valid_id_front_path) }}"
                                                                                    alt="Valid ID Front" class="img-fluid"
                                                                                    style="max-width: 100%; height: auto;">
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </p>
                                                                        <p><strong>Valid ID Back:</strong>
                                                                            @if ($viewing->requestedBy->tenantProfile->valid_id_back_path)
                                                                                <img src="{{ asset('storage/' . $viewing->requestedBy->tenantProfile->valid_id_back_path) }}"
                                                                                    alt="Valid ID Back" class="img-fluid"
                                                                                    style="max-width: 100%; height: auto;">
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </p>
                                                                    @else
                                                                        <p>No tenant profile found.</p @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form
                                                                        action="{{ route('booking.accept', $viewing->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-success">Accept</button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ route('booking.decline', $viewing->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Decline</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

            .table th,
            .table td {
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
