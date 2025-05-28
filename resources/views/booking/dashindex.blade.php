    @extends('layouts.app')

    @section('content')
    <style>
        .id-flip-card {
    background-color: transparent;
    width: 500px;
    height: 250px;
    perspective: 1000px;
    cursor: pointer;
}

.id-flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.6s;
    transform-style: preserve-3d;
}

.id-flip-card.flipped .id-flip-card-inner {
    transform: rotateY(180deg);
}

.id-flip-card-front, .id-flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 10px;
}

.id-flip-card-front {
    background-color: #fff;
}

.id-flip-card-back {
    background-color: #fff;
    transform: rotateY(180deg);
}

        </style>
        <div class="main-content">
        @if (session('success') || $errors->any())
                <!-- Feedback Modal -->
                @include('components.feedback-modal')
            @endif
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
                                                            <div class="modal-body p-4">
                                                                <!-- Valid ID Flip Card -->
                                                                @if ($viewing->requestedBy->tenantProfile && $viewing->requestedBy->tenantProfile->valid_id_front_path && $viewing->requestedBy->tenantProfile->valid_id_back_path)
                                                                    <div class="d-flex justify-content-center mb-4">
                                                                        <div class="id-flip-card" onclick="this.classList.toggle('flipped')">
                                                                            <div class="id-flip-card-inner">
                                                                                <div class="id-flip-card-front">
                                                                                    <img src="{{ asset($viewing->requestedBy->tenantProfile->valid_id_front_path) }}" alt="ID Front" class="img-fluid rounded">
                                                                                </div>
                                                                                <div class="id-flip-card-back">
                                                                                    <img src="{{ asset($viewing->requestedBy->tenantProfile->valid_id_back_path) }}" alt="ID Back" class="img-fluid rounded">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                
                                                                <!-- Viewing Information Section -->
                                                                <div class="card mb-4">
                                                                    <div class="card-body">
                                                                        <h6 class="card-title mb-3">Viewing Information</h6>
                                                                        <div class="row g-3">
                                                                            <div class="col-md-6">
                                                                                <p class="mb-2"><strong>Listing:</strong> {{ $viewing->listing->title }}</p>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <p class="mb-2"><strong>Time:</strong> {{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }}</p>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <p class="mb-2"><strong>Visit Date:</strong> {{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Tenant Profile Details -->
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h6 class="card-title mb-3">Tenant Profile</h6>
                                                                        <p class="mb-3"><strong>Requested By:</strong> {{ $viewing->requestedBy->fname }} {{ $viewing->requestedBy->mname }} {{ $viewing->requestedBy->lname }}</p>
                                                                    
                                                                        @if ($viewing->requestedBy->tenantProfile)
                                                                            <div class="row g-3">
                                                                                <div class="col-md-6">
                                                                                    <p class="mb-2"><strong>Current Address:</strong> {{ $viewing->requestedBy->tenantProfile->current_address }}</p>
                                                                                    <p class="mb-2"><strong>Email:</strong> {{ $viewing->requestedBy->email }}</p>
                                                                                    <p class="mb-2"><strong>Phone Number:</strong> {{ $viewing->requestedBy->phone_number }}</p>
                                                                                    <p class="mb-2"><strong>Employment Status:</strong> {{ $viewing->requestedBy->tenantProfile->employment_status }}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p class="mb-2"><strong>Monthly Income:</strong> {{ number_format($viewing->requestedBy->tenantProfile->monthly_income, 2) }}</p>
                                                                                    <p class="mb-2"><strong>Emergency Contact Name:</strong> {{ $viewing->requestedBy->tenantProfile->emergency_contact_name }}</p>
                                                                                    <p class="mb-2"><strong>Emergency Contact Phone:</strong> {{ $viewing->requestedBy->tenantProfile->emergency_contact_phone }}</p>
                                                                                    <p class="mb-2"><strong>Valid ID Type:</strong>
                                                                                        @switch($viewing->requestedBy->tenantProfile->valid_id_type)
                                                                                            @case('driver_license') Driver's License @break
                                                                                            @case('student_id') School ID @break
                                                                                            @case('passport') Passport @break
                                                                                            @case('national_id') National ID @break
                                                                                            @case('voter_id') Voter ID @break
                                                                                            @case('other') Other @break
                                                                                            @default Not specified
                                                                                        @endswitch
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <p>No tenant profile found.</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Modal Footer -->
                                                            <div class="modal-footer">
                                                                @if($viewing->viewing_status == 'pending')
                                                                    <form action="{{ route('booking.accept', $viewing->id) }}" method="POST" class="me-2">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-success">Accept</button>
                                                                    </form>
                                                                    <form action="{{ route('booking.decline', $viewing->id) }}" method="POST" class="me-2">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger">Decline</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#suggestTimeModal{{ $viewing->id }}">
                                                                        Suggest Alternative Time
                                                                    </button>
                                                                @elseif($viewing->viewing_status == 'approved')
                                                                    <form action="{{ route('booking.decline', $viewing->id) }}" method="POST" class="me-2">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger">Decline</button>
                                                                    </form>
                                                                @elseif($viewing->viewing_status == 'declined')
                                                                    <form action="{{ route('booking.accept', $viewing->id) }}" method="POST" class="me-2">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-success">Accept</button>
                                                                    </form>
                                                                @endif
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Suggest Time Modal -->
                                                <div class="modal fade" id="suggestTimeModal{{ $viewing->id }}" tabindex="-1" aria-labelledby="suggestTimeModalLabel{{ $viewing->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="suggestTimeModalLabel{{ $viewing->id }}">Suggest Alternative Time</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('booking.suggest-time', $viewing->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="suggested_date" class="form-label">Suggested Date</label>
                                                                        <input type="date" class="form-control" id="suggested_date" name="suggested_date" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="suggested_time" class="form-label">Suggested Time</label>
                                                                        <input type="time" class="form-control" id="suggested_time" name="suggested_time" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="suggestion_reason" class="form-label">Reason for Suggestion</label>
                                                                        <textarea class="form-control" id="suggestion_reason" name="suggestion_reason" rows="3" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Send Suggestion</button>
                                                                </div>
                                                            </form>
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
        <div class="d-flex justify-content-center mt-3">
            {{ $viewings->links('pagination::bootstrap-5') }}

        </div>
    </div>
<!-- Bootstrap 5 CSS -->


        <style>
            .table-responsive {
                margin-top: 20px;
            }

            .table th,
            .table td {
                vertical-align: middle;
            }

            .text-primary {
                color: black !important;
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

            /* Modal styles */
            .modal-body .card {
                border: 1px solid rgba(0,0,0,.125);
                box-shadow: 0 2px 4px rgba(0,0,0,.05);
                border-radius: 8px;
                transition: box-shadow 0.3s ease;
            }

            .modal-body .card:hover {
                box-shadow: 0 4px 8px rgba(0,0,0,.1);
            }

            .modal-body .card-body {
                padding: 1.5rem;
            }

            .modal-body .card-title {
                color: #2c3e50;
                font-weight: 600;
            }

            .modal-body p {
                color: #4a5568;
                line-height: 1.6;
            }

            .modal-body strong {
                color: #2d3748;
            }

            .modal-footer form {
                margin: 0;
            }
        </style>
        @if (session('success') || $errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new bootstrap.Modal(document.getElementById('feedbackModal')).show();
                    });
                </script>
            @endif
    @endsection
