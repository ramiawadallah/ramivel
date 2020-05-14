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
                        <h2 class="h6 font-w400 text-muted mb-3"></h2>
                    </div>
                    <!-- END Header -->

                    <!-- Sign In Form -->
                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <form  method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Admin Login') }}">
                        @csrf
                        <div class="py-3">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg form-control-alt {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="{{ trans('lang.email') }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> 
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg form-control-alt {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="{{ trans('lang.password') }}">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="d-md-flex align-items-md-center justify-content-md-between">
                                    <div class="custom-control custom-switch">
                                        <input class="custom-control-input" type="checkbox" name="remember" id="login-remember" {{ old( 'remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label font-w400" for="login-remember">{{ trans('lang.remember_me') }}</label>
                                    </div>
                                    <div class="py-2">
                                        <a class="font-size-sm" href="{{ route('admin.password.request') }}">{{ trans('lang.forgot_your_password?') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-6 col-xl-5">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> {{ trans('lang.login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- END Sign In Form -->
                </div>
            </div>
        </div>
        <!-- END Sign In Section -->
    </div>
</div>
<!-- END Page Content -->

@endsection