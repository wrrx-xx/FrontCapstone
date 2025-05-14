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
            <li class="d-none d-md-inline-block list-inline-item text-dark me-3">
                <form class="align-self-center position-relative" role="search" action="#">
                    <input type="text" class="form-control bg-secondary-soft text-dark border-0"
                        placeholder="Search here...">
                    <button type="submit" id="search-submit"
                        class="btn position-absolute top-50 end-0 translate-middle-y"><i
                            class="fa fa-search text-secondary"></i></button>
                </form>
            </li>
            <!-- Icon -->
            <li class="list-inline-item me-2 me-sm-3"> <a href="#" class="text-dark"><i
                        class="far fa-envelope"></i></a></li>
            <li class="list-inline-item me-2 me-sm-3">
                <a href="#" class="text-dark position-relative">
                    <i class="far fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger p-1">
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
            </li>
            <!-- Dropdown avatar -->
            <li class="list-inline-item">
                <a href="#" class="btn-link" role="button" id="dropdownAvatar" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img class="box-sm rounded-circle" src="{{ asset(path: Auth::user()->profile_photo) }}" alt="Profile picture">
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
                        <div class="list-group list-group-borderless p-3 p-md-4">
                            <p class="text-body mb-2">Main</p>
                            <a class="list-group-item hover-primary-soft" href="{{ route('caretaker.dashboard') }}"><i
                                    class="fas fa-fw fa-tachometer-alt me-2"></i>Dashboard</a>

                            <p class="text-body mt-3 mb-2">Manage Listing</p>
                          
                            <a class="list-group-item hover-primary-soft"
                                href="{{ route('listing.myproperty', ['id' => auth()->user()->id]) }}"><i
                                    class="fas fa-fw fa-home me-2"></i>Properties</a>

                                    <a class="list-group-item hover-primary-soft d-flex justify-content-between align-items-center" href="{{ route('booking.owner') }}">
                                        <span><i class="fas fa-fw fa-calendar-check me-2"></i>Bookings</span>
                                        @php
                                            $pendingBookingsCount = App\Models\Viewing::getPendingCount();
                                        @endphp
                                        @if($pendingBookingsCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $pendingBookingsCount }}</span>
                                        @endif
                                    </a>
                                    <a class="list-group-item hover-primary-soft" href="{{ route('reservations.index') }}"><i
                                        class="fas fa-fw fa-users me-2"></i>Reservations</a>
                                        <a class="list-group-item hover-primary-soft" href="{{ route('payment.owner') }}">
                                            <i class="fas fa-fw fa-wallet me-2"></i>Payments
                                        </a>
                                        <a class="list-group-item hover-primary-soft d-flex justify-content-between align-items-center"
                                        href="{{ route('owner.maintenance.index') }}">
                                        <span><i class="fas fa-fw fa-tools me-2"></i>Maintenance Requests</span>
                                        @if (isset($pendingMaintenanceCountCaretaker) && $pendingMaintenanceCountCaretaker > 0)
                                            <span
                                                class="badge bg-danger rounded-pill">{{ $pendingMaintenanceCountCaretaker }}</span>
                                        @endif
                                    </a>
                            {{-- <a class="list-group-item hover-primary-soft" href="agent-review.html"><i
                                    class="far fa-fw fa-comment-dots me-2"></i>Review</a> --}}

                            {{-- <p class="text-body mt-3 mb-2">Messages</p>
                            <a class="list-group-item hover-primary-soft" href="{{ route('suppmess.index') }}"><i class="fas fa-fw fa-envelope me-2"></i>Message</a>
 --}}
                            <p class="text-body mt-3 mb-2">Manage Account</p>
                            <a class="list-group-item hover-primary-soft" href="{{ route('profile.edit') }}"><i
                                    class="fas fa-fw fa-user-alt me-2"></i>My Profile</a>
                          
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
