@extends('layouts.app')

@section('content')

<div class="main mx-7">
@if (session('success') || $errors->any())
            <!-- Feedback Modal -->
            @include('components.feedback-modal')
        @endif
    <div class="row">
        <div class="col-12">
            <!-- Page title -->
            <!-- Viewings list START -->
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-secondary-soft p-3 p-md-5 rounded">
                        <!-- Title -->
                        <div class="row d-none d-xxl-block">
                            <div class="col-12 align-middle py-3">
                                <div class="row border-bottom">
                                    <div class="col-6">
                                        <h5>Visiting Schedule</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4 align-middle text-body py-2">
                                                <h5>Visit Date</h5>
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

                        <!-- Viewings -->
                        @foreach($viewings as $viewing)
                        <div class="row">
                            <div class="col-12 align-middle py-4">
                                <div class="row">
                                    <div class="col-xxl-6">
                                        <div class="card bg-transparent">
                                            <div class="row">
                                                <!-- Image -->
                                                <div class="col-xl-3">
                                                    <img class="rounded" src="{{ asset($viewing->listing->photos->first()->photo_url) }}" alt="{{ $viewing->listing->title }}">
                                                </div>
                                                <!-- Info -->
                                                <div class="col-xl-9 pt-2 pt-xl-0">
                                                    <h6 class="mb-1">{{ $viewing->listing->title }}</h6>
                                                    <p class="mb-1 text-body">{{ $viewing->listing->address }}</p>
                                                    <span class="text-success">₱{{ number_format($viewing->listing->price, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Content -->
                                    <div class="col-xxl-6 pt-2 pt-xxl-0">
                                        <div class="row">
                                            <!-- Date -->
                                            <div class="col-md-4 align-middle text-body">
                                                {{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}
                                                <div class="col-md-4 align-middle text-body m-2">
                                                    {{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }} <!-- Format the time -->
                                                </div>
                                            </div>
                                            <!-- Badge -->
                                            <div class="col-md-4 align-middle pt-2 pt-md-0">
                                                <div class="badge 
                                                    @if($viewing->viewing_status == 'approved') bg-success 
                                                    @elseif($viewing->viewing_status == 'declined') bg-danger 
                                                    @elseif($viewing->viewing_status == 'cancelled') bg-warning 
                                                    @else bg-secondary @endif">
                                                    {{ ucfirst($viewing->viewing_status) }}
                                                </div>
                                            </div>
                                            <!-- Buttons -->
                                            <div class="col-md-4 align-middle pt-2 pt-md-0">
                                                <button class="btn btn-sm btn-info-soft me-1 mb-1" type="button" data-bs-toggle="modal" data-bs-target="#viewingModal" data-viewing-id="{{ $viewing->id }}" data-viewing-date="{{ $viewing->viewing_date }}" data-viewing-time="{{ $viewing->viewing_time }}" title="View">
                                                    <i class="fas fa-fw fa-eye"></i>
                                                </button>
                                                @if(!in_array($viewing->viewing_status, ['approved', 'declined', 'cancelled']))
                                                <a class="btn btn-sm btn-success-soft me-1 mb-1" href="#" data-bs-toggle="modal" data-bs-target="#editViewingModal" data-viewing-id="{{ $viewing->id }}" data-viewing-date="{{ $viewing->viewing_date }}" data-viewing-time="{{ $viewing->viewing_time }}" title="Edit">
                                                    <i class="far fa-fw fa-edit"></i>
                                                </a>
                                                @endif
                                                <form action="{{ route('viewings.cancel', $viewing->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-sm btn-warning-soft mb-1" type="submit" title="Cancel">
                                                        <i class="fas fa-fw fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Row END -->
                            </div>
                        </div>

                        @if($viewing->suggested_date && $viewing->suggested_time)
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6 class="mb-2">Alternative Time Suggested</h6>
                                    <p class="mb-2">Suggested Date: {{ \Carbon\Carbon::parse($viewing->suggested_date)->format('d M Y') }}</p>
                                    <p class="mb-2">Suggested Time: {{ \Carbon\Carbon::parse($viewing->suggested_time)->format('h:i A') }}</p>
                                    <p class="mb-2">Reason: {{ $viewing->suggestion_reason }}</p>
                                    <div class="mt-2">
                                        <form action="{{ route('viewings.accept-suggestion', $viewing->id) }}" method="POST" class="d-inline me-2">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Accept Suggestion</button>
                                        </form>
                                        <form action="{{ route('viewings.cancel', $viewing->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Decline Suggestion</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <hr> <!-- Divider -->
                        @endforeach

                        @if($viewings->isEmpty())
                            <p class="text-center">You have no viewings at this time.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Viewings list END -->
        </div>
    </div> <!-- Row END -->
</div>

<!-- Viewing Details Modal -->
<div class="modal fade" id="viewingModal" tabindex="-1" aria-labelledby="viewingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewingModalLabel">Viewing Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Viewing details will be populated here -->
            </div>
        </div>
    </div>
</div>

<!-- Edit Viewing Modal -->
<div class="modal fade" id="editViewingModal" tabindex="-1" aria-labelledby="editViewingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editViewingModalLabel">Edit Viewing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <form action="{{ route('viewings.update', $viewing->id) }}" method="POST">
    @csrf
    @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="viewing_date" class="form-label">Viewing Date</label>
                        <input type="date" class="form-control" id="viewing_date" name="viewing_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="viewing_time" class="form-label">Viewing Time</label>
                        <input type="time" class="form-control" id="viewing_time" name="viewing_time" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Viewing</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Populate the edit modal with the viewing details
    var editViewingModal = document.getElementById('editViewingModal');
    editViewingModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var viewingId = button.getAttribute('data-viewing-id');
        var viewingDate = button.getAttribute('data-viewing-date');
        var viewingTime = button.getAttribute('data-viewing-time');

        // Update the modal's form action
        var form = document.getElementById('editViewingForm');
        form.action = '/viewings/' + viewingId; // Update the action URL

        // Populate the fields with the current viewing details
        var dateInput = document.getElementById('viewing_date');
        var timeInput = document.getElementById('viewing_time');
        dateInput.value = viewingDate;
        timeInput.value = viewingTime;
    });
</script>
@if (session('success') || $errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Modal(document.getElementById('feedbackModal')).show();
    });
    
</script>
@endif
@endsection

@endsection