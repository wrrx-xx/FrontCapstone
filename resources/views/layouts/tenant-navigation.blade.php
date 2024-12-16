<header class="navbar-light navbar-sticky header-static">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="navbar-brand-item" src="{{ asset('assets/images/logo.svg') }}" alt="logo">
            </a>
            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Main navbar START -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll mx-auto">
                    <!-- Separate Home Link -->
                </ul>

                <!-- Tenant Navigation Items -->
                <ul class="navbar-nav navbar-nav-scroll mx-auto">
                    <li class="nav-item">
                        <a class="nav-link navbar-primary-soft-hover" href="{{ url('/') }}" id="homeMenu">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listing.display') }}">Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reserve.index') }}" >Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Support</a>
                    </li>
                    <li class="nav-item">
                        
                    </li>

                    <!-- Add more items as needed -->
                </ul>
            </div>
            <!-- Main navbar END -->

            <!-- Optional Add listing button (if applicable) -->
            <div class="ms-5 ms-lg-0">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link" style="border: none; background: none; padding: 0;">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </nav>
</header>
<!-- ======================= Header END -->