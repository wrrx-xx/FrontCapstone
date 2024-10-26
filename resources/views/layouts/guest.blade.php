<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Realty - Real Estate Bootstrap 5 Template</title>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Webestica.com">
        <meta name="description" content="bootstrap 5 based real estate template">
    
        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
    
        <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=DM+Serif+Text&amp;display=swap" rel="stylesheet">
        <!-- Plugins CSS -->
        <link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="assets/vendor/tiny-slider/tiny-slider.css">
        <link rel="stylesheet" href="../../cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    
        <!-- Theme CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
    </head>
<body>
    <!-- Header START -->
    <header class="navbar-light navbar-sticky header-static">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="navbar-brand-item" src="assets/images/logo.svg" alt="logo">
                </a>
                <!-- Logo END -->

                <!-- Responsive navbar toggler -->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link navbar-primary-soft-hover" href="{{ url('/home') }}" id="homeMenu">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="listings" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Listings</a>
                            <ul class="dropdown-menu" aria-labelledby="listings">
                                <li><a class="dropdown-item" href="{{ url('/listing') }}">Room</a></li>
                                <li><a class="dropdown-item" href="{{ url('/listing') }}">Boarding House</a></li>
                                <li><a class="dropdown-item" href="{{ url('/listing') }}">Apartment</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/about') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signin') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signup') }}">Sign Up</a>
                        </li>
                        
                        <!-- Add more items as needed -->
                    </ul>
                </div>
                <!-- Main navbar END -->

                <!-- Add listing button -->
                <div class="ms-5 ms-lg-0">
                    <a href="#" class="btn btn-sm btn-dark-soft"><i class="fas fa-plus me-2"></i>Add listing</a>
                </div>
                
            </div>
        </nav>
    </header>
    <!-- ======================= Header END -->

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
   @include('partials.footer')

    <!-- Scripts -->
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include other scripts here -->
</body>
</html>