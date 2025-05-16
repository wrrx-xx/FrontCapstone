@extends('layouts.app')

@section('content')
<div class="main-content">
    @if (session('success') || $errors->any())
        <!-- Feedback Modal -->
        @include('components.feedback-modal')
    @endif

    <div class="row">
        <div class="col-12">
            <!-- Property list START -->
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-secondary-soft p-3 p-md-5 rounded">
                        <!-- Title -->
                        <div class="row d-none d-xxl-block">
                            <div class="col-12 align-middle py-3">
                                <div class="row border-bottom">
                                    <div class="col-6">
                                        <h5>Listing</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4 align-middle text-body py-2">
                                                <h5>Category</h5>
                                            </div>
                                            <div class="col-4 align-middle py-2">
                                                <h5>Status</h5>
                                            </div>
                                            <div class="col-4 align-middle py-2">
                                                <h5>Action</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($owners->isEmpty())
                            <p>No listings found.</p>
                        @else
                            @foreach ($owners as $owner)
                                <div class="owner-container mb-5 p-3 border rounded">
                                    <h4>Owner: {{ $owner->fname }} {{ $owner->lname }}</h4>
                                    @foreach ($owner->listing as $listing)
                                        <div class="row align-middle py-4">
                                            <div class="col-xxl-6">
                                                <div class="card bg-transparent">
                                                    <div class="row">
                                                        <!-- Image -->
                                                        <div class="col-xl-3">
                                                            @if ($listing->photos->isNotEmpty())
                                                                <img class="rounded"
                                                                    src="{{ asset($listing->photos->first()->photo_url) }}"
                                                                    alt="{{ $listing->title }}">
                                                            @else
                                                                <img class="rounded"
                                                                    src="{{ asset('path/to/default/image.jpg') }}"
                                                                    alt="Default Image">
                                                            @endif
                                                        </div>
                                                        <!-- Info -->
                                                        <div class="col-xl-9 pt-2 pt-xl-0">
                                                            <h6 class="mb-1">{{ $listing->title }}</h6>
                                                            <p class="mb-1 text-body">
                                                                {{ Str::limit($listing->body, 100) }}</p>
                                                            <span
                                                                class="text-success">₱{{ number_format($listing->price, 2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Content -->
                                            <div class="col-xxl-6 pt-2 pt-xxl-0">
                                                <div class="row">
                                                    <!-- Type -->
                                                    <div class="col-md-4 align-middle text-body">
                                                        {{ $listing->type }}
                                                    </div>
                                                    <!-- Availability Badge -->
                                                    <div class="col-md-4 align-middle pt-2 pt-md-0">
                                                        <div
                                                            class="badge {{ $listing->availability == 'open' ? 'bg-success-soft text-success' : 'bg-danger-soft text-danger' }}">
                                                            <i
                                                                class="fas fa-rupee-sign pe-1"></i>{{ ucfirst($listing->availability) }}
                                                        </div>
                                                    </div>
                                                    <!-- Buttons -->
                                                    <div class="col-md-4 align-middle pt-2 pt-md-0">
                                                        <a href="{{ route('listing.detail', $listing->id) }}"
                                                            class="btn btn-sm btn-info-soft me-1 mb-1">
                                                            <i class="fas fa-fw fa-eye"></i>
                                                        </a>
                                                        @if (auth()->user()->role !== 'caretaker')
                                                            <a href="{{ route('admin.listing.edit', $listing->id) }}"
                                                                class="btn btn-sm btn-success-soft me-1 mb-1">
                                                                <i class="far fa-fw fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('listing.destroy', $listing->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger-soft mb-1"
                                                                    onclick="return confirm('Are you sure you want to delete this listing?');">
                                                                    <i class="far fa-fw fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- Row END -->
                                        <hr> <!-- Divider -->
                                    @endforeach
                                </div>
                            @endforeach

                            <!-- Pagination links -->
                            <div class="d-flex justify-content-center">
                                {{ $owners->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Property list END -->
        </div>
    </div>
</div>
@endsection
