{{-- filepath: resources/views/layouts/tenant-navigation.blade.php --}}
<!-- **************** MAIN CONTENT START **************** -->
<!-- Navbar top START -->
<div class="dashboard-topbar navbar-light bg-light px-3 px-sm-4 px-md-5">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center py-2" href="{{ route('tenant.dashboard') }}">
            <svg width="200" height="80" viewBox="0 0 320 80" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect width="320" height="80" rx="18" />
  <!-- Icon: stylized compass/arrow -->
  <g>
    <circle cx="40" cy="40" r="28" fill="#E3F0FF" stroke="#1A3A6B" stroke-width="3"/>
    <polygon points="40,20 48,48 40,40 32,48" fill="#2563EB" stroke="#1A3A6B" stroke-width="2"/>
    <circle cx="40" cy="56" r="2.5" fill="#2563EB"/>
  </g>
  <!-- Text -->
  <text x="80" y="54" font-family="Montserrat, Arial, sans-serif" font-size="38" font-weight="bold" fill="#1A3A6B" letter-spacing="2">Boardeast</text>
</svg>
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
            <li class="list-inline-item me-2 me-sm-3"> <a href="{{ route('tenant.messages.index') }}" class="text-dark"><i
                        class="far fa-envelope"></i></a></li>
            <li class="list-inline-item me-2 me-sm-3">
                <a href="#" class="text-black position-relative">
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
                    <img class="box-sm rounded-circle" src="{{ asset(Auth::user()->profile_photo) }}"
                        alt="Profile picture">
                </a>
                <!-- Dropdown list -->
                <ul class="dropdown-menu min-w-auto" aria-labelledby="dropdownAvatar">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
            
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
                <div class="dashboard-sidebar bg-dark d-flex flex-column" style="min-height: 100vh;">
                    <div class="content mt-3 flex-grow-1">
                        <!-- Sidebar menu -->
                        <div class="list-group list-group-borderless p-3 p-md-4">
                            <p class="text-body mb-2">Main</p>
                            <a class="list-group-item hover-primary-soft text-light"
                                href="{{ route('tenant.dashboard') }}"><i
                                    class="fas fa-fw fa-tachometer-alt me-2"></i>Dashboard</a>
                            <p class="text-body mt-3 mb-2">Tenant Services</p>
                            <a class="list-group-item hover-primary-soft text-light"
                                href="{{ route('tenant.rental.index') }}"><i class="fas fa-fw fa-home me-2"></i>My
                                Rentals</a>
                            <a class="list-group-item hover-primary-soft text-light"
                                href="{{ route('tenant.payment.index') }}"><i
                                    class="fas fa-fw fa-file-invoice-dollar me-2"></i>Payment History</a>
                            <a class="list-group-item hover-primary-soft text-light"
                                href="{{ route('tenant.maintenance.index') }}"><i
                                    class="fas fa-fw fa-tools me-2"></i>Maintenance</a>
                            <a class="list-group-item hover-primary-soft text-light"
                                href="{{ route('tenant.messages.index') }}">
                                <i class="fas fa-fw fa-envelope me-2"></i>Messages (Owner/Caretaker)
                            </a>
                            {{-- <a class="list-group-item hover-primary-soft text-light" href="{{ route('tenant.support') }}"><i class="fas fa-fw fa-life-ring me-2"></i>Support</a> --}}
                            <p class="text-body mt-3 mb-2">Manage Account</p>
                            <a class="list-group-item hover-primary-soft text-light"
                                href="{{ route('profile.edit') }}"><i class="fas fa-fw fa-user-alt me-2"></i>My
                                Profile</a>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline ">
                                @csrf
                                <button type="submit" class="list-group-item hover-primary-soft text-light"
                                    style="border: none; background: none; cursor: pointer;">
                                    <i class="fas fa-fw fa-sign-out-alt me-2"></i>Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- ...sidebar and nav code above... -->

                    @if (isset($listing) && auth()->user()->isTenant() && $listing->tenant_id == auth()->id())
                        <div class="p-4 mb-5">
                            <button type="button"
                                class="list-group-item hover-danger-soft bg-danger text-white w-100 rounded"
                                style="border: none; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#leaveListingModal">
                                <i class="fas fa-fw fa-door-open me-2"></i>Leave Listing
                            </button>
                        </div>
                    @endif

                    <!-- Message Owner/Caretaker Link -->
                   
                    <!-- End Message Owner/Caretaker Link -->
                </div>
            </div>
        </nav>
    </div>
</div>
