<!DOCTYPE html>
<html lang="en">

<head>
    <title>Realty - Sign In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>

<header class="navbar-light navbar-sticky header-static">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img class="navbar-brand-item" src="assets/images/logo.svg" alt="logo">
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.html">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="signin.html">Sign In</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <section class="pt-3 pt-md-5">
        <div class="container card-grid">
            <div class="row align-items-center">
                <div class="col-md-6 mt-5 mt-md-0">
                    <h3>Please log in with your account!</h3>
                    <p class="mb-4 mb-lg-5">Login to your account easily with less information.</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-dark">Email address *</label>
                            <input type="email" class="form-control bg-light border-0" id="email" name="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-dark">Password *</label>
                            <input type="password" id="password" class="form-control bg-light border-0" name="password" required>
                            <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8 characters at least.
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">Keep me signed in</label>
                            </div>
                            <div class="text-primary-hover"><a href="#" class="text-secondary"><u>Forgot password?</u></a></div>
                        </div>
                        <button class="btn btn-primary" type="submit">Sign in</button>
                        <div class="mt-3">
                            <span class="text-muted">Don't have an account? <a href="{{ route('register') }}">Signup here</a></span>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/signin-signup/01.png" alt="Sign In Image">
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="position-relative bg-dark">
    <div class="container">
        <div class="row py-5">
        
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                <div class="row">
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
            <div class="col-12 col-lg-3">
                <h5 class="mb-2 mb-md-4 text-white">Follow us</h5>
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
                
            </div>
        </div>
    </div>
</footer>

<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/functions.js"></script>

</body>

</html>