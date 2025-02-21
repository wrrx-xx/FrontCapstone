@extends('layouts.app')
@section('content')
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
                            <input type="email" class="form-control bg-light border-0" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-dark">Password *</label>
                            <input type="password" id="password" class="form-control bg-light border-0" name="password" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
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
@endsection
