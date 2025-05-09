@foreach ($listings as $listing)
<div class="col-sm-6 col-lg-4">
    <div class="card mb-4">
        <div class="position-relative overflow-hidden">
            @if ($listing->photos->isNotEmpty())
                <img class="card-img" 
                     src="{{ $listing->photos->first()->photo_url }}" 
                     alt="Property image" 
                     style="width: 100%; height: 200px; object-fit: cover;">
            @else
                <img class="card-img" 
                     src="path_to_default_image.jpg" 
                     alt="No image available" 
                     style="width: 100%; height: 200px; object-fit: cover;">
            @endif
            <div class="card-img-overlay">
                <div class="text-end">
                    <span class="badge bg-{{ $listing->availability === 'open' ? 'success' : 'danger' }}">
                        {{ ucfirst($listing->availability) }}
                    </span>
                </div>
            </div>    
        </div>
        <div class="card-body px-2 pt-3">
            <div class="d-flex justify-content-between">
                <div>
                    <span class="badge bg-primary me-1">
                        <i class="fas fa-home me-1"></i>{{ $listing->type }}
                    </span>
                </div>
            </div>
            <h4 class="card-title mt-3">
                <a href="{{ route('listings.show', $listing->id)}}">{{ $listing->title }}</a>
            </h4>
            <p class="text-muted small mb-2">
                <i class="fas fa-map-marker-alt me-1"></i>
                {{ $listing->baranggay }}, {{ $listing->city }}
            </p>
            <ul class="nav nav-divider align-items-center text-uppercase small mt-3">
                <li class="nav-item me-4">
                    <i class="fas fa-bed pe-1"></i>{{ $listing->bedrooms ?? 'N/A' }}
                </li>
                <li class="nav-item me-4">
                    <i class="fas fa-bath pe-1"></i>{{ $listing->amenities->bathroom ?? 'N/A' }}
                </li>
                <li class="nav-item me-4">
                    <i class="fas fa-user pe-1"></i>{{ $listing->occupancy ?? 'N/A' }}
                </li>
            </ul>
            <div class="mt-3 d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="text-success mb-0">₱{{ number_format($listing->price, 2) }}</h3>
                    <small class="text-muted">/month</small>
                </div>
                <a href="{{ route('listings.show', $listing->id) }}" 
                   class="btn btn-primary btn-sm">View details</a>
            </div>
        </div>
    </div>
</div>
@endforeach
