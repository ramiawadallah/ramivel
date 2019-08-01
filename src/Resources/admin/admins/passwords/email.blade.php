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
                            Reset {{ ucfirst(config('multiauth.prefix')) }} Password
                        </h1>
                        <h2 class="h6 font-w400 text-muted mb-3">
                        </h2>
                    </div>
                    <!-- END Header -->

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Sign In Form -->
                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <form method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Admin Password') }}">
                        @csrf
                        <div class="py-3">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg form-control-alt {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" name="email" placeholder="Your Email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> {{ __('Send Password Reset Link') }}
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