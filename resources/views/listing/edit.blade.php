@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container">
            <h1 class="text-center" style="margin-bottom: 20px; font-size: 2.5rem; color: #343a40;">Edit Listing</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('listing.update', $listing->id) }}" method="POST" enctype="multipart/form-data" id="listingForm">
                @csrf
                @method('PUT')

                <!-- Step 1: Basic Information -->
                <div class="form-step" id="step1" style="background-color: #f8f9fa; border: 2px solid; padding: 20px; border-radius: 15px;">
                    <div class="row gx-5 align-items-center justify-content-center text-start">
                        <h4 class="text-start">Step 1: Basic Information</h4>
                        
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $listing->title }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" id="body" class="form-control" required>{{ $listing->body }}</textarea>
                        </div>
                        
                        <h4 class="text-start mt-3">Property Information</h4>
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ $listing->city }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="baranggay">Barangay</label>
                                <input type="text" name="baranggay" id="baranggay" class="form-control" value="{{ $listing->baranggay }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Complete Address</label>
                            <textarea name="address" id="address" class="form-control" required>{{ $listing->address }}</textarea>
                        </div>
                    </div>
                    
                    <br>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>

                <!-- Step 2: Listing Details -->
                <div class="form-step" id="step2" style="display: none; background-color: #f8f9fa; border: 2px solid ; padding: 20px; border-radius: 15px;">
                    <h4 class="text-start">Step 2: Listing Details</h4>
                    
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="Apartment" {{ $listing->type == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="House" {{ $listing->type == 'House' ? 'selected' : '' }}>House</option>
                            <option value="Boarding house" {{ $listing->type == 'Boarding house' ? 'selected' : '' }}>Boarding house</option>
                            <option value="Room" {{ $listing->type == 'Room' ? 'selected' : '' }}>Room</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="availability">Availability</label>
                            <select name="availability" id="availability" class="form-control" required>
                                <option value="open" {{ $listing->availability == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="closed" {{ $listing->availability == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="reservation">Reservation</label>
                            <select name="reservation" id="reservation" class="form-control" required>
                                <option value="open" {{ $listing->reservation == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="closed" {{ $listing->reservation == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-9">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ $listing->price }}" step="0.01" required>
                        </div>
                        <div class="col-md-3">
                            <label for="reservation_amount">Reservation Amount</label>
                            <input type="number" name="reservation_amount" id="reservation_amount" class="form-control" value="{{ $listing->reservation_amount }}" step="0.01" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="maps">Map Link</label>
                            <input type="text" name="maps" id="maps" class="form-control" value="{{ $listing->map_link }}" >
                        </div>
                        <div class="col-md-4">
                            <label for="waiver">Waiver File</label>
                            <input type="file" name="waiver" id="waiver" class="form-control">
                        </div>
                    </div>
                    
                    <br>
                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>

                <!-- Step 3: Amenities -->
                <div class="form-step" id="step3" style="display: none; background-color: #f8f9fa; border: 2px solid ; padding: 20px; border-radius: 15px;">
                    <h4 class="text-start">Step 3: Amenities</h4>

                    <div class="form-check">
                        <input type="checkbox" name="wifi" id="wifi" class="form-check-input" {{ $listing->amenities->wifi ? 'checked' : '' }}>
                        <label for="wifi" class="form-check-label">WiFi</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="parking" id="parking" class="form-check-input" {{ $listing->amenities->parking ? 'checked' : '' }}>
                        <label for="parking" class="form-check-label">Parking</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="bathroom" id="bathroom" class="form-check-input" {{ $listing->amenities->bathroom ? 'checked' : '' }}>
                        <label for="bathroom" class="form-check-label">Bathroom</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="kitchen" id="kitchen" class="form-check-input" {{ $listing->amenities->kitchen ? 'checked' : '' }}>
                        <label for="kitchen" class="form-check-label">Kitchen</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="laundry" id="laundry" class="form-check-input" {{ $listing->amenities->laundry ? 'checked' : '' }}>
                        <label for="laundry" class="form-check-label">Laundry</label>
                    </div>
                    <br>
                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>

                <!-- Step 4: Photos -->
               <!-- Step 4: Photos -->
<div class="form-step" id="step4" style="display: none; background-color: #f8f9fa; border: 2px solid; padding: 20px; border-radius: 15px;">
    <h4 class="text-start">Step 4: Upload Photos</h4>
    <div class="form-group">
        <label for="photos" style="display: flex; align-items: center;">
            <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px; margin-right: 8px;">
                <path d="M3 17v2a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-2" />
                <path d="M12 3v12" />
                <path d="M9 6l3-3 3 3" />
            </svg>
            Upload Photos
        </label>
        <input type="file" name="photos[]" id="photos" class="form-control" multiple>
    </div>

    <h5>Existing Photos</h5>
    <div class="existing-photos">
        @foreach ($listing->photos as $photo)
            <div class="photo-item">
                <img src="{{ asset('storage/' . $photo->photo_url) }}" alt="Photo" style="width: 100px; height: auto;">
                <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}">
                <label>Delete</label>
            </div>
        @endforeach
    </div>
    <br>
    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
    <button type="submit" class="btn btn-success">Submit</button>
</div>
            </form>
        </div>
    </div>
    <script>
        const steps = document.querySelectorAll('.form-step');
        let currentStep = 0;

        document.querySelectorAll('.next-btn').forEach(button => {
            button.addEventListener('click', () => {
                steps[currentStep].style.display = 'none';
                currentStep++;
                steps[currentStep].style.display = 'block';
            });
        });

        document.querySelectorAll('.prev-btn').forEach(button => {
            button.addEventListener('click', () => {
                steps[currentStep].style.display = 'none';
                currentStep--;
                steps[currentStep].style.display = 'block';
            });
        });
    </script>
@endsection