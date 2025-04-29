@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container">
    <div class="card shadow rounded-4">
        <div class="card-body p-4">
            <h4 class="mb-4 text-primary"><i class="fas fa-tools me-2"></i>Create Maintenance Request</h4>

            <form method="POST" action="{{ route('tenant.maintenance.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label"><i class="fas fa-heading me-1 text-secondary"></i>Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Short summary (e.g. Leaking faucet)" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label for="category" class="form-label"><i class="fas fa-tags me-1 text-secondary"></i>Category</label>
                    <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                        <option value="">-- Select Category --</option>
                        <option value="Plumbing">🔧 Plumbing</option>
                        <option value="Electrical">💡 Electrical</option>
                        <option value="Internet">🌐 Internet</option>
                        <option value="Appliance">📺 Appliance</option>
                        <option value="Furniture">🪑 Furniture</option>
                        <option value="Other">🛠️ Other</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Priority --}}
                <div class="mb-3">
                    <label for="priority" class="form-label"><i class="fas fa-exclamation-circle me-1 text-secondary"></i>Priority</label>
                    <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror" required>
                        <option value="Low">🟢 Low</option>
                        <option value="Medium">🟡 Medium</option>
                        <option value="High">🟠 High</option>
                        <option value="Urgent">🔴 Urgent</option>
                    </select>
                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label"><i class="fas fa-align-left me-1 text-secondary"></i>Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Explain the issue clearly..." required></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Listing ID --}}
                @php
                    $tenantListing = auth()->check() ? \App\Models\Listing::where('tenant_id', auth()->id())->first() : null;
                @endphp

                @if($tenantListing)
                    <input type="hidden" name="listing_id" value="{{ $tenantListing->id }}">
                @else
                    <div class="mb-3">
                        <label for="listing_id" class="form-label"><i class="fas fa-building me-1 text-secondary"></i>Select Listing</label>
                        <select name="listing_id" id="listing_id" class="form-select @error('listing_id') is-invalid @enderror" required>
                            @foreach(\App\Models\Listing::all() as $listing)
                                <option value="{{ $listing->id }}">{{ $listing->title }}</option>
                            @endforeach
                        </select>
                        @error('listing_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                {{-- Preferred Schedule --}}
                <div class="mb-3">
                    <label for="preferred_schedule" class="form-label"><i class="fas fa-calendar-alt me-1 text-secondary"></i>Preferred Schedule</label>
                    <input type="datetime-local" class="form-control @error('preferred_schedule') is-invalid @enderror" id="preferred_schedule" name="preferred_schedule">
                    @error('preferred_schedule')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Photo Upload --}}
                <div class="mb-3">
                    <label for="photo" class="form-label"><i class="fas fa-image me-1 text-secondary"></i>Upload Photo (optional)</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane me-1"></i>Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
