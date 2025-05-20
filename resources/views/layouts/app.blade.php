<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=DM+Serif+Text&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    @laravelPWA

</head>

<body class="font-poppins">

    <header>
        @if (Auth::check())
            @if (Auth::user()->isAdmin())
                @include('layouts.admin-navigation')
            @elseif (Auth::user()->isOwner())
                @include('layouts.owner-navigation')
            @elseif (Auth::user()->isTenant())
                @include('layouts.tenant-navigation')
            @elseif (Auth::user()->isCaretaker())
                @include('layouts.caretaker-navigation')
            @else
                @include('layouts.guest-navigation')
            @endif
        @else
            @include('layouts.guest-navigation')
        @endif
    </header>
    <section>
        @yield('content')
        @auth
            @if (Auth::user()->isTenant() && isset($listing) && $listing->tenant_id == auth()->id())
                <x-leave-listing-modal :listing="$listing" />
            @endif
        @endauth
       
    </section>

    <div class="back-top">
        <i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
    </div>
    <!-- Back to top -->
    @if (!Auth::check() || Auth::user()->isGuest())
        @include('partials.footer')
    @endif

    <!-- JS libraries, plugins and custom scripts -->
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Vendors -->
    <script src="{{ asset('assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart/chart.js') }}"></script>
    <!-- Template Functions -->
    <script src="{{ asset('assets/js/functions.js') }}"></script>

    @stack('scripts')
</body>

</html>
