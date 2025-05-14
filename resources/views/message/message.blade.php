@extends('layouts.app')
@section('content')
<!-- Main content START -->
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <!-- Page title -->
            <div class="my-5">
                <h3>Message</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <!-- Left side START -->
                        <div class="col-4 border">
                            <div class="d-flex justify-content-between align-items-center my-3">
                                <!-- Avatar -->
                                <div class="avatar avatar-md">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/4.jpg" alt="avatar">
                                    <!--Active dots  -->
                                    <span class="active-dot"></span>
                                </div>
                                <!-- Icon -->
                                <div class="ms-3">
                                    <ul class="list-inline text-primary-hover">
                                        <li class="list-inline-item me-2"><a href="#" class="text-secondary small"><i class="fas fa-fw fa-comment-alt"></i></a></li>
                                        <li class="list-inline-item me-0"><a href="#" class="text-secondary small"><i class="fas fa-fw fa-ellipsis-v"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <!-- Search bar -->
                            <form class="align-self-center position-relative py-1" role="search" action="#">
                                <input type="text" class="form-control bg-secondary-soft text-dark border" placeholder="Search here...">
                                <button type="submit" id="search-submit1" class="btn position-absolute top-50 end-0 translate-middle-y"><i class="fa fa-search text-secondary"></i></button>
                            </form>
                            <!-- Content -->
                            <div class="nav flex-column p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @php
                                    use Illuminate\Support\Str;
                                @endphp
                                <!-- Chat -->
                                @foreach($conversations as $index => $conversation)
                                <a class="nav-link @if($index == 0) active @endif py-3" id="v-pills-chat-tab-{{ $index+1 }}" data-bs-toggle="pill" href="#v-pills-chat-{{ $index+1 }}" role="tab" aria-controls="v-pills-chat-{{ $index+1 }}" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                    <!-- Info -->
                                    <div class="row align-items-center">
                                        <div class="col-xxl-8">
                                            <div class="d-md-flex align-items-center">
                                                <!-- Avatar -->
                                                <div class="d-none d-md-block">
                                                    <div class="avatar avatar-md">
                                                        <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/3.jpg') }}" alt="avatar">
                                                        <!--Active dots  -->
                                                        <span class="active-dot"></span>
                                                    </div>
                                                </div>
                                                <!-- Title -->
                                                <div class="ms-3">
                                                    <h6 class="mb-0">{{ Str::limit($conversation->support_message, 20) }}</h6>
                                                    <p class="text-body mb-0 small">{{ $conversation->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Time -->
                                        <div class="col-4 text-end d-none d-xxl-block">
                                            <span class="text-body mb-0 small text-end">{{ $conversation->created_at->format('g:i a') }}</span>
                                        </div>
                                    </div>
                                </a> <hr class="m-0">
                                @endforeach
                            </div>
                        </div>
                        <!-- Left side END -->

                        <!-- Right side START -->
                        <div class="col-8 border border-start-0 bg-white">
                            <div class="tab-content p-4" id="v-pills-tabContent-2">
                                <!-- Chat detail -->
                                @foreach($conversations as $index => $conversation)
                                <div class="tab-pane fade @if($index == 0) show active @endif" id="v-pills-chat-{{ $index+1 }}" role="tabpanel" aria-labelledby="v-pills-chat-tab-{{ $index+1 }}">
                                    <!-- Info -->
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <!-- Avatar -->
                                                <div class="avatar avatar-md">
                                                    <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/3.jpg') }}" alt="avatar">
                                                    <!--Active dots  -->
                                                    <span class="active-dot"></span>
                                                </div>
                                                <!-- Title -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="ms-3">
                                                        <h6 class="mb-0">{{ $conversation->support_message }}</h6>
                                                        <p class="text-body mb-0 small">{{ $conversation->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Icon -->
                                        <div class="col-md-6 text-end d-none d-md-block">
                                            <div class="ms-3">
                                                <ul class="list-inline text-primary-hover">
                                                    <li class="list-inline-item me-3 small"><a href="#" class="text-dark"><i class="fas fa-fw fa-phone-alt"></i></a></li>
                                                    <li class="list-inline-item me-3 small"><a href="#" class="text-dark"><i class="fas fa-fw fa-video"></i></a></li>
                                                    <li class="list-inline-item me-3 small"><a href="#" class="text-dark"><i class="far fa-fw fa-star"></i></a></li>
                                                    <li class="list-inline-item me-3 small"><a href="#" class="text-dark"><i class="fas fa-fw fa-user-plus"></i></a></li>
                                                    <li class="list-inline-item me-3 small"><a href="#" class="text-dark"><i class="fas fa-fw fa-ellipsis-v"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-5">
                                    <!-- Message -->
                                    <div>
                                        <p><span class="bg-primary text-white py-2 px-4 rounded-1 mb-0 d-inline-block">{{ $conversation->support_message }}</span></p>
                                        <p><span>{{ $conversation->created_at->format('g:i a') }}</span></p>
                                    </div>
                                    <!-- Type message -->
                                    <form class="input-group" method="POST" action="{{ route('tenant.support.store') }}">
                                        @csrf
                                        <input type="hidden" name="support_id" value="{{ $conversation->support_id }}">
                                        <input name="support_message" class="form-control bg-secondary-soft text-dark border" placeholder="Type a message" required>
                                        <button type="submit" class="btn btn-primary position-absolute top-50 end-0 translate-middle-y"><i class="fas fa-paper-plane"></i></button>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Right side END -->
                    </div> <!-- Row END -->
                </div>
            </div> <!-- Row END -->
        </div>
    </div> <!-- Row END -->
</div>
<!-- Main content END -->
@endsection
