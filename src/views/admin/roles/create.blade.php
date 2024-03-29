@extends('layouts.backend') 
@section('content')

<div class="content">
    <div class="col-md-12">
        <div class="block">
             <div class="block-content">
                <div class="block-header">
                    <h3 class="block-title">
                        {{ __('Add role') }}
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.role.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="role">{{ __('Role') }}</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="role" required>
                                </div>

                                <table class="table table-borderless">
                                    <tbody>
                                        @foreach($permissions as $key => $value)
                                            <tr>
                                                @foreach($value as $permission)
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input checkbox"  name="permissions[]" id="{{$permission->id}}" 
                                                            value="{{$permission->id}}" {{ (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) ? ' checked' : '' }} id="{{$permission->id}}">
                                                            <label class="custom-control-label font-w400"  for="{{$permission->id}}">{{$permission->name}}</label>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h2 class="content-heading">
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        {{ __('Save') }}
                                    </button>
                                </h2>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection