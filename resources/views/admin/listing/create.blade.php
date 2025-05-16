@extends('layouts.app')

@section('content')
    <div class="main-content py-5">
        <div class="container">
            <!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="errorModalLabel"><i class="fas fa-exclamation-triangle me-2"></i>Error</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Please correct the following errors:</p>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    @if ($errors->any())
      var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
      errorModal.show();
    @endif
  });
</script>

            <!-- Header Section with Progress Indicator -->
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-primary">Find Your Perfect Tenant</h1>
                <p class="lead text-muted">Create your property listing in just a few simple steps</p>

                <!-- Progress Bar -->
                <div class="progress mt-4" style="height: 10px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;"
                        id="progress-bar"></div>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <span class="small" id="step1-indicator"><i class="fas fa-circle text-primary"></i> Basic Info</span>
                    <span class="small" id="step2-indicator"><i class="far fa-circle"></i> Details</span>
                    <span class="small" id="step3-indicator"><i class="far fa-circle"></i> Amenities</span>
                    <span class="small" id="step4-indicator"><i class="far fa-circle"></i> Photos</span>
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> Please correct the following errors:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form Card -->
            <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body p-0">
                    <form action="{{ route('admin.listing.store') }}" method="POST" enctype="multipart/form-data"
                        id="listingForm">
                        @csrf

                        <!-- Step 1: Basic Information -->
                        <div class="form-step active" id="step1">
                            <div class="p-4 p-md-5 bg-white">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-primary text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-home fa-lg"></i>
                                    </div>
                                    <h3 class="mb-0">Basic Information</h3>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="title" class="form-label fw-bold">
                                            <i class="fas fa-heading me-2 text-primary"></i>Title
                                        </label>
                                        <input type="text" name="title" id="title"
                                            class="form-control form-control-lg"
                                            placeholder="e.g. Spacious 2-Bedroom Apartment near City Center" required>
                                        <div class="form-text">Create a catchy title to attract potential tenants</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="body" class="form-label fw-bold">
                                            <i class="fas fa-align-left me-2 text-primary"></i>Description
                                        </label>
                                        <textarea name="body" id="body" class="form-control" rows="4"
                                            placeholder="Describe your property's features, neighborhood, and what makes it special..." required></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="city" class="form-label fw-bold">
                                            <i class="fas fa-city me-2 text-primary"></i>City
                                        </label>
                                        <input type="text" name="city" id="city" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="baranggay" class="form-label fw-bold">
                                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Barangay
                                        </label>
                                        <input type="text" name="baranggay" id="baranggay" class="form-control" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="address" class="form-label fw-bold">
                                            <i class="fas fa-map me-2 text-primary"></i>Complete Address
                                        </label>
                                        <textarea name="address" id="address" class="form-control"
                                            placeholder="Full address including street number, building name, etc." required></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary btn-lg next-btn">
                                        Continue <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Listing Details -->
                        <div class="form-step" id="step2">
                            <div class="p-4 p-md-5 bg-white">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-primary text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-clipboard-list fa-lg"></i>
                                    </div>
                                    <h3 class="mb-0">Listing Details</h3>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="type" class="form-label fw-bold">
                                            <i class="fas fa-building me-2 text-primary"></i>Property Type
                                        </label>
                                        <select name="type" id="type" class="form-select form-select-lg"
                                            required>
                                            <option value="" selected disabled>Select property type</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="House">House</option>
                                            <option value="Boarding house">Boarding House</option>
                                            <option value="Room">Room</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="advance_payment_months" class="form-label fw-bold">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Advance Payment
                                        </label>
                                        <select name="advance_payment_months" id="advance_payment_months"
                                            class="form-select form-select-lg" required>
                                            <option value="0">No advance payment</option>
                                            <option value="2">2 months</option>
                                            <option value="3">3 months</option>
                                            <option value="4">4 months</option>
                                            <option value="5">5 months</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="availability" class="form-label fw-bold">
                                            <i class="fas fa-door-open me-2 text-primary"></i>Availability
                                        </label>
                                        <div class="form-control p-0 overflow-hidden">
                                            <div class="btn-group w-100" role="group">
                                                <input type="radio" class="btn-check" name="availability"
                                                    id="available" value="open" checked required>
                                                <label class="btn btn-outline-success py-2" for="available">Available
                                                    Now</label>

                                                <input type="radio" class="btn-check" name="availability"
                                                    id="unavailable" value="closed">
                                                <label class="btn btn-outline-danger py-2" for="unavailable">Not
                                                    Available</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="reservation" class="form-label fw-bold">
                                            <i class="fas fa-calendar-check me-2 text-primary"></i>Reservation
                                        </label>
                                        <div class="form-control p-0 overflow-hidden">
                                            <div class="btn-group w-100" role="group">
                                                <input type="radio" class="btn-check" name="reservation"
                                                    id="reservable" value="open" checked required>
                                                <label class="btn btn-outline-success py-2" for="reservable">Accepting
                                                    Reservations</label>

                                                <input type="radio" class="btn-check" name="reservation"
                                                    id="not-reservable" value="closed">
                                                <label class="btn btn-outline-danger py-2" for="not-reservable">No
                                                    Reservations</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="price" class="form-label fw-bold">
                                            <i class="fas fa-tags me-2 text-primary"></i>Monthly Price
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">₱</span>
                                            <input type="number" name="price" id="price" class="form-control"
                                                step="0.01" placeholder="0.00" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="reservation_amount" class="form-label fw-bold">
                                            <i class="fas fa-money-bill-wave me-2 text-primary"></i>Reservation Fee
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">₱</span>
                                            <input type="number" name="reservation_amount" id="reservation_amount"
                                                class="form-control" step="0.01" placeholder="0.00" required>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <label for="maps" class="form-label fw-bold">
                                            <i class="fas fa-map-marked-alt me-2 text-primary"></i>Google Maps Link
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-google"></i></span>
                                            <input type="text" name="maps" id="maps" class="form-control"
                                                placeholder="https://maps.google.com/..." required>
                                        </div>
                                        <div class="form-text">Paste the Google Maps link to your property</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="waiver_file" class="form-label fw-bold">
                                            <i class="fas fa-file-contract me-2 text-primary"></i>Waiver File
                                        </label>
                                        <input type="file" name="waiver_file" id="waiver" class="form-control"
                                            accept=".pdf,.doc,.docx" required>
                                        <div class="form-text">Upload waiver document (PDF or Word)</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="owner_id" class="form-label fw-bold">
                                            <i class="fas fa-user me-2 text-primary"></i>Select Owner
                                        </label>
                                        <select name="owner_id" id="owner_id" class="form-select form-select-lg"
                                            required>
                                            <option value="" selected disabled>Select an owner</option>
                                            @foreach ($owners as $owner)
                                                <option value="{{ $owner->id }}">{{ $owner->fname }} {{ $owner->lname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary btn-lg prev-btn">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg next-btn">
                                        Continue <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Amenities -->
                        <div class="form-step" id="step3">
                            <div class="p-4 p-md-5 bg-white">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-primary text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-star fa-lg"></i>
                                    </div>
                                    <h3 class="mb-0">Amenities</h3>
                                </div>

                                <p class="text-muted">Select all the amenities that your property offers:</p>

                                <div class="row g-3">
                                    @foreach ($amenities as $amenity)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card h-100 amenity-card">
                                                <div class="card-body p-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="{{ $amenity }}"
                                                            id="{{ $amenity }}" class="form-check-input">
                                                        <label for="{{ $amenity }}" class="form-check-label fw-bold">
                                                            @php
                                                                $icon = match ($amenity) {
                                                                    'wifi' => 'fa-wifi',
                                                                    'air_conditioning' => 'fa-wind',
                                                                    'laundry' => 'fa-tshirt',
                                                                    'refrigerator' => 'fa-snowflake',
                                                                    'kitchen' => 'fa-utensils',
                                                                    'parking' => 'fa-parking',
                                                                    'tv' => 'fa-tv',
                                                                    'microwave' => 'fa-radiation',
                                                                    'security_cameras' => 'fa-video',
                                                                    'pets_allowed' => 'fa-paw',
                                                                    'swimming_pool' => 'fa-swimming-pool',
                                                                    'gym' => 'fa-dumbbell',
                                                                    default => 'fa-check-circle',
                                                                };
                                                            @endphp
                                                            <i class="fas {{ $icon }} me-2 text-primary"></i>
                                                            {{ ucwords(str_replace('_', ' ', $amenity)) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary btn-lg prev-btn">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg next-btn">
                                        Continue <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Photos -->
                        <div class="form-step" id="step4">
                            <div class="p-4 p-md-5 bg-white">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-primary text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-camera fa-lg"></i>
                                    </div>
                                    <h3 class="mb-0">Upload Photos</h3>
                                </div>

                                <p class="text-muted mb-4">High-quality photos help your listing stand out! We recommend
                                    uploading at least 5 photos.</p>

                                <div class="card bg-light">
                                    <div class="card-body text-center p-5">
                                        <div class="upload-area" id="upload-area">
                                            <i class="fas fa-cloud-upload-alt fa-4x text-primary mb-3"></i>
                                            <h5>Drag photos here or click to browse</h5>
                                            <p class="text-muted small">Supported formats: JPG, PNG, WEBP (Max 10MB each)
                                            </p>
                                            <input type="file" name="photos[]" id="photos"
                                                class="form-control d-none" multiple required accept="image/*">
                                            <button type="button" id="browse-btn"
                                                class="btn btn-outline-primary px-4 py-2 mt-2">
                                                <i class="fas fa-folder-open me-2"></i>Browse Files
                                            </button>
                                        </div>

                                        <div id="preview-container" class="row g-3 mt-3" style="display: none;">
                                            <!-- Preview images will appear here -->
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary btn-lg prev-btn">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </button>
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-check-circle me-2"></i> Create Listing
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Helpful Tips Section -->
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body">
                    <h5><i class="fas fa-lightbulb text-warning me-2"></i> Tips for a Great Listing</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex align-items-start mt-3">
                                <span class="badge bg-primary rounded-circle p-2 me-2 align-self-start">1</span>
                                <div>
                                    <h6 class="mb-1">Be Descriptive</h6>
                                    <p class="text-muted small mb-0">Include all important details about your property</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-start mt-3">
                                <span class="badge bg-primary rounded-circle p-2 me-2 align-self-start">2</span>
                                <div>
                                    <h6 class="mb-1">Quality Photos</h6>
                                    <p class="text-muted small mb-0">Clear, well-lit photos attract more interest</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-start mt-3">
                                <span class="badge bg-primary rounded-circle p-2 me-2 align-self-start">3</span>
                                <div>
                                    <h6 class="mb-1">Be Honest</h6>
                                    <p class="text-muted small mb-0">Accurate information leads to better tenants</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        .amenity-card {
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }

        .amenity-card:hover {
            border-color: #0d6efd;
            box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.15);
        }

        .amenity-card .form-check-input:checked~.form-check-label {
            color: #0d6efd;
        }

        #upload-area {
            border: 2px dashed #0d6efd;
            border-radius: 10px;
            padding: 2rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        #upload-area:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .upload-highlight {
            background-color: rgba(13, 110, 253, 0.1);
        }

        /* Loading overlay styles */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #0d6efd;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .loading-text {
            margin-top: 1rem;
            color: #0d6efd;
            font-weight: bold;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Creating your listing...</div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.form-step');
            const progressBar = document.getElementById('progress-bar');
            const indicators = [
                document.getElementById('step1-indicator'),
                document.getElementById('step2-indicator'),
                document.getElementById('step3-indicator'),
                document.getElementById('step4-indicator')
            ];
            let currentStep = 0;

            // Next button functionality
            document.querySelectorAll('.next-btn').forEach(button => {
                button.addEventListener('click', () => {
                    steps[currentStep].classList.remove('active');
                    currentStep++;
                    steps[currentStep].classList.add('active');
                    updateProgress();
                });
            });

            // Previous button functionality
            document.querySelectorAll('.prev-btn').forEach(button => {
                button.addEventListener('click', () => {
                    steps[currentStep].classList.remove('active');
                    currentStep--;
                    steps[currentStep].classList.add('active');
                    updateProgress();
                });
            });

            // Update progress bar and indicators
            function updateProgress() {
                const progress = ((currentStep + 1) / steps.length) * 100;
                progressBar.style.width = `${progress}%`;

                indicators.forEach((indicator, index) => {
                    const icon = indicator.querySelector('i');
                    if (index <= currentStep) {
                        icon.className = 'fas fa-circle text-primary';
                    } else {
                        icon.className = 'far fa-circle';
                    }
                });
            }

            // Initialize first step
            steps[0].classList.add('active');
            updateProgress();

            // File upload handling
            const uploadArea = document.getElementById('upload-area');
            const photosInput = document.getElementById('photos');
            const browseBtn = document.getElementById('browse-btn');
            const previewContainer = document.getElementById('preview-container');

            browseBtn.addEventListener('click', () => {
                photosInput.click();
            });

            uploadArea.addEventListener('click', () => {
                photosInput.click();
            });

            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('upload-highlight');
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('upload-highlight');
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('upload-highlight');

                if (e.dataTransfer.files.length) {
                    photosInput.files = e.dataTransfer.files;
                    displayPreviews(e.dataTransfer.files);
                }
            });

            photosInput.addEventListener('change', () => {
                displayPreviews(photosInput.files);
            });

            let selectedFiles = [];

            function displayPreviews(files) {
                if (files.length === 0) return;

                // Add new files to existing selection
                selectedFiles = [...selectedFiles, ...Array.from(files)];

                // Update the files in the input
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                photosInput.files = dataTransfer.files;

                // Display previews
                previewContainer.innerHTML = '';
                previewContainer.style.display = 'flex';

                selectedFiles.forEach((file, index) => {
                    if (!file.type.startsWith('image/')) return;

                    const col = document.createElement('div');
                    col.className = 'col-md-3 col-sm-4 col-6';

                    const card = document.createElement('div');
                    card.className = 'card h-100';

                    const img = document.createElement('img');
                    img.className = 'card-img-top';
                    img.style.height = '120px';
                    img.style.objectFit = 'cover';

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        img.src = e.target.result;
                    };
                    reader.readAsDataURL(file);

                    const cardBody = document.createElement('div');
                    cardBody.className = 'card-body p-2';

                    const fileName = document.createElement('p');
                    fileName.className = 'card-text small text-truncate mb-0';
                    fileName.textContent = file.name;

                    // Add remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0 m-1';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.onclick = (e) => {
                        e.preventDefault();
                        selectedFiles.splice(index, 1);
                        displayPreviews([]);
                    };

                    cardBody.appendChild(fileName);
                    card.appendChild(img);
                    card.appendChild(cardBody);
                    card.appendChild(removeBtn);
                    col.appendChild(card);
                    previewContainer.appendChild(col);
                });
            }

            // Handle form submission
            const form = document.getElementById('listingForm');
            const loadingOverlay = document.getElementById('loadingOverlay');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function(e) {
                // Show loading overlay
                loadingOverlay.style.display = 'flex';
                // Disable submit button
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
            });
        });
    </script>
@endsection
