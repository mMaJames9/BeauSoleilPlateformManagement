@extends('layouts.app')

@section('content')
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('login') }}">
                            <img class="mb-4" src="{{ asset('assets/images/logo/logo.jpeg') }}" alt="Logo">
                            <span class="text-success h1">Beau </span><span class="text-warning h1">Soleil</span>
                    </h3>
                        </a>
                    </div>
                    <h1 class="auth-title">{{ __('Login') }}.</h1>
                    <p class="auth-subtitle mb-5">Entrer votre adresse email et votre mot de passe</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="email" type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-600" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <button class="btn btn-success btn-block btn-lg shadow-lg mt-5">{{ __('Login') }}</button>
                    </form>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-5 text-lg fs-4">
                            <p><a class="font-bold" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>

        </div>
    </div>
@endsection
