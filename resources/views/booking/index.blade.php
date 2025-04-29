@extends('layouts.app')

@section('content')

<div class="main mx-7">
    <div class="row">
        <div class="col-12">
            <!-- Page title -->
            <!-- Viewings list START -->
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-secondary-soft p-3 p-md-5 rounded">
                        <!-- Title -->
                        <div class="row d-none d-xxl-block">
                            <div class="col-12 align-middle py-3">
                                <div class="row border-bottom">
                                    <div class="col-6">
                                        <h5>Visting Schedule</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4 align-middle text-body py-2">
                                                <h5>Visit Date</h5>
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

                        <!-- Viewings -->
                        @foreach($viewings as $viewing)
                        <div class="row">
                            <div class="col-12 align-middle py-4">
                                <div class="row">
                                    <div class="col-xxl-6">
                                        <div class="card bg-transparent">
                                            <div class="row">
                                                <!-- Image -->
                                                <div class="col-xl-3">
                                                    <img class="rounded" src="{{ asset('storage/' . ($viewing->listing->photos->first()->photo_url ?? 'default.jpg')) }}" alt="{{ $viewing->listing->title }}">
                                                </div>
                                                <!-- Info -->
                                                <div class="col-xl-9 pt-2 pt-xl-0">
                                                    <h6 class="mb-1">{{ $viewing->listing->title }}</h6>
                                                    <p class="mb-1 text-body">{{ $viewing->listing->address }}</p>
                                                    <span class="text-success">${{ number_format($viewing->listing->price, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Content -->
                                    <div class="col-xxl-6 pt-2 pt-xxl-0">
                                        <div class="row">
                                            <!-- Date -->
                                            <div class="col-md-4 align-middle text-body">
                                                {{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}
                                                <div class="col-md-4 align-middle text-body m-2">

                                                    {{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }} <!-- Format the time -->
    
                                                </div>
                                            </div>
                                            <!-- Badge -->
                                            <div class="col-md-4 align-middle pt-2 pt-md-0">
                                                <div class="badge 
                                                    @if($viewing->viewing_status == 'approved') bg-success 
                                                    @elseif($viewing->viewing_status == 'declined') bg-danger 
                                                    @elseif($viewing->viewing_status == 'cancelled') bg-warning 
                                                    @else bg-secondary @endif">
                                                    {{ ucfirst($viewing->viewing_status) }}
                                                </div>
                                            </div>
                                            <!-- Buttons -->
                                            <div class="col-md-4 align-middle pt-2 pt-md-0">
                                                <a class="btn btn-sm btn-info-soft me-1 mb-1" href="#"><i class="fas fa-fw fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success-soft me-1 mb-1" href="#"><i class="far fa-fw fa-edit"></i></a>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger-soft mb-1" type="submit"><i class="far fa-fw fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Row END -->
                            </div>
                        </div>
                        <hr> <!-- Divider -->
                        @endforeach

                        @if($viewings->isEmpty())
                            <p class="text-center">You have no viewings at this time.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Viewings list END -->
        </div>
    </div> <!-- Row END -->
</div>
@endsection