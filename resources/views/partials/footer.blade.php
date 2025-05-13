<!-- resources/views/partials/footer.blade.php -->
<footer class="position-relative bg-light py-5">
    <!-- Svg -->
    <figure class="position-absolute bottom-0 start-0 d-none d-sm-block">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="370px" height="370px">
            <path class="fill-light" fill-rule="evenodd" opacity="0.502"
                d="M185.000,-0.000 C287.173,-0.000 370.000,82.827 370.000,185.000 C370.000,287.173 287.173,370.000 185.000,370.000 C82.827,370.000 -0.000,287.173 -0.000,185.000 C-0.000,82.827 82.827,-0.000 185.000,-0.000 Z"/>
        </svg>
    </figure>

    <div class="container">
        <div class="row py-4 position-relative">
            <!-- Widget 1 START -->
            <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                <div class="logo mb-3">
                    <img src="{{ asset('assets/images/logo2.png') }}" alt="logo" class="img-fluid" style="width: 150px; max-height: 150px;">
                </div>
                <p class="mb-3">Find your perfect rental property with ease. Browse listings, schedule viewings, and connect with property owners all in one place.</p>
                <p class="text-primary-hover mb-2"><a href="#"><i class="fas fa-phone-alt fa-fw me-2"></i>123-456-789</a></p>
                <address class="text-primary-hover mb-2"><a href="#" class="d-flex"><i class="fas fa-map-marker-alt fa-fw me-2"></i>750 Sing Sing Rd, Horseheads, NY, 14845</a></address>
                <p class="text-primary-hover mb-2"><a href="#"><i class="far fa-envelope fa-fw me-2"></i>contact@rentalapp.com</a></p>
            </div>
            <!-- Widget 1 END -->

            <!-- Widget 2 START -->
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                <div class="row">
                    <!-- Only show these links for guest users -->
                    
                    <div class="col-6 col-md-4">
                        <h5 class="mb-2 mb-md-4">Explore</h5>
                        <ul class="nav flex-column text-primary-hover">
                            <li class="nav-item"><a class="nav-link pt-0" href="{{ route('listing.display') }}">Browse Listings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-4">
                        <h5 class="mb-2 mb-md-4">Account</h5>
                        <ul class="nav flex-column text-primary-hover">
                            <li class="nav-item"><a class="nav-link pt-0" href="{{ route('login') }}">Sign In</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Reset Password</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-4">
                        <h5 class="mb-2 mb-md-4">Legal</h5>
                        <ul class="nav flex-column text-primary-hover">
                            <li class="nav-item"><a class="nav-link pt-0" href="#">Privacy Policy</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Terms of Service</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Cookie Policy</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            <!-- Widget 2 END -->

            <!-- Widget 3 START -->
            <div class="col-12 col-lg-3">
                <h5 class="mb-2 mb-md-4">Connect With Us</h5>
                <ul class="list-inline mb-4">
                    <li class="list-inline-item me-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" title="Twitter">
                            <i class="fab fa-fw fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item me-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="list-inline-item me-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" title="Facebook">
                            <i class="fab fa-fw fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item me-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" title="LinkedIn">
                            <i class="fab fa-fw fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>

                <h5 class="mb-2 mb-md-4">Get Our App</h5>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <a href="#" class="d-block">
                            <img src="{{ asset('assets/images/client/google-play.svg') }}" alt="Google Play" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="d-block">
                            <img src="{{ asset('assets/images/client/app-store.svg') }}" alt="App Store" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Widget 3 END -->
        </div>
        
        <!-- Copyright -->
        <div class="row border-top py-3 mt-3">
            <div class="col-md-6">
                <p class="mb-0">© {{ date('Y') }} Rental Property Management. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-muted small">Designed with <i class="fas fa-heart text-danger"></i> for property seekers</p>
            </div>
        </div>
    </div>
</footer>