@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-secondary-soft p-3 p-md-5 rounded">
                        <!-- Title -->
                        <div class="row d-none d-xxl-block">
                            <div class="col-12 align-middle py-3">
                                <div class="row border-bottom">
                                    <div class="col-6">
                                        <h5>Reservation Details</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4 align-middle text-body py-2">
                                                <h5>Tenant Name</h5>
                                            </div>
                                            <div class="col-4 align-middle py-2">
                                                <h5>Status</h5>
                                            </div>
                                            <div class="col-4 align-middle py-2">
                                                <h5>Action</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($reservations->isEmpty())
                            <p>No reservations found.</p>
                        @else
                            @foreach($reservations as $reservation)
                                <div class="row align-middle py-4">
                                    <div class="col-xxl-6">
                                        <div class="card bg-transparent">
                                            <div class="row">
                                                <!-- Image -->
                                                <div class="col-xl-3">
                                                    @if($reservation->listing->photos->isNotEmpty())
                                                        <img class="rounded" src="{{ asset($reservation->listing->photos->first()->photo_url) }}" alt="{{ $reservation->listing->title }}">
                                                    @else
                                                        <img class="rounded" src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image">
                                                    @endif
                                                </div>
                                                <!-- Info -->
                                                <div class="col-xl-9 pt-2 pt-xl-0">
                                                    <h6 class="mb-1">{{ $reservation->listing->title }}</h6>
                                                    <p class="mb-1 text-body">{{ Str::limit($reservation->listing->body, 100) }}</p>
                                                    <span class="text-success">${{ $reservation->listing->price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Content -->
                                    <div class="col-xxl-6 pt-2 pt-xxl-0">
                                        <div class="row">
                                            <!-- Tenant Name -->
                                            <div class="col-md-4 align-middle text-body">
                                                {{ $reservation->prospect->fname . ' ' . $reservation->prospect->mname . ' ' . $reservation->prospect->lname }}
                                            </div>
                                            <!-- Reservation Status -->
                                            <div class="col-md-4 align-middle pt-2 pt-md-0">
                                                <div class="badge {{ $reservation->reservation_status == 'approved' ? 'bg-success-soft text-success' : ($reservation->reservation_status == 'declined' ? 'bg-danger-soft text-danger' : 'bg-warning-soft text-warning') }}">
                                                    {{ ucfirst($reservation->reservation_status) }}
                                                </div>
                                            </div>
                                            <!-- Action Buttons -->
                                            <div class="col-md-4 align-middle pt-2 pt-md-0">
                                                @if($reservation->reservation_status != 'approved' && $reservation->reservation_status != 'declined')
                                                    <form action="{{ route('reservation.approve', $reservation->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success-soft me-1 mb-1">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('reservation.decline', $reservation->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger-soft mb-1">
                                                            Decline
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Row END -->
                                <hr> <!-- Divider -->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- Reservations list END -->
        </div>
    </div> <!-- Row END -->
</div>

@endsection
