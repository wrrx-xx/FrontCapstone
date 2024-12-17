@extends('layouts.app')

@section('content')

<div class="container mx-auto p-4">
    
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-600">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('listing.store') }}" method="POST" enctype="multipart/form-data" id="listingForm" class="space-y-4">
        @csrf

        <!-- Step 1: Basic Information -->
        <div class="form-step p-4 border border-gray-300 rounded-lg bg-gray-50">
          
            <h4 class="text-lg font-semibold">Step 1: Basic Information</h4>
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-lg" required>
            </div>
            
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="body" id="body" class="mt-1 block w-full border-gray-300 rounded-lg" required></textarea>
            </div>
            
            <h4 class="text-lg font-semibold mt-3">Property Information</h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" name="city" id="city" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="baranggay" class="block text-sm font-medium text-gray-700">Barangay</label>
                    <input type="text" name="baranggay" id="baranggay" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Complete Address</label>
                <textarea name="address" id="address" class="mt-1 block w-full border-gray-300 rounded-lg" required></textarea>
            </div>
            
            <button type="button" class="btn btn-primary next-btn">Next</button>
        </div>

        <!-- Step 2: Listing Details -->
        <div class="form-step hidden p-4 border border-gray-300 rounded-lg bg-gray-50">
            <h4 class="text-lg font-semibold">Step 2: Listing Details</h4>
            
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                    <option value="Apartment">Apartment</option>
                    <option value="House">House</option>
                    <option value="Boarding house">Boarding house</option>
                    <option value="Room">Room</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                    <select name="availability" id="availability" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div>
                    <label for="reservation" class="block text-sm font-medium text-gray-700">Reservation</label>
                    <select name="reservation" id="reservation" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md -grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-lg" step="0.01" required>
                </div>
                <div>
                    <label for="reservation_amount" class="block text-sm font-medium text-gray-700">Reservation Amount</label>
                    <input type="number" name="reservation_amount" id="reservation_amount" class="mt-1 block w-full border-gray-300 rounded-lg" step="0.01" required>
                </div>
            </div>
            
            <button type="button" class="btn btn-secondary prev-btn">Previous</button>
            <button type="button" class="btn btn-primary next-btn">Next</button>
        </div>

        <!-- Step 3: Amenities -->
        <div class="form-step hidden p-4 border border-gray-300 rounded-lg bg-gray-50">
            <h4 class="text-lg font-semibold">Step 3: Amenities</h4>

            <div class="flex items-center mb-2">
                <input type="checkbox" name="wifi" id="wifi" class="form-checkbox h-5 w-5 text-blue-600">
                <label for="wifi" class="ml-2 text-sm text-gray-700">WiFi</label>
            </div>

            <div class="flex items-center mb-2">
                <input type="checkbox" name="parking" id="parking" class="form-checkbox h-5 w-5 text-blue-600">
                <label for="parking" class="ml-2 text-sm text-gray-700">Parking</label>
            </div>

            <div class="flex items-center mb-2">
                <input type="checkbox" name="bathroom" id="bathroom" class="form-checkbox h-5 w-5 text-blue-600">
                <label for="bathroom" class="ml-2 text-sm text-gray-700">Bathroom</label>
            </div>

            <div class="flex items-center mb-2">
                <input type="checkbox" name="kitchen" id="kitchen" class="form-checkbox h-5 w-5 text-blue-600">
                <label for="kitchen" class="ml-2 text-sm text-gray-700">Kitchen</label>
            </div>

            <div class="flex items-center mb-2">
                <input type="checkbox" name="laundry" id="laundry" class="form-checkbox h-5 w-5 text-blue-600">
                <label for="laundry" class="ml-2 text-sm text-gray-700">Laundry</label>
            </div>
            
            <button type="button" class="btn btn-secondary prev-btn">Previous</button>
            <button type="button" class="btn btn-primary next-btn">Next</button>
        </div>

        <!-- Step 4: Photos -->
        <div class="form-step hidden p-4 border border-gray-300 rounded-lg bg-gray-50">
            <h4 class="text-lg font-semibold">Step 4: Upload Photos</h4>
            <div class="mb-4">
                <label for="photos" class="block text-sm font-medium text-gray-700">
                    <svg class="inline-block w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17v2a2 2 0 002 2h14a2 2 0 002-2v-2M12 3v12m-3-3l3-3 3 3" />
                    </svg>
                    Upload Photos
                </label>
                <input type="file" name="photos[]" id="photos" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" multiple required>
                <div class="mt-1 text-sm text-gray-500" id="user_avatar_help">You can upload multiple photos.</div>
            </div>
            <button type="button" class="btn btn-secondary prev-btn">Previous</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
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