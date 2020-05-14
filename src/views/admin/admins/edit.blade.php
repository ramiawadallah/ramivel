@extends('layouts.backend') 
@section('content')
<div class="content">
    <div class="col-md-8">
        <div class="block py-3">
            <div class="block-header">{{ trans('lang.edit')}} {{$admin->name}}</div>

            <div class="block-content">
                
                <form action="{{route('admin.update',[$admin->id])}}" method="post">
                    @csrf @method('patch')
                    <div class="form-group">
                        <label for="role" class="col-md-12">{{ trans('lang.name')}}</label>
                        <input type="text" value="{{ $admin->name }}" name="name" class="form-control col-md-12" id="role">
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-md-12">{{ trans('lang.email') }}</label>
                        <input type="text" value="{{ $admin->email }}" name="email" class="form-control col-md-12" id="role">
                    </div>

                    <div class="form-group">
                        <label for="role_id" class="col-md-12">{{ trans('lang.role') }}</label>

                        <select name="role_id[]" id="role_id" class="form-control col-md-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" multiple>
                            <option selected disabled>{{ trans('lang.select_role') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" 
                                    @if (in_array($role->id,$admin->roles->pluck('id')->toArray())) 
                                        selected 
                                    @endif >{{ $role->name }}
                                </option>
                            @endforeach
                        </select> 

                        @if ($errors->has('role_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('role_id') }}</strong>
                            </span> 
                        @endif
                    </div>

                    <div class="custom-control custom-switch mb-2">
                        <input class="custom-control-input col-md-12" type="checkbox" name="activation" value="1" id="active" {{ $admin->active ? 'checked':'' }}>
                        <label class="custom-control-label font-w400" for="active">{{ trans('lang.active') }}</label>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">
                                {{ trans('lang.change') }}
                            </button>
                            <a href="{{ route('admin.show') }}" class="btn btn-danger btn-sm float-right">{{ trans('lang.back') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
