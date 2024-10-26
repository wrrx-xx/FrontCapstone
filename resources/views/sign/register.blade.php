
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Realty - Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>


    <section class="pt-3 pt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-5 mt-lg-0 order-2 order-lg-1">
                    <h3>Create Your New Account</h3>
                    <p class="mb-4 mb-lg-5">Join us and explore amazing properties.</p>
                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf
    
                        <div class="row mb-3">
                            <div class="col-4">
                                <x-input-label for="fname" :value="__('Firstname')" />
                                <x-text-input id="fname" class="form-control bg-light border-0" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
                                <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                            </div>
                            <div class="col-4">
                                <x-input-label for="mname" :value="__('Middlename')" />
                                <x-text-input id="mname" class="form-control bg-light border-0" type="text" name="mname" :value="old('mname')" required autofocus autocomplete="mname" />
                                <x-input-error :messages="$errors->get('mname')" class="mt-2" />
                            </div>
                            <div class="col-4">
                                <x-input-label for="lname" :value="__('Lastname')" />
                                <x-text-input id="lname" class="form-control bg-light border-0" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
                                <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                            </div>
                        </div>
    
                        <!-- Email Address -->
                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control bg-light border-0" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
    
                        <div class="mb-3">
                            <x-input-label for="phone_number" :value="__('Phone Number')" />
                            <x-text-input id="phone_number" class="form-control bg-light border-0" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
    
                        <!-- Password -->
                        <div class="mb-3">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="form-control bg-light border-0" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
    
                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="form-control bg-light border-0" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
    
                        <div class="d-flex justify-content-between">
                            <a class="text-muted" href="{{ route('signin') }}">
                                {{ __('Already registered?') }}
                            </a>
                            <x-primary-button>
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
    
                <div class="col-lg-6 order-1 text-center">
                    <img src="assets/images/signin-signup/01.png" alt="Sign Up Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <footer class="position-relative bg-dark">
        <div class="container">
            <!-- Row START -->
            <div class="row py-5 position-relative">
    
                <!-- Widget 1 START -->
                <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                    <!-- logo -->
                    <div class="logo mb-2">
                        <img src="assets/images/logo-light.svg" alt="">
                    </div>
                    <p class="mb-3">Thirty it matter enable become admire in giving. See resolved goodness felicity shy civility domestic had but. </p>
                    <!-- Contact detail -->
                    <p class="text-primary-hover mb-3"><a href="#"><i class="fas fa-phone-alt fa-fw me-2"></i>123-456-789</a></p>
                    <address class="text-primary-hover mb-3"><a href="#" class="d-flex"><i class="fas fa-map-marker-alt fa-fw me-2"></i>750 Sing Sing Rd, Horseheads, NY, 14845</a></address>
                    <p class="text-primary-hover mb-3"><a href="#"><i class="far fa-envelope fa-fw me-2"></i>example@email.com</a></p>
                    
                </div>
                <!-- Widget 1 END -->
    
                <!-- Widget 2 START -->
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <div class="row">
                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4 text-white">Quick links</h5>
                            <ul class="nav flex-column text-primary-hover">
                                <li class="nav-item"><a class="nav-link pt-0" href="#">What we do</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Company</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Easy steps</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Career</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Investment process</a></li>
                            </ul>
                        </div>
                                        
                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4 text-white">Useful links</h5>
                            <ul class="nav flex-column text-primary-hover">
                                <li class="nav-item"><a class="nav-link pt-0" href="#">Sign up</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Sign in</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Agent detail</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Customer Stories</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Privacy policy</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Terms of use</a></li>
                            </ul>
                        </div>
    
                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4 text-white">Services</h5>
                            <ul class="nav flex-column text-primary-hover">
                                <li class="nav-item"><a class="nav-link pt-0" href="#">Wish list</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Location map</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Faq</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Widget 2 END -->
    
                <!-- Widget 3 START -->
                <div class="col-12 col-lg-3">
                    <h5 class="mb-2 mb-md-4 text-white">Follow us</h5>
                        <!-- Social media -->
                        <ul class="list-inline mb-3">
                            <li class="list-inline-item">
                                <a href="#" class="fs-5 text-twitter"><i class="fab fa-fw fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="fs-5 text-instagram"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="fs-5 text-facebook"><i class="fab fa-fw fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="fs-5 text-linkedin"><i class="fab fa-fw fa-linkedin-in"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="fs-5 text-dribbble"><i class="fas fa-basketball-ball"></i></a>
                            </li>
                        </ul>
                        <!-- Title -->
    
                        <div class="row g-2 mb-3">
                            <!-- Google play store button -->
                            <div class="col-6 col-sm-4 col-lg-6">
                                <a href="#">
                                    <img src="assets/images/client/google-play.svg" alt="">
                                </a>
                            </div>
                            <!-- App store button -->
                            <div class="col-6 col-sm-4 col-lg-6">
                                <a href="#">
                                    <img src="assets/images/client/app-store.svg" alt="app-store">
                                </a>
                            </div>
                        </div> <!-- Row END -->
    
                        <!-- Copy rights -->
                        <div class="mt-4">
                            ©2021 <a href="#" class="text-reset btn-link" target="_blank">Realty</a>. All rights reserved
                    </div>
                </div> <!-- Widget 3 END -->
            </div>
            <!-- Row END -->
        </div>
    </footer>

<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>