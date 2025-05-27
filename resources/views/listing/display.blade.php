@extends('layouts.app')
@section('content')
    <!-- =======================
                Main Banner START -->
    <section class="position-relative z-index-9"
        style="
        background: url('/assets/images/bg/bg.jpg') no-repeat center center;
        background-size: cover;
        background-attachment: fixed;
      ">
        <div class="container">
           
            <!-- Form START -->
            <form class="row" method="GET" action="{{ route('listing.display') }}">
                <div class="col-md-12 my-4">
                    <div class="card shadow p-4 rounded-3 bg-light">
                        <div class="row g-3 align-items-center">
                            <div class="col-lg-4">
                                <input type="text" class="form-control form-control-lg" name="keyword" placeholder="Enter keyword" value="{{ request('keyword') }}" />
                            </div>
                            <div class="col-lg-4">
                                <select name="category" class="form-select form-select-lg js-choice" aria-label="Category">
                                    <option value="" selected>Categories</option>
                                    <option value="Apartment" {{ (is_string(request('category')) && request('category') === 'Apartment') ? 'selected' : '' }}>Apartment</option>
                                    <option value="Boarding house" {{ (is_string(request('category')) && request('category') === 'Boarding house') ? 'selected' : '' }}>Boarding House</option>
                                    <option value="House" {{ (is_string(request('category')) && request('category') === 'House') ? 'selected' : '' }}>House</option>
                                    <option value="Room" {{ (is_string(request('category')) && request('category') === 'Room') ? 'selected' : '' }}>Room</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-sliders-h me-2"></i>Advanced
                                </button>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </div>

                        <div class="collapse mt-4" id="collapseExample">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <select name="city" class="form-select form-select-sm js-choice" aria-label="City">
                                        <option value="">City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="baranggay" class="form-select form-select-sm js-choice" aria-label="Barangay">
                                        <option value="">Barangay</option>
                                        @foreach ($baranggays as $baranggay)
                                            <option value="{{ $baranggay }}" {{ request('baranggay') == $baranggay ? 'selected' : '' }}>{{ $baranggay }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="min_price" class="form-control form-control-sm" placeholder="Min Price" value="{{ request('min_price') }}" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="max_price" class="form-control form-control-sm" placeholder="Max Price" value="{{ request('max_price') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Form END -->
        </div>
    </section>
    <!-- =======================
                Main Banner END -->

    <!-- =======================
                Inner part START -->
    <section class="pt-5">
        <div class="container">
            <!-- Title -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <!-- Title START -->
                    <div class="d-md-flex justify-content-md-between align-items-center">
                        <!-- Title -->
                        <h3 class="mb-0">Properties in Dumaguete City</h3>
                        <!-- Button -->
                        <div class="text-primary-hover text-end d-none d-md-block">
                            <ul class="list-inline">
                                <!-- Grid icon -->
                                <li class="list-inline-item">
                                    <a href="#" class="border rounded-1 p-2 me-2"><i
                                            class="fas fa-fw fa-th-large"></i></a>
                                </li>
                                <!-- list icon -->
                                <li class="list-inline-item">
                                    <a href="#" class="border rounded-1 p-2 me-2"><i
                                            class="fas fa-fw fa-list-ul"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Title END -->
                </div>
            </div>

            <div class="row">
                <!-- Left sidebar START -->
                <div class="col-lg-4 pt-5 pt-lg-0 order-2 order-lg-1">
                    <div class="row mb-5 mb-lg-0">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Advance search START -->
                            <div class="bg-white shadow-lg rounded-1 p-4 mb-4">
                                <!-- Title -->
                                <h4 class="mb-4">Advance Search</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Form START -->
                                        <form method="GET" action="{{ route('listing.display') }}">
                                            <!-- Category item -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-home me-2"></i>Category:
                                            </h6>
                                            <ul class="list-inline mb-4 g-3">
                                                <!-- Apartment -->
                                                <li class="list-inline-item mb-2">
                                                    <input type="checkbox" class="btn-check" id="btn-check-2"
                                                        name="category[]" value="Apartment"
                                                        {{ (is_array(request('category')) && in_array('Apartment', request('category'))) ? 'checked' : '' }} />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-2">Apartment</label>
                                                </li>
                                                <!-- Boarding House -->
                                                <li class="list-inline-item mb-2">
                                                <input type="checkbox" class="btn-check" id="btn-check-3"
                                                    name="category[]" value="Boarding House"
                                                    {{ (is_array(request('category')) && in_array('Boarding House', request('category'))) ? 'checked' : '' }} />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-3">Boarding House</label>
                                                </li>
                                                <!-- House -->
                                                <li class="list-inline-item mb-2">
                                                <input type="checkbox" class="btn-check" id="btn-check-4"
                                                    name="category[]" value="House"
                                                    {{ (is_array(request('category')) && in_array('House', request('category'))) ? 'checked' : '' }} />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-4">House</label>
                                                </li>
                                                <!-- Room -->
                                                <li class="list-inline-item mb-2">
                                                <input type="checkbox" class="btn-check" id="btn-check-5"
                                                    name="category[]" value="Room"
                                                    {{ (is_array(request('category')) && in_array('Room', request('category'))) ? 'checked' : '' }} />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-5">Room</label>
                                                </li>
                                            </ul>
                                            <hr class="my-0" />

                                            <!-- Barangay -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-street-view me-2"></i>Barangay:
                                            </h6>
                                            <select class="form-select mb-4 js-choice" name="baranggay">
                                                <option value="">Select</option>
                                                @foreach ($baranggays as $baranggay)
                                                    <option value="{{ $baranggay }}"
                                                        {{ request('baranggay') == $baranggay ? 'selected' : '' }}>
                                                        {{ $baranggay }}</option>
                                                @endforeach
                                            </select>
                                            <hr class="my-0" />

                                            <!-- City -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-city me-2"></i>City:
                                            </h6>
                                            <select class="form-select mb-4 js-choice" name="city">
                                                <option value="">Select</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city }}"
                                                        {{ request('city') == $city ? 'selected' : '' }}>
                                                        {{ $city }}</option>
                                                @endforeach
                                            </select>
                                            <hr class="my-0" />

                                            <!-- More Filter -->
                                            <div class="mt-5">
                                                <a class="btn btn-link btn-more-fliter p-0" data-bs-toggle="collapse"
                                                    href="#collapseExample1" role="button" aria-expanded="false"
                                                    aria-controls="collapseExample1">
                                                    <i class="fas fa-plus me-2"></i>More filter
                                                </a>
                                                <div class="collapse" id="collapseExample1">
                                                    <div class="card card-body p-0 mt-4">
                                                        <!-- Amenities -->
                                                        <h6 class="font-base">
                                                            <i class="fas fa-bars me-2"></i>Amenities
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="wifi" id="wifi" value="1"
                                                                        {{ request('wifi') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="wifi">WiFi</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="parking" id="parking" value="1"
                                                                        {{ request('parking') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="parking">Parking</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="bathroom" id="bathroom" value="1"
                                                                        {{ request('bathroom') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="bathroom">Bathroom</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="kitchen" id="kitchen" value="1"
                                                                        {{ request('kitchen') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="kitchen">Kitchen</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="laundry" id="laundry" value="1"
                                                                        {{ request('laundry') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="laundry">Laundry</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="gym" id="gym" value="1"
                                                                        {{ request('gym') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="gym">Gym</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="pool" id="pool" value="1"
                                                                        {{ request('pool') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="pool">Pool</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="elevator" id="elevator" value="1"
                                                                        {{ request('elevator') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="elevator">Elevator</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="super_market" id="super_market"
                                                                        value="1"
                                                                        {{ request('super_market') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="super_market">Super Market</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="clinic" id="clinic" value="1"
                                                                        {{ request('clinic') == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="clinic">Clinic</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Apply Filter Button -->
                                            <div class="d-grid gap-2 mt-4">
                                                <button type="submit" class="btn btn-primary">Apply filter</button>
                                            </div>
                                        </form>
                                        <!-- Form END -->
                                    </div>
                                </div>
                                <!-- Row END -->
                            </div>
                            <!-- Advance search END -->
                        </div>

                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Latest view START -->
                            <div class="bg-white p-4 mt-4 shadow-lg rounded">
                                <!-- Title -->
                                <h4 class="mb-4">Latest property</h4>
                                <!-- Tiny slider START -->
                                <div class="tiny-slider arrow-round">
                                    <div class="tiny-slider-inner" data-autoplay="false" data-arrow="true"
                                        data-dots="false" data-items="1" data-items-xs="1">
                                        @foreach ($listings as $listing)
                                        <div class="card mb-4">
                                            <div class="position-relative overflow-hidden">
                                                <!-- Card img -->
                                                <img class="card-img" src="{{ asset($listing->photos->first()->photo_url ?? 'assets/images/property/grid-list/05.jpg') }}"
                                                    alt="Listing image" />
                                                <!-- Card img overlay -->
                                                <div class="card-img-overlay bg-dark-overlay-hover">
                                                    <!-- Card category -->
                                                    <div class="w-100 h-100 d-flex flex-column">
                                                        <div class="mb-auto">
                                                            <!-- Meta -->
                                                            <div class="d-flex justify-content-between">
                                                                <a href="#" class="badge bg-orange">{{ $listing->availability }}</a>
                                                              
                                                            </div>
                                                        </div>
                                                        <!-- Title -->
                                                        <h4 class="card-title">
                                                            <a href="{{ route('listings.show', $listing->id) }}" class="stretched-link text-light">{{ $listing->title }}</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Tiny slider END -->
                            </div>
                            <!-- Latest view END -->

                            <!-- Recent view START -->
                            <div class="bg-white p-4 mt-4 shadow-lg rounded">
                                <h4 class="mb-3">Recent viewed</h4>
                                @foreach ($listings as $listing)
                                <div class="card mb-3">
                                    <div class="row g-3">
                                        <!-- Image -->
                                        <div class="col-4">
                                            <img class="rounded" src="{{ asset($listing->photos->first()->photo_url ?? 'assets/images/property/grid-list/11.jpg') }}"
                                                alt="Listing image" />
                                        </div>
                                        <!-- Info -->
                                        <div class="col-8">
                                            <h6>
                                                <a href="{{ route('listings.show', $listing->id) }}" class="stretched-link">{{ $listing->title }}</a>
                                            </h6>
                                            <div class="text-success">₱{{ number_format($listing->price, 2) }}</div>
                                            <ul class="list-inline">
                                                @for ($i = 0; $i < 4; $i++)
                                                    <li class="list-inline-item me-0 small">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                @endfor
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- Recent view END -->
                        </div>
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Left sidebar END -->

                <!-- Main content START -->
                <div class="col-lg-8 order-1">
                    <!-- Navbar START -->
                    <nav id="navbar-example2" class="navbar navbar-dark bg-dark rounded-1">
                        <ul class="nav p-2">
                            <!-- Dropdown items for filters -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="typeDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Type
                                </a>
                                <ul class="dropdown-menu mt-2" aria-labelledby="typeDropdown">
                                    <li><a class="dropdown-item" href="?type=Rent">Rent</a></li>
                                    <li><a class="dropdown-item" href="?type=Sale">Sale</a></li>
                                </ul>
                            </li>
                            <!-- Add more dropdowns for filters as needed -->
                        </ul>
                    </nav>
                    <!-- Navbar END -->

                    <div class="row mt-5">
                        <!-- Loop through listings -->
                        @foreach ($listings as $listing)
                            <div class="col-md-12">
                                <div class="card mb-5 card-img-scale">
                                    <div class="row g-3">
                                        <div class="col-md-5 col-lg-12 col-xl-5">
                                            <div class="card overflow-hidden">
                                                <!-- Image -->
                                                <img class="card-img rounded-1"
                                                    src="{{ asset($listing->photos->first()->photo_url) }}"
                                                    alt="Listing image" />
                                                <!-- Image overlay -->
                                                <div class="card-img-overlay">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a href="#"
                                                            class="badge bg-orange">{{ $listing->availability }}</a>
                                                        <div>
                                                            <a href="#" class="badge bg-dark text-white me-2"><i
                                                                    class="fas fa-video pe-2"></i><span>2</span></a>
                                                            <a href="#" class="badge bg-dark text-white"><i
                                                                    class="fas fa-camera pe-2"></i><span>{{ $listing->photos->count() }}</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Card body START -->
                                        <div class="col-md-7 col-lg-12 col-xl-7">
                                            <div class="row">
                                                <!-- Detail -->
                                                <div class="col-md-7">
                                                    <h4 class="card-title">
                                                        <a
                                                            href="{{ route('listings.show', $listing->id) }}">{{ $listing->title }}</a>
                                                    </h4>
                                                    <p class="small mb-3 mb-md-2 text-primary-hover">
                                                        <a href="#"><i
                                                                class="fas fa-map-marker-alt me-1"></i>{{ $listing->address }},
                                                            {{ $listing->city }}</a>
                                                    </p>
                                                    <ul
                                                        class="nav nav-divider align-items-center text-uppercase small mb-2 mb-lg-3">
                                                        <li class="nav-item me-4 mb-1">
                                                            <i class="fas fa-bed pe-1"></i>
                                                            <span>{{ $listing->bedrooms ?? 'N/A' }}</span>
                                                        </li>
                                                        <li class="nav-item me-4 mb-1">
                                                            <i class="fas fa-bath pe-1"></i>
                                                            <span>{{ $listing->bathrooms ?? 'N/A' }}</span>
                                                        </li>
                                                        <li class="nav-item me-4 mb-1">
                                                            <i class="fas fa-square pe-1"></i>
                                                            <span>{{ $listing->area ?? 'N/A' }}<sup
                                                                    class="text-lowercase">m2</sup></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="d-sm-flex justify-content-sm-between">
                                                        <div class="mb-2 mb-sm-0">
                                                            <span
                                                                class="badge bg-primary-soft text-primary">{{ $listing->type }}</span>
                                                            <span
                                                                class="badge bg-warning-soft text-warning">{{ ucfirst($listing->reservation) }}</span>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex d-md-block align-items-center mb-2 mb-lg-0">
                                                                <h5 class="text-success mb-0 me-3 me-md-0">
                                                                    ₱{{ number_format($listing->price, 2) }}
                                                                </h5>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-2">
                                                            {{-- <img class="avatar-img rounded-circle" src="{{ asset('storage/' . ($listing->owner->profile_photo ?? 'default-avatar.jpg')) }}" alt="Owner avatar" /> --}}
                                                        </div>
                                                        <p class="mb-1">
                                                            {{-- <a href="#" class="text-reset btn-link">{{ $listing->owner->name }}</a> --}}
                                                        </p>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="#" class="text-end me-3 mb-0 h5"><i
                                                                class="fas fa-fw fa-heart text-danger"></i></a>
                                                        {{-- <a href="{{ route('listings.show', $listing->id) }}" class="btn btn-dark btn-sm">View details</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Card body END -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination START -->
                    <div class="col-12">
                        <nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
                            {{ $listings->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    <!-- Pagination END -->
                </div>

                <!-- Main content END -->
            </div>
            <!-- Row END -->
        </div>
      
    </section>
    <!-- =======================
                Inner part END -->
@endsection
