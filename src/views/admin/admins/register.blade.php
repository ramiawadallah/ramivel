@extends('layouts.backend') 
@section('content')
<div class="content">
    <div class="block py-3 col-md-8">
        <div class="block-header">{{ trans('lang.add_admin') }}</div>
        <div class="block-content">
            
            <form method="POST" action="{{ route('admin.register') }}">
                @csrf
                <div class="form-group">
                    <label class="col-md-12">{{ trans('lang.name') }} </label>
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                        required autofocus>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-12">{{ trans('lang.email') }}</label>
                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                        required>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' text-danger' : '' }}">
                    <label for="password" class="col-md-12">{{ trans('lang.password') }}</label>
                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12">{{ trans('lang.confirm_password') }}</label>
                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12">{{ trans('lang.role') }} </label>
                    <div class="col-md-12">
                        <select name="role_id[]" id="role_id" class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}" multiple>
                            <option selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark btn-sm">
                            {{ trans('lang.change') }} 
                        </button>
                        <a href="{{ route('admin.show') }}" class="btn btn-light btn-sm">
                            {{ trans('lang.back') }} 
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection