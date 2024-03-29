@extends('layouts.auth')
@section('content')
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="w-100">
        <!-- Sign In Section -->
        <div class="content content-full bg-white">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4 py-4">

                     <!-- Header -->
                    <div class="text-center">
                        <p class="mb-2">
                            <img  class="logo-main img-fluid text-primary" src="{{ theme('backend/media/favicons/logo.png') }}">
                        </p>
                        <h1 class="h4 mb-1">
                            {{ __(ucfirst(config('multiauth.prefix'))  . ' reset password') }}
                        </h1>
                        <h2 class="h6 font-w400 text-muted mb-3">
                        </h2>
                    </div>
                    <!-- END Header -->

                    <form method="POST" action="{{ route('admin.password.request') }}" aria-label="{{ __('Admin Reset Password') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="py-3">
                            <div class="form-group ">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('E-Mail address') }}" value="{{ $email ?? old('email') }}"
                                    required autofocus> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span> @endif
                            </div>

                            <div class="form-group">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password"
                                        required> @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm password') }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection