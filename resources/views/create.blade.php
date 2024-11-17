@extends('layouts.app')

@section('content')
<!-- Main content START -->
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <!-- Page title -->
            <div class="my-5">
                <h3>Add Property Listing</h3>
                <hr>
            </div>
            <form id="stepByStepForm" class="file-upload" method="POST" action="{{ route('listing.store') }}" enctype="multipart/form-data">
                @csrf
                <ul class="progress-step">
                    <li class="progress-bar__dot full box-md position-relative me-4 me-lg-0">
                        <span class="mb-0 position-absolute top-50 start-50 translate-middle fs-6"><i class="far fa-edit"></i></span>
                    </li>
                    <li class="progress-bar__connector align-items-center d-none d-lg-block">
                        <span class="fs-5 mb-0 ms-2 text-dark">Description</span>
                    </li>
                    
                    <li class="progress-bar__dot box-md position-relative me-4 me-lg-0">
                        <span class="mb-0 position-absolute top-50 start-50 translate-middle fs65"><i class="fas fa-photo-video"></i></span>
                    </li>
                    <li class="progress-bar__connector align-items-center d-none d-lg-block">
                        <span class="fs-5 mb-0 ms-2 text-dark">Media</span>
                    </li>

                    <li class="progress-bar__dot box-md position-relative me-4 me-lg-0">
                        <span class="mb-0 position-absolute top-50 start-50 translate-middle fs65"><i class="fas fa-map-marker-alt"></i></span>
                    </li>
                    <li class="progress-bar__connector align-items-center d-none d-lg-block">
                        <span class="fs-5 mb-0 ms-2 text-dark">Location</span>
                    </li>

                    <li class="progress-bar__dot box-md position-relative">
                        <span class="mb-0 position-absolute top-50 start-50 translate-middle fs65"><i class="fas fa-bars"></i></span>
                    </li>
                    <li class="progress-bar__connector align-items-center d-none d-lg-block">
                        <span class="fs-5 mb-0 ms-2 text-dark">Amenities</span>
                    </li>
                </ul>
                
                <!-- Description step -->
                <div class="step step1">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-xxl-10 mb-5 mb-xxl-0">
                            <div class="row g-3 bg-secondary-soft rounded p-3 p-md-5">
                                <h4 class="my-0">Property Details</h4>
                                <div class="col-md-12">
                                    <label class="form-label">Title *</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="body" class="form-label">Description *</label>
                                    <textarea name="body" class="form-control" id="body" rows="4" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Price *</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address *</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Barangay *</label>
                                    <input type="text" name="baranggay" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City *</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Type *</label>
                                    <select name="type" class="form-select" required>
                                        <option value="">Select item</option>
                                        <option value="Apartment">Apartment</option>
                                        <option value="House ">House</option>
                                        <option value="Boarding house">Boarding house</option>
                                        <option value="Room">Room</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Availability *</label>
                                    <select name="availability" class="form-select" required>
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reservation Status *</label>
                                    <select name="reservation" class="form-select" required>
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reservation Amount *</label>
                                    <input type="number" name="reservation_amount" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media step -->
                <div class="step step2 hidden">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-xxl-10 mb-5 mb-xxl-0">
                            <div class="row g-3 bg-secondary-soft rounded p-3 p-md-5">
                                <h4 class="my-0">Upload Photos</h4>
                                <div class="col-md-12">
                                    <label class="form-label">Photos *</label>
                                    <input type="file" name="photos[]" class="form-control" multiple accept="image/*" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location step -->
                <div class="step step3 hidden">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-xxl-10 mb-5 mb-xxl-0">
                            <div class="row g-3 bg-secondary-soft rounded p-3 p-md-5">
                                <h4 class="my-0">Location Details</h4>
                                <div class="col-md-12">
                                    <label class="form-label">Address *</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Barangay *</label>
                                    <input type="text" name="baranggay" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City *</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities step -->
                <div class="step step4 hidden">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-xxl-10 mb-5 mb-xxl-0">
                            <div class="row g-3 bg-secondary-soft rounded p-3 p-md-5">
                                <h4 class="my-0">Amenities</h4>
                                <div class="col-md-6">
                                    <label class="form-label">WiFi</label>
                                    <input type="checkbox" name="wifi" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kitchen</label>
                                    <input type="checkbox" name="kitchen" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Laundry</label>
                                    <input type="checkbox" name="laundry" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gym</label>
                                    <input type="checkbox" name="gym" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Projector Room</label>
                                    <input type="checkbox" name="projector_room" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Back Yard</label>
                                    <input type="checkbox" name="back_yard" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-label">Front Yard</label>
                                    <input type="checkbox" name="front_yard" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Attached Garage</label>
                                    <input type="checkbox" name="attached_garage" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Pool</label>
                                    <input type="checkbox" name="pool" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Elevator</label>
                                    <input type="checkbox" name="elevator" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">School Nearby</label>
                                    <input type="checkbox" name="school" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Transportation Hub</label>
                                    <input type="checkbox" name="transportation_hub" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Super Market Nearby</label>
                                    <input type="checkbox" name="super_market" class="form-check-input">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Clinic Nearby</label>
                                    <input type="checkbox" name="clinic" class="form-check-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" id="previous" class="btn btn-secondary disabled">Previous</button>
                    <button type="button" id="next" class="btn btn-primary">Next</button>
                    <button type="submit" id="validate" class="btn btn-success hidden">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Main content END -->
@endsection