@extends('layouts.app')

@section('content')
    <div class="main-content">
        @if (session('success') || $errors->any())
            <!-- Feedback Modal -->
            @include('components.feedback-modal')
        @endif
        <div class="container py-4">
            <h2 class="mb-4">Maintenance Requests</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @php
                // Group requests by owner id
                $groupedRequests = $requests->groupBy(function ($request) {
                    return $request->listing->user ? $request->listing->user->id : 'unknown';
                });
            @endphp

            @if ($requests->isEmpty())
                <div class="alert alert-info">No maintenance requests at the moment.</div>
            @else
                @foreach ($groupedRequests as $ownerId => $ownerRequests)
                    @php
                        $owner = $ownerRequests->first()->listing->user;
                        $ownerName = $owner ? $owner->fname . ' ' . $owner->mname . ' ' . $owner->lname : 'Unknown Owner';
                    @endphp

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 ">
                                <i class="fas fa-user-tie me-2 text-white"></i> Owner: {{ $ownerName }}
                                <span class="badge bg-light text-dark float-end">{{ $ownerRequests->count() }} Requests</span>
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Room</th>
                                            <th>Tenant</th>
                                            <th>Issue</th>
                                            <th>Date Requested</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ownerRequests as $index => $request)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $request->listing->title ?? 'N/A' }}</td>
                                                <td>
                                                    {{ $request->tenant->fname ?? '' }}
                                                    {{ $request->tenant->mname ?? '' }}
                                                    {{ $request->tenant->lname ?? '' }}
                                                </td>
                                                <td>{{ $request->title }}</td>
                                                <td>{{ $request->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    @if ($request->status === 'Pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($request->status === 'In Progress')
                                                        <span class="badge bg-primary">In Progress</span>
                                                    @elseif($request->status === 'Completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @elseif($request->status === 'Cancelled')
                                                        <span class="badge bg-secondary">Cancelled</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info view-details-btn"
                                                        data-bs-toggle="modal" data-bs-target="#maintenanceDetailsModal"
                                                        data-title="{{ $request->title }}"
                                                        data-description="{{ $request->description }}"
                                                        data-category="{{ $request->category }}"
                                                        data-priority="{{ $request->priority }}" data-status="{{ $request->status }}"
                                                        data-preferred_schedule="{{ $request->preferred_schedule }}"
                                                        data-photo_path="{{ $request->photo_path ? asset('storage/' . $request->photo_path) : '' }}">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>

                                                    <button class="btn btn-sm btn-warning edit-request-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editRequestModal" data-id="{{ $request->id }}"
                                                        data-status="{{ $request->status }}" data-remarks="{{ $request->remarks }}">
                                                        Update
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Edit Request Modal -->
        <div class="modal fade" id="editRequestModal" tabindex="-1" aria-labelledby="editRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" id="editRequestForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editRequestModalLabel">Update Maintenance Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea name="remarks" id="remarks" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="proof" class="form-label">Proof of Work (optional)</label>
                                <input type="file" name="proof" id="proof" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
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
                                <p><i class="fas fa-tools me-2 text-primary"></i><strong>Title:</strong><br> <span
                                        id="modalTitle"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-tags me-2 text-success"></i><strong>Category:</strong><br> <span
                                        id="modalCategory"></span></p>
                            </div>

                            <div class="col-md-12">
                                <p><i class="fas fa-align-left me-2 text-warning"></i><strong>Description:</strong><br>
                                    <span id="modalDescription"></span>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p><i class="fas fa-exclamation-circle me-2 text-danger"></i><strong>Priority:</strong><br>
                                    <span id="modalPriority"></span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-calendar-alt me-2 text-info"></i><strong>Preferred
                                        Schedule:</strong><br>
                                    <span id="modalPreferredSchedule"></span>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p><i class="fas fa-info-circle me-2 text-secondary"></i><strong>Status:</strong><br>
                                    <span id="modalStatus"></span>
                                </p>
                            </div>

                            <div class="col-md-12">
                                <p><i class="fas fa-image me-2 text-muted"></i><strong>Photo:</strong><br>
                                    <img id="modalPhoto" src="" alt="No photo" class="img-fluid rounded border"
                                        style="max-height: 300px;">
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
                    document.getElementById('modalDescription').textContent = button.getAttribute(
                        'data-description');
                    document.getElementById('modalCategory').textContent = button.getAttribute('data-category');
                    document.getElementById('modalPriority').textContent = button.getAttribute('data-priority');
                    document.getElementById('modalStatus').textContent = button.getAttribute('data-status');
                    document.getElementById('modalPreferredSchedule').textContent = button.getAttribute(
                        'data-preferred_schedule') || 'N/A';
                    var photoPath = button.getAttribute('data-photo_path');
                    var modalPhoto = document.getElementById('modalPhoto');
                    if (photoPath) {
                        modalPhoto.src = photoPath;
                        modalPhoto.style.display = 'block';
                    } else {
                        modalPhoto.style.display = 'none';
                    }
                });

                // Edit Request Modal population
                var editRequestModal = document.getElementById('editRequestModal');
                editRequestModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');
                    var status = button.getAttribute('data-status');
                    var remarks = button.getAttribute('data-remarks');

                    var form = document.getElementById('editRequestForm');
                    form.action = '/owner/maintenance/request/' + id; // Set the form action URL dynamically

                    document.getElementById('status').value = status;
                    document.getElementById('remarks').value = remarks || '';
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
    </div>
@endsection