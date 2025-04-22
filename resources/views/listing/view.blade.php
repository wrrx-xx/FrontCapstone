@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/glightbox/css/glightbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/splide-master/dist/css/splide.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <main>
        @if (session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif
        <section class="pt-3 pt-md-4">
            <div class="container card-grid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mt-3">

                            <!-- Property image START -->

                            <div class="col-lg-8">

                                <!-- Primary image -->

                                <div class="splide splide-main"
                                    data-splide='{"type":"fade","heightRatio":0.5,"pagination":false,"arrows":false,"cover":true,"lazyLoad":"sequential"}'>

                                    <div class="splide__track">

                                        <ul class="splide__list">

                                            @foreach ($listing->photos as $photo)
                                                <li class="splide__slide h-400 rounded">

                                                    <img src="{{ Storage::url($photo->photo_url) }}" alt="">

                                                    <!-- Glightbox image -->

                                                    <a href="{{ Storage::url($photo->photo_url) }}" class="stretched-link"
                                                        data-glightbox="" data-gallery="banner"></a>

                                                </li>
                                            @endforeach

                                        </ul>

                                    </div>

                                </div>

                                <!-- Secondary image -->

                                <div class="splide splide-thumb"
                                    data-splide='{"rewind":true,"fixedWidth":200,"fixedHeight":120,"isNavigation":true,"gap":10,"focus":"center","pagination":false,"cover":true,"lazyLoad":"sequential","breakpoints":{"600":{"fixedWidth":100,"fixedHeight":80}}}'>

                                    <div class="splide__track">

                                        <ul class="splide__list">

                                            @foreach ($listing->photos as $photo)
                                                <li class="splide__slide">

                                                    <img src="{{ Storage::url($photo->photo_url) }}" alt="">

                                                </li>
                                            @endforeach

                                        </ul>

                                    </div>

                                    <!-- Arrows -->

                                    <div class="splide__arrows">

                                        <button class="splide__arrow splide__arrow--prev p-splide__arrow--prev bg-primary">

                                            <span class="spi-angle-left text-white"><i
                                                    class="fas fa-fw fa-angle-left"></i></span>

                                        </button>

                                        <button class="splide__arrow splide__arrow--next p-splide__arrow--next bg-primary">

                                            <span class="spi-angle-right text-white"><i
                                                    class="fas fa-fw fa-angle-right"></i></span>

                                        </button>

                                    </div>

                                </div>

                            </div>

                            <!-- Property image END -->

                            <div class="col-lg-4 mt-4 mt-lg-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between mb-4">
                                            <div>
                                                <a href="#" class="badge bg-orange text-white">Featured</a>
                                                <a href="#" class="badge bg-danger-soft text-danger"><i
                                                        class="fas fa-rupee-sign pe-1"></i>For sale</a>
                                            </div>
                                            <ul class="list-inline text-primary-hover">
                                                <li class="list-inline-item"><a href="#"
                                                        class="border rounded p-1 me-1 small"><i
                                                            class="fas fa-fw fa-print"></i></a></li>
                                                <li class="list-inline-item position-relative">
                                                    <a href="#" class="btn-link border rounded p-1 me-1 small"
                                                        role="button" id="dropdownShare" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fas fa-fw fa-share-alt"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-w-sm dropdown-menu-end rounded"
                                                        aria-labelledby="dropdownShare">
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="fab fa-twitter-square me-2"></i>Twitter</a></li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="fab fa-facebook-square me-2"></i>Facebook</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="fab fa-linkedin me-2"></i>LinkedIn</a></li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="fas fa-copy me-2"></i>Copy link</a></li>
                                                    </ul>
                                                </li>
                                                <li class="list-inline-item"><a href="#"
                                                        class="border rounded p-1 me-1 small"><i
                                                            class="fas fa-fw fa-heart text-danger"></i></a></li>
                                            </ul>
                                        </div>
                                        <h3 class="lh-1 mb-3">{{ $listing->title }}</h3>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="text-success mb-0 me-2">{{ $listing->price }}</h4>
                                            <span class="me-2">/</span>

                                            <h6 class=" mb-0 text-muted me-3">{{ $listing->reservation_amount }}</h6>
                                            <p class="badge bg-orange text-white mb-0">{{ $listing->reservation }}</p>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12 mb-0">
                                                <ul class="list-group list-group-borderless">
                                                    <li class="list-group-item text-dark px-0 d-flex">
                                                        Address:<span class="text-body ms-2">{{ $listing->address }}</span>
                                                            </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 mb-0">
                                                <ul class="list-group list-group-borderless">
                                                    <li class="list-group-item text-dark px-0">
                                                        City:<span class="text-body ms-2">{{ $listing->city }}</span>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="col-sm-6 mb-0">
                                                <ul class="list-group list-group-borderless">
                                                    <li class="list-group-item text-dark px-0">
                                                        Barangay:<span
                                                            class="text-body ms-2">{{ $listing->baranggay }}</span>
                                                    </li>

                                                </ul>
                                            </div>

                                        </div>
                                        <p class="mb-0">{{ $listing->body }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-0">
            <div class="container position-relative" data-sticky-container="">
                <div class="row">
                    <div class="col-lg-8">
                        <nav id="navbar-example" class="navbar navbar-dark bg-dark rounded">
                            <ul class="nav p-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="#description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#detail">Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#amenities">Amenities</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#review">Review</a>
                                </li>
                            </ul>
                        </nav>

                        <div class="row g-0 mt-5" id="description">
                            <div class="col-12 border rounded p-4">
                                <div class="row">
                                    <div class="mb-4">
                                        <h3>Description</h3>
                                    </div>

                                    <p class="mt-3">{{ $listing->body }}</p>
                                </div>
                            </div>
                        </div>

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

                        <div class="row g-0 mt-5" id="amenities">
                            <div class="col-12 border rounded p-4">
                                <div class="row">
                                    <div class="mb-4">
                                        <h3>Amenities</h3>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <h5 class="font-base mb-2">Interior Details</h5>
                                        <ul class="list-group list-group-borderless">
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->kitchen ? 'check text-success' : 'times text-danger' }}"></i>
                                                Kitchen:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->laundry ? 'check text-success' : 'times text-danger' }}"></i>
                                                Laundry:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->gym ? 'check text-success' : 'times text-danger' }}"></i>
                                                Gym:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->projector_room ? 'check text-success' : 'times text-danger' }}"></i>
                                                Projector Room:
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-4 mt-sm-0">
                                        <h5 class="font-base mb-2">Outdoor Details</h5>
                                        <ul class="list-group list-group-borderless">
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->back_yard ? 'check text-success' : 'times text-danger' }}"></i>
                                                Back yard:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->front_yard ? 'check text-success' : 'times text-danger' }}"></i>
                                                Front yard:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->attached_garage ? 'check text-success' : 'times text-danger' }}"></i>
                                                Attached garage:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->pool ? 'check text-success' : 'times text-danger' }}"></i>
                                                Pool:
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-4 mt-md-0">
                                        <h5 class="font-base mb-2">Other Features</h5>
                                        <ul class="list-group list-group-borderless">
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->elevator ? 'check text-success' : 'times text-danger' }}"></i>
                                                Elevator:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->wifi ? 'check text-success' : 'times text-danger' }}"></i>
                                                Wifi:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->school
                                                        ? 'check text-success'
                                                        : 'times text-danger' }}"></i>
                                                School:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->transportation_hub ? 'check text-success' : 'times text-danger' }}"></i>
                                                Transportation hub:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->super_market ? 'check text-success' : 'times text-danger' }}"></i>
                                                Supermarket:
                                            </li>
                                            <li class="list-group-item text-body">
                                                <i
                                                    class="fas fa-fw fa-{{ $listing->amenities->clinic ? 'check text-success' : 'times text-danger' }}"></i>
                                                Clinic:
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                       
                    </div>

                    <div class="col-lg-4 pt-5 pt-lg-0">
                        <div data-sticky="" data-margin-top="80" data-sticky-for="991">
                            <div class="row mb-5 mb-lg-0">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="bg-white p-4 mb-4 shadow-lg rounded">
                                        <h3 class="mb-4">Reserve This Property Now</h3>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <span class="text-dark">Monthly Amortization</span>
                                                <h4 class="text-success">₱{{ number_format($listing->price, 2) }}</h4>
                                            </div>
                                            <div>
                                                <span class="text-dark">Reservation Amount</span>

                                                <h5 class="text-success text-end">
                                                    ₱{{ number_format($listing->reservation_amount, 2) }}</h5>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item px-0 d-flex justify-content-between text-body">
                                                    Total:<span
                                                        class="text-dark">₱{{ number_format($listing->price + $listing->reservation_amount, 2) }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="{{ route('book.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                                    <div class="mb-3">
                                                        <label for="visitDate" class="form-label">Schedule a Visit Date
                                                            *</label>
                                                        <input type="date" class="form-control" name="viewing_date"
                                                            id="visitDate" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="visitTime" class="form-label">Schedule a Visit Time
                                                            *</label>
                                                        <input type="time" class="form-control" name="viewing_time"
                                                            id="visitTime" required>
                                                    </div>
                                                    <div class="d-grid gap-2 mt-2">
                                                        <button type="submit" class="btn btn-primary" id="reserveButton" onclick="handleReserveClick(this.form)">Reserve
                                                            Now</button>
                                                    </div>
                                                    
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

<script>
    function handleReserveClick(form) {
        form.submit(); // Submit the form
        var button = document.getElementById('reserveButton');
        button.disabled = true; // Disable the button
        setTimeout(function() {
            button.disabled = false; // Re-enable the button after 15 seconds
        }, 15000); // 15000 milliseconds = 15 seconds
    }
</script>
<script src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/vendor/sticky-js/sticky.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script>
<script src="{{ asset('assets/vendor/splide-master/dist/js/splide.min.js') }}"></script>
