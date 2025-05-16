@extends('layouts.app')

@section('styles')
<style>
    .booking-form-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .booking-form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, #4c6ef5, #36b9cc);
    }

    .form-floating > label {
        opacity: 0.7;
    }

    .booking-header {
        position: relative;
        padding-bottom: 20px;
        margin-bottom: 30px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .booking-header h2 {
        font-weight: 700;
        color: #343a40;
    }

    .booking-header .subtitle {
        color: #6c757d;
        font-size: 1rem;
    }

    .booking-icon {
        background: #e9ecef;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .back-btn {
        transition: all 0.2s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .back-btn:hover {
        background-color: #e9ecef;
        transform: translateX(-3px);
    }

    .card-listing {
        border-left: 4px solid #4c6ef5;
        transition: all 0.2s ease;
    }

    .card-listing:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .card-listing.selected {
        border-color: #28a745;
        background-color: rgba(40, 167, 69, 0.05);
    }

    .card-listing-body {
        padding: 15px;
    }

    .date-time-container {
        display: flex;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .date-time-container {
            flex-direction: column;
            gap: 10px;
        }
    }

    .submit-btn {
        background: linear-gradient(90deg, #4c6ef5, #36b9cc);
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(76, 110, 245, 0.4);
    }

    .submit-btn:active {
        transform: translateY(0);
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="booking-form-container p-4 p-md-5">
                <!-- Back button and Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-circle back-btn" data-bs-toggle="tooltip" title="Go Back">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                
                <div class="booking-header d-flex align-items-center">
                   
                    <div>
                        <h2 class="mb-1">Create Booking</h2>
                        <p class="subtitle mb-0">Schedule a property viewing for your guests</p>
                    </div>
                </div>

                <!-- Alert for errors -->
                @if ($errors->any())
                    <div class="alert alert-danger animate__animated animate__fadeIn" role="alert">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-exclamation-circle fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading mb-1">Please check the form</h5>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    
                    <div class="row g-4">
                        <!-- Guest Selection -->
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3">
                                    <i class="fas fa-user me-2 text-primary"></i>Select Guest
                                </label>
                                <select name="requested_by" id="requested_by" class="form-select form-select-lg shadow-sm" required>
                                    <option value="" disabled selected>Choose a guest for this booking</option>
                                    @foreach($guests as $guest)
                                        <option value="{{ $guest->id }}" {{ old('requested_by') == $guest->id ? 'selected' : '' }}>
                                            {{ $guest->fname }} {{ $guest->lname }} - {{ $guest->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Listing Selection -->
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3">
                                    <i class="fas fa-home me-2 text-primary"></i>Select Property
                                </label>
                                
                                <div class="row g-3" id="listingCards">
                                    @foreach($listings as $listing)
                                        <div class="col-md-6">
                                            <div class="card card-listing h-100" data-listing-id="{{ $listing->id }}">
                                                <div class="card-listing-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="listing_id" 
                                                            id="listing{{ $listing->id }}" value="{{ $listing->id }}"
                                                            {{ old('listing_id') == $listing->id ? 'checked' : '' }} required>
                                                        <label class="form-check-label w-100" for="listing{{ $listing->id }}">
                                                            <h5 class="mb-1">{{ $listing->title }}</h5>
                                                            <p class="text-muted small mb-0">
                                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                                {{ $listing->location ?? 'Location not specified' }}
                                                            </p>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Date and Time -->
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3">
                                    <i class="fas fa-clock me-2 text-primary"></i>Schedule Viewing
                                </label>

                                <div class="date-time-container">
                                    <div class="form-floating mb-3 flex-grow-1">
                                        <input type="date" name="viewing_date" id="viewing_date" 
                                            class="form-control" value="{{ old('viewing_date') }}" required>
                                        <label for="viewing_date">Select Date</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3 flex-grow-1">
                                        <input type="time" name="viewing_time" id="viewing_time" 
                                            class="form-control" value="{{ old('viewing_time') }}" required>
                                        <label for="viewing_time">Select Time</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg submit-btn px-5">
                                <i class="fas fa-calendar-check me-2"></i>Create Booking
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle listing card selection
        const listingCards = document.querySelectorAll('.card-listing');
        
        listingCards.forEach(card => {
            card.addEventListener('click', function() {
                // Clear all selected states
                listingCards.forEach(c => c.classList.remove('selected'));
                
                // Select this card
                this.classList.add('selected');
                
                // Check the associated radio button
                const radioInput = this.querySelector('input[type="radio"]');
                radioInput.checked = true;
            });
        });
        
        // Set initial selected state if there's an old value
        const checkedRadio = document.querySelector('input[name="listing_id"]:checked');
        if (checkedRadio) {
            const parentCard = checkedRadio.closest('.card-listing');
            if (parentCard) {
                parentCard.classList.add('selected');
            }
        }
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection