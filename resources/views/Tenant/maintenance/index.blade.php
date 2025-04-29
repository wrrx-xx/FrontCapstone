@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Maintenance Requests</h2>
        <a href="{{ route('tenant.maintenance.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Request
        </a>
    </div>

    @if (session('success') || $errors->any())
    <!-- Feedback Modal -->
    @include('components.feedback-modal')
@endif

    @if($requests->count())
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Listing</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Preferred Schedule</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->listing ? $request->listing->title : '-' }}</td>
                            <td>{{ $request->title }}</td>
                            <td>{{ $request->category }}</td>
                            <td>
                                <span class="badge 
                                    @if($request->priority == 'Low') bg-success
                                    @elseif($request->priority == 'Medium') bg-primary
                                    @elseif($request->priority == 'High') bg-warning
                                    @elseif($request->priority == 'Urgent') bg-danger
                                    @endif">
                                    {{ $request->priority }}
                                </span>
                            </td>
                            <td>
                                <span class="badge 
                                    @if($request->status == 'Pending') bg-secondary
                                    @elseif($request->status == 'In Progress') bg-primary
                                    @elseif($request->status == 'Completed') bg-success
                                    @elseif($request->status == 'Cancelled') bg-danger
                                    @endif">
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td>
                                {{ $request->preferred_schedule ? \Carbon\Carbon::parse($request->preferred_schedule)->format('M d, Y H:i') : '-' }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#maintenanceDetailsModal"
                                    data-title="{{ $request->title }}"
                                    data-description="{{ $request->description }}"
                                    data-category="{{ $request->category }}"
                                    data-priority="{{ $request->priority }}"
                                    data-status="{{ $request->status }}"
                                    data-preferred_schedule="{{ $request->preferred_schedule }}"
                                    data-photo_path="{{ $request->photo_path ? asset('storage/' . $request->photo_path) : '' }}">
                                    View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $requests->links() }}
        </div>
    @else
        <div class="alert alert-info">
            You have no maintenance requests yet.
        </div>
    @endif
</div>
</div>

<!-- Maintenance Details Modal -->
<div class="modal fade" id="maintenanceDetailsModal" tabindex="-1" aria-labelledby="maintenanceDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="maintenanceDetailsModalLabel">Maintenance Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <p><i class="fas fa-tools me-2 text-primary"></i><strong>Title:</strong><br> <span id="modalTitle"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-tags me-2 text-success"></i><strong>Category:</strong><br> <span id="modalCategory"></span></p>
                    </div>

                    <div class="col-md-12">
                        <p><i class="fas fa-align-left me-2 text-warning"></i><strong>Description:</strong><br> 
                            <span id="modalDescription"></span></p>
                    </div>

                    <div class="col-md-6">
                        <p><i class="fas fa-exclamation-circle me-2 text-danger"></i><strong>Priority:</strong><br> 
                            <span id="modalPriority"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-calendar-alt me-2 text-info"></i><strong>Preferred Schedule:</strong><br> 
                            <span id="modalPreferredSchedule"></span></p>
                    </div>

                    <div class="col-md-6">
                        <p><i class="fas fa-info-circle me-2 text-secondary"></i><strong>Status:</strong><br> 
                            <span id="modalStatus"></span></p>
                    </div>

                    <div class="col-md-12">
                        <p><i class="fas fa-image me-2 text-muted"></i><strong>Photo:</strong><br>
                            <img id="modalPhoto" src="" alt="No photo" class="img-fluid rounded border" style="max-height: 300px;">
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var maintenanceModal = document.getElementById('maintenanceDetailsModal');
    maintenanceModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        document.getElementById('modalTitle').textContent = button.getAttribute('data-title');
        document.getElementById('modalDescription').textContent = button.getAttribute('data-description');
        document.getElementById('modalCategory').textContent = button.getAttribute('data-category');
        document.getElementById('modalPriority').textContent = button.getAttribute('data-priority');
        document.getElementById('modalStatus').textContent = button.getAttribute('data-status');
        document.getElementById('modalPreferredSchedule').textContent = button.getAttribute('data-preferred_schedule') || 'N/A';
        var photoPath = button.getAttribute('data-photo_path');
        var modalPhoto = document.getElementById('modalPhoto');
        if(photoPath){
            modalPhoto.src = photoPath;
            modalPhoto.style.display = 'block';
        } else {
            modalPhoto.style.display = 'none';
        }
    });
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
