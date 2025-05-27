<!-- resources/views/partials/footer.blade.php -->
<footer class="position-relative bg-dark text-light py-5 mt-5">
    <!-- Background decoration -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-100 h-25">
            <path
                d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                fill="currentColor"></path>
        </svg>
    </div>
    <br><br>
    <div class="container position-relative pt-5">
        <div class="row g-4 py-4">
            <!-- Company Info START -->
            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                <div class="pe-lg-4 mt-5">
                    <!-- Logo -->
                    <svg width="320" height="80" viewBox="0 0 320 80" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="320" height="80" rx="18"  />
                        <!-- Icon: stylized compass/arrow -->
                        <g>
                            <circle cx="40" cy="40" r="28" fill="#232B45" stroke="#AAB6FF"
                                stroke-width="3" />
                            <polygon points="40,20 48,48 40,40 32,48" fill="#7CA8FF" stroke="#AAB6FF"
                                stroke-width="2" />
                            <circle cx="40" cy="56" r="2.5" fill="#7CA8FF" />
                        </g>
                        <!-- Text -->
                        <text x="80" y="54" font-family="Montserrat, Arial, sans-serif" font-size="38"
                            font-weight="bold" fill="#E5EBFB" letter-spacing="2">Boardeast</text>
                    </svg>

                    <!-- Description -->
                    <p class="text-light-emphasis mb-4 lh-lg">
                        Find your perfect rental property with ease. Browse listings, schedule viewings, and connect
                        with property owners all in one place.
                    </p>

                    <!-- Contact Info -->
                    <div class="d-flex flex-column gap-2 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope me-3 text-primary"></i>
                            <span class="text-light-emphasis">patajorexc@gmail.com</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-phone me-3 text-primary"></i>
                            <span class="text-light-emphasis">(+63) 9267265944</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt me-3 text-primary"></i>
                            <span class="text-light-emphasis">Purok Yellow Tops, Canda-ay Dumaguete City</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Company Info END -->

            <!-- Quick Links START -->
            <div class="col-12 col-lg-5">
                <div class="row g-4">
                    <div class="col-6 col-md-4">
                        <h5 class="text-white fw-bold mb-4 border-bottom border-primary border-2 pb-2 d-inline-block">
                            Explore</h5>
                        <ul class="nav flex-column gap-2">
                            <li class="nav-item">
                                <a class="nav-link text-white p-0 hover-primary transition"
                                    href="{{ route('listing.display') }}">
                                    <i class="fas fa-chevron-right me-2 small text-primary"></i>Browse Listings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white p-0 hover-primary transition"
                                    href="{{ route('listing.display') }}">
                                    <i class="fas fa-chevron-right me-2 small text-primary"></i>Featured Properties
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="col-6 col-md-4">
                        <h5 class="text-white fw-bold mb-4 border-bottom border-primary border-2 pb-2 d-inline-block">
                            Account</h5>
                        <ul class="nav flex-column gap-2">
                            <li class="nav-item">
                                <a class="nav-link text-white p-0 hover-primary transition" href="{{ route('login') }}">
                                    <i class="fas fa-chevron-right me-2 small text-primary"></i>Sign In
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white p-0 hover-primary transition"
                                    href="{{ route('register') }}">
                                    <i class="fas fa-chevron-right me-2 small text-primary"></i>Sign Up
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white p-0 hover-primary transition" href="#">
                                    <i class="fas fa-chevron-right me-2 small text-primary"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white p-0 hover-primary transition" href="#">
                                    <i class="fas fa-chevron-right me-2 small text-primary"></i>My Bookings
                                </a>
                            </li>
                        </ul>
                    </div>


                </div>
            </div>
            <!-- Quick Links END -->

            <!-- Connect Section START -->
            <div class="col-12 col-lg-3">
                <div class="ps-lg-4">
                    <h5 class="text-white fw-bold mb-4 border-bottom border-primary border-2 pb-2 d-inline-block">
                        Connect With Us</h5>

                    <!-- Social Media -->
                    <div class="mb-4">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-2">
                                <a href="#"
                                    class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item me-2">
                                <a href="#"
                                    class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="list-inline-item me-2">
                                <a href="#"
                                    class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"
                                    class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="mb-4">
                        <h6 class="text-white mb-3">Stay Updated</h6>
                        <div class="input-group">
                            <input type="email"
                                class="form-control form-control-sm bg-transparent border-secondary text-light"
                                placeholder="Your email">
                            <button class="btn btn-primary btn-sm" type="button">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                        <small class="text-light-emphasis d-block mt-2">Get the latest property updates</small>
                    </div>

                    <!-- Mobile Apps -->
                    <div>
                        <h6 class="text-white mb-3">Get Our App</h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="d-block flex-fill">
                                <img src="{{ asset('assets/images/client/google-play.svg') }}" alt="Google Play"
                                    class="img-fluid rounded" style="max-height: 40px;">
                            </a>
                            <a href="#" class="d-block flex-fill">
                                <img src="{{ asset('assets/images/client/app-store.svg') }}" alt="App Store"
                                    class="img-fluid rounded" style="max-height: 40px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Connect Section END -->
        </div>

        <!-- Copyright Bar -->
        <div class="row border-top border-secondary pt-4 mt-4">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <p class="mb-0 text-light-emphasis">
                    © {{ date('Y') }} Rental Property Management. All rights reserved.
                </p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <p class="mb-0 text-light-emphasis">
                    Designed with <i class="fas fa-heart text-danger"></i> for property seekers
                    <span class="mx-2">|</span>
                    <a href="#" class="text-decoration-none text-primary">Privacy</a>
                    <span class="mx-2">|</span>
                    <a href="#" class="text-decoration-none text-primary">Terms</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Custom CSS for hover effects -->
<style>
    .hover-primary:hover {
        color: var(--bs-primary) !important;
        transform: translateX(5px);
    }

    .transition {
        transition: all 0.3s ease;
    }

    footer .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    footer .input-group .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
    }
</style>
