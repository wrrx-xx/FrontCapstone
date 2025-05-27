<header class="navbar-light navbar-sticky header-static">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand" href="{{ url('/') }}">
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

                <!-- Other Navigation Items -->
                <ul class="navbar-nav navbar-nav-scroll mx-auto">
                    <li class="nav-item">
                        <a class="nav-link navbar-primary-soft-hover" href="{{ url('/') }}" id="homeMenu">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listing.display') }}">Listings</a>
                    </li>

                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reserve.index') }}" >Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="border: none; background: none; padding: 0;">
                                    Logout
                                </button>
                            </form>
                        </li>
                        
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                        </li>
                        
                   

                    <!-- Add more items as needed -->
                </ul>
            </div>
            <div class="ms-5 ms-lg-0">
                <a href="{{ route('listing.create') }}" class="btn btn-sm btn-dark-soft"><i class="fas fa-plus me-2"></i>Add listing</a>
            </div>
            <!-- Main navbar END -->
            @endif
            <!-- Add listing button -->
           

        </div>
    </nav>
</header>