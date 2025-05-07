@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/glightbox/css/glightbox.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/splide-master/dist/css/splide.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<section class="main-content">
<main>
    <section class="pt-3 pt-md-4">
        <div class="container card-grid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mt-3">
                        <!-- Property image START -->
                        <div class="col-lg-8">
                            <div class="splide splide-main" data-splide='{"type":"fade","heightRatio":0.5,"pagination":false,"arrows":false,"cover":true,"lazyLoad":"sequential"}'>
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($listing->photos as $photo)
                                            <li class="splide__slide h-400 rounded">
                                                <img src="{{ asset($photo->photo_url) }}" alt="">
                                                <a href="{{ asset($photo->photo_url) }}" class="stretched-link" data-glightbox="" data-gallery="banner"></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="splide splide-thumb" data-splide='{"rewind":true,"fixedWidth":200,"fixedHeight":120,"isNavigation":true,"gap":10,"focus":"center","pagination":false,"cover":true,"lazyLoad":"sequential","breakpoints":{"600":{"fixedWidth":100,"fixedHeight":80}}}'>
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($listing->photos as $photo)
                                            <li class="splide__slide">
                                                <img src="{{ asset($photo->photo_url) }}" alt="">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Property image END -->

                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="lh-1 mb-3">{{ $listing->title }}</h3>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="text-success mb-0 me-2">{{ $listing->price }}</h4>
                                        <span class="me-2">/</span>
                                        <h6 class="mb-0 text-muted me-3">{{ $listing->reservation_amount }}</h6>
                                        <p class="badge bg-orange text-white mb-0">{{ $listing->reservation }}</p>
                                    </div>
                                    <p class="mb-0">{{ $listing->body }}</p>
                                    <button type="button" class="btn btn-info mt-3" data-bs-toggle="modal" data-bs-target="#tenantProfileModal">
                                        View Tenant Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Listing Details Section -->
        <div class="row g-0 mt-5" id="detail">
            <div class="col-12 border rounded p-4">
                <div class="row">
                    <div class="primary-line mb-4">
                        <h3>Details</h3>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <ul class="list-group list-group-borderless">
                            <li class="list-group-item px-0">
                                Property ID:<span class="text-body ms-2">{{ $listing->id }}</span>
                            </li>

                            <li class="list-group-item px-0">
                                Price:<span class="text-body ms-2">{{ $listing->price }}</span>
                            </li>
                            <li class="list-group-item px-0">
                                Owner ID:<span class="text-body ms-2">{{ $listing->owner_id }}</span>
                            </li>
                            <li class="list-group-item px-0">
                                Category:<span class="text-body ms-2">{{ $listing->type }}</span>
                            </li>


                            <li class="list-group-item px-0">

                                Ownership:<span class="text-body ms-2">{{ $listing->user->fname }}
                                    {{ $listing->user->mname }} {{ $listing->user->lname }}</span>

                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <ul class="list-group list-group-borderless">
                            <li class="list-group-item px-0">
                                Address:<span class="text-body ms-2">{{ $listing->address }}</span>
                            </li>
                            <li class="list-group-item px-0">
                                Barangay:<span class="text-body ms-2">{{ $listing->baranggay }}</span>
                            </li>
                            <li class="list-group-item px-0">
                                City:<span class="text-body ms-2">{{ $listing->city }}</span>
                            </li>


                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <ul class="list-group list-group-borderless">
                            <li class="list-group-item px-0">
                                Availability:<span
                                    class="text-body ms-2">{{ $listing->availability }}</span>
                            </li>
                            <li class="list-group-item px-0">
                                Reservation:<span
                                    class="text-body ms-2">{{ $listing->reservation }}</span>
                            </li>
                            <li class="list-group-item px-0">
                                Reservation Amount:<span
                                    class="text-body ms-2">{{ $listing->reservation_amount }}</span>
                            </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tenant Profile Modal -->
        <div class="modal fade" id="tenantProfileModal" tabindex="-1" aria-labelledby="tenantProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tenantProfileModalLabel">Tenant Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($listing->tenant)
                            <p><strong>Name:</strong> {{ $listing->tenant->fname }} {{ $listing->tenant->mname }} {{ $listing->tenant->lname }}</p>
                            <p><strong>Email:</strong> {{ $listing->tenant->email }}</p>
                            <p><strong>Phone:</strong> {{ $listing->tenant->phone_number }}</p>
                            <p><strong>Emergency Contact Name:</strong> {{ $listing->tenant->tenantProfile->emergency_contact_name }}</p>
                            <p><strong>Emergency Contact Phone:</strong> {{ $listing->tenant->tenantProfile->emergency_contact_phone }}</p>
                            <p><strong>Valid ID Type:</strong>
                                @switch($listing->tenant->tenantProfile->valid_id_type)
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
                            <p><strong>Current Address:</strong> {{ $listing->tenant->tenantProfile->current_address }}</p>
                            <p><strong>Monthly Income:</strong> ${{ number_format($listing->tenant->tenantProfile->monthly_income, 2) }}</p>

                            <!-- Valid ID Front -->
                            <p><strong>Valid ID Front:</strong></p>
                            @if ($listing->tenant->tenantProfile->valid_id_front_path)
                                <img src="{{ asset('storage/' . $listing->tenant->tenantProfile->valid_id_front_path) }}" alt="Valid ID Front" class="img-fluid" style="max-width: 100%; height: auto;">
                            @else
                                <p>N/A</p>
                            @endif

                            <!-- Valid ID Back -->
                            <p><strong>Valid ID Back:</strong></p>
                            @if ($listing->tenant->tenantProfile->valid_id_back_path)
                                <img src="{{ asset('storage/' . $listing->tenant->tenantProfile->valid_id_back_path) }}" alt="Valid ID Back" class="img-fluid" style="max-width: 100%; height: auto;">
                            @else
                                <p>N/A</p>
                            @endif
                        @else
                            <p>No tenant profile found.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
@endsection

<script src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/vendor/sticky-js/sticky.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script>
<script src="{{ asset('assets/vendor/splide-master/dist/js/splide.min.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var splide = new Splide('.splide-main').mount();
        var splideThumb = new Splide('.splide-thumb').mount();
    });
</script>