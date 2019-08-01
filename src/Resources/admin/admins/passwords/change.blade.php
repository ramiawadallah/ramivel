@extends('layouts.backend') 
@section('content')

<div class="content">
    <div class="block py-3 col-md-8">
        <div class="block-header">
            {{ ucfirst(config('multiauth.prefix')) }} Change Your Password
        </div>
        <div class="block-content">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('admin.password.change') }}" aria-label="{{ __('Admin Change Password') }}">
                @csrf
                <div class="form-group">
                    <label for="oldPassword" class="col-md-12">{{ __('Old Password') }}</label>

                    <div class="col-md-12">
                        <input id="oldPassword" type="password" class="form-control{{ $errors->has('oldPassword') ? ' is-invalid' : '' }}" name="oldPassword" value="{{ $oldPassword ?? old('oldPassword') }}"
                            required autofocus> @if ($errors->has('oldPassword'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('oldPassword') }}</strong>
                            </span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-12">{{ __('Password') }}</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required> @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-12">{{ __('Confirm Password') }}</label>

                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 offset-md-12">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Change Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection