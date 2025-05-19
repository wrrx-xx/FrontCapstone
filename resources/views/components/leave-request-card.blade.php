@props(['request'])

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="card-title mb-1">{{ $request->listing->title }}</h5>
                <p class="text-muted mb-0">
                    <small>
                        Tenant: <strong>{{ $request->tenant->fname }} {{ $request->tenant->mname }} {{ $request->tenant->lname }}</strong>
                        <br>
                        • Requested {{ $request->created_at->diffForHumans() }}
                    </small>
                </p>
            </div>
            <div class="badge bg-warning">Pending</div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="text-primary me-2"></i>
                    {{ $request->listing->title }}
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                    {{ $request->listing->address }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="fas fa-calendar text-primary me-2"></i>
                    Tenant since: {{ \Carbon\Carbon::parse($request->listing->tenant_since)->format('M d, Y') }}
                </div>
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-end gap-2">
            <form action="{{ route('owner.leave-requests.decline', $request->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-times me-1"></i> Decline
                </button>
            </form>
            <form action="{{ route('owner.leave-requests.approve', $request->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check me-1"></i> Approve
                </button>
            </form>
        </div>
    </div>
</div>
