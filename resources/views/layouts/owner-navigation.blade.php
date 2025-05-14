<!-- **************** MAIN CONTENT START **************** -->
<!-- Navbar top START -->
<div class="dashboard-topbar navbar-light bg-light px-3 px-sm-4 px-md-5">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center py-2" href="index.html">
            <img class="navbar-brand-item" src="{{ asset('assets/images/logo2.png') }}" alt="logo">
        </a>

        <!-- Navbar right -->
        <ul class="list-inline m-0 text-primary-hover">
            <!-- Search bar -->
            <li class="d-none d-md-inline-block list-inline-item text-black me-3">
                <form class="align-self-center position-relative" role="search" action="#">
                    <input type="text" class="form-control bg-secondary-soft text-black border-0"
                        placeholder="Search here...">
                    <button type="submit" id="search-submit"
                        class="btn position-absolute top-50 end-0 translate-middle-y"><i
                            class="fa fa-search text-secondary"></i></button>
                </form>
            </li>
            <!-- Icon -->
            <li class="list-inline-item me-2 me-sm-3"> <a href="#" class="text-black"><i
                        class="far fa-envelope"></i></a></li>
            <li class="list-inline-item me-2 me-sm-3 dropdown">
                <a href="#" class="text-black position-relative" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger p-1">
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
                {{-- <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="notificationDropdown" style="min-width: 300px; max-width: 350px;">
                    <h4 class="mb-4 mt-0 fw-bold">Recent Activity</h4>
                    <ul class="list-inline mb-4 small">
                        @foreach($maintenanceRequests->take(3) as $request)
                        <li class="list-inline-item activity-item">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 text-warning activity-icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0 text-dark">Maintenance request for {{ $request->listing->title }}</p>
                                    <div class="small">{{ $request->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                        </li>
                        @endforeach

                        @foreach($payments->take(2) as $payment)
                        <li class="list-inline-item activity-item">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 text-success activity-icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0 text-dark">Payment received for {{ $payment->listing->title }}</p>
                                    <div class="small">{{ $payment->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                        </li>
                        @endforeach

                        @foreach($viewings->take(2) as $viewing)
                        <li class="list-inline-item activity-item">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 text-primary activity-icon">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0 text-dark">Viewing request for {{ $viewing->listing->title }}</p>
                                    <div class="small">{{ $viewing->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </ul> --}}
            <!-- Dropdown avatar -->
            <li class="list-inline-item">
                <a href="#" class="btn-link" role="button" id="dropdownAvatar" data-bs-toggle="dropdown"
                    aria-expanded="false">
            <img class="box-sm rounded-circle" src="{{ asset(Auth::user()->profile_photo) }}" alt="Profile picture">
                </a>
                <!-- Dropdown list -->
                <ul class="dropdown-menu min-w-auto" aria-labelledby="dropdownAvatar">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Setting</a></li>
                    <li><a class="dropdown-item" href="#">My Wallet</a></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </li>
            <!-- Toggle button -->
            <li class="list-inline-item d-md-inline-block d-lg-none">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNav"
                    aria-controls="dashboardNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </li>
        </ul>
    </div>
</div>
<!--Navbar top END -->

<div class="container-fluid px-0">
    <div class="page-wrapper">
        <!-- Left sidebar START -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
            <div class="collapse navbar-collapse" id="dashboardNav">
                <div class="dashboard-sidebar bg-light">
                    <div class="content mt-3">
                        <!-- Sidebar menu -->
                        <!-- Sidebar menu -->
                        <div class="list-group list-group-borderless p-3 p-md-4">
                            <p class="text-body mb-2">Main</p>

                            <a class="list-group-item hover-primary-soft" href="{{ route('owner.dashboard') }}">
                                <i class="fas fa-fw fa-tachometer-alt me-2"></i>Dashboard
                            </a>

                            <p class="text-body mt-3 mb-2">Manage Listing</p>
                            <div class="approval-status">
                                @if (Auth::user()->ownerProfile && Auth::user()->ownerProfile->approved)
                                    <span class="text-success">✓ Approved</span>
                                @else
                                    <span class="text-danger">✗ Pending Approval</span>
                                @endif
                            </div>
                            @if (Auth::user()->ownerProfile && Auth::user()->ownerProfile->approved)
                                <a class="list-group-item hover-primary-soft" href="{{ route('listing.create') }}">
                                    <i class="fas fa-fw fa-plus-square me-2"></i>Add Property
                                </a>
                            @else
                                <div class="list-group-item text-muted" style="opacity: 0.6;">
                                    <i class="fas fa-fw fa-plus-square me-2"></i>Add Property
                                </div>
                            @endif

                            <a class="list-group-item hover-primary-soft"
                                href="{{ route('listing.myproperty', ['id' => auth()->user()->id]) }}">
                                <i class="fas fa-fw fa-home me-2"></i>My Property
                            </a>

                            @if (Auth::user()->ownerProfile && Auth::user()->ownerProfile->approved)
                                <a class="list-group-item hover-primary-soft" href="{{ route('caretaker.index') }}">
                                    <i class="fas fa-fw fa-user-tie me-2"></i>Caretaker
                                </a>
                            @else
                                <div class="list-group-item text-muted" style="opacity: 0.6;">
                                    <i class="fas fa-fw fa-user-tie me-2"></i>Caretaker
                                </div>
                            @endif

                            @if (Auth::user()->ownerProfile && Auth::user()->ownerProfile->approved)
                                <a class="list-group-item hover-primary-soft d-flex justify-content-between align-items-center" href="{{ route('booking.owner') }}">
                                    <span><i class="fas fa-fw fa-calendar-check me-2"></i>Bookings</span>
                                    @php
                                        $pendingBookingsCount = App\Models\Viewing::getPendingCount();
                                    @endphp
                                    @if($pendingBookingsCount > 0)
                                        <span class="badge bg-danger rounded-pill">{{ $pendingBookingsCount }}</span>
                                    @endif
                                </a>
                            @else
                                <div class="list-group-item text-muted" style="opacity: 0.6;">
                                    <i class="fas fa-fw fa-calendar-check me-2"></i>Bookings
                                </div>
                            @endif

                            @if (Auth::user()->ownerProfile && Auth::user()->ownerProfile->approved)
                                <a class="list-group-item hover-primary-soft" href="{{ route('reservations.index') }}">
                                    <i class="fas fa-fw fa-calendar-alt me-2"></i>Reservations
                                </a>
                            @else
                                <div class="list-group-item text-muted" style="opacity: 0.6;">
                                    <i class="fas fa-fw fa-calendar-alt me-2"></i>Reservations
                                </div>
                            @endif

                            @if (Auth::user()->ownerProfile && Auth::user()->ownerProfile->approved)
                                <a class="list-group-item hover-primary-soft" href="{{ route('payment.owner') }}">
                                    <i class="fas fa-fw fa-wallet me-2"></i>Payments
                                </a>
                            @else
                                <div class="list-group-item text-muted" style="opacity: 0.6;">
                                    <i class="fas fa-fw fa-wallet me-2"></i>Payments
                                </div>
                            @endif
                            @if (Auth::user()->ownerProfile && Auth::user()->ownerProfile->approved)
                                <a class="list-group-item hover-primary-soft d-flex justify-content-between align-items-center"
                                    href="{{ route('owner.maintenance.index') }}">
                                    <span><i class="fas fa-fw fa-tools me-2"></i>Maintenance Requests</span>
                                    @if (isset($pendingMaintenanceCount) && $pendingMaintenanceCount > 0)
                                        <span
                                            class="badge bg-danger rounded-pill">{{ $pendingMaintenanceCount }}</span>
                                    @endif
                                </a>
                            @else
                                <div class="list-group-item text-muted" style="opacity: 0.6;">
                                    <i class="fas fa-fw fa-tools me-2"></i>Maintenance Requests
                                </div>
                            @endif


                            <p class="text-body mt-3 mb-2">Manage Account</p>
                            <a class="list-group-item hover-primary-soft" href="{{ route('profile.edit') }}">
                                <i class="fas fa-fw fa-id-badge me-2"></i>My Profile
                            </a>

                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="list-group-item hover-primary-soft"
                                    style="border: none; background: none; cursor: pointer;">
                                    <i class="fas fa-fw fa-sign-out-alt me-2"></i>Log Out
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
