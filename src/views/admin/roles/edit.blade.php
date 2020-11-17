@extends('layouts.backend') 
@section('content')

<div class="content">
    <div class="col-md-12">
        <div class="block">
             <div class="block-content">
                <div class="block-header">
                    <h3 class="block-title">
                        {{ __('Edit role') }}
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                                @csrf @method('patch')
                                <div class="form-group">
                                    <label for="role">{{ __('Role') }}</label>
                                    <input type="text" value="{{ $role->name }}" name="name" class="form-control" id="role" required>
                                </div>

                                 <table class="table table-borderless">
                                    <tbody>
                                        @foreach($permissions as $key => $value)
                                            <tr>
                                                @foreach($value as $permission)
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input checkbox"  name="permissions[]" id="{{$permission->id}}" 
                                                            value="{{$permission->id}}" {{ (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) ? ' checked' : '' }} id="{{$permission->id}}"  @if(in_array($permission->id,$role->permissions->pluck('id')->toArray()))
                                                                checked
                                                            @endif>
                                                            <label class="custom-control-label font-w400" for="{{$permission->id}}">{{$permission->name}}</label>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-dark btn-sm">{{ __('Change') }}</button>
                                <a href="{{ route('admin.roles') }}" class="btn btn-light btn-sm">{{ __('Back') }}</a>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection