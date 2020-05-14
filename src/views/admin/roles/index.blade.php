@extends('layouts.backend') 
@section('content')

    <div class="content">
        <div class="block py-2">
            <div class="block-header">
                <h3 class="block-title">
                {{ trans('lang.roles_list') }}                    
                <span class="float-right">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> {{ trans('lang.add') }} </a>
                    </span>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table id="datata" class="table table-bordered table-striped table-vcenter js-dataTable-buttons table-vcenter">
                        <thead>
                            <tr>
                                <th>{{ trans('lang.name')}}</th>
                                <th class="hidden-xs">{{ trans('lang.role') }}</th>
                                <th class="hidden-xs">{{ trans('lang.permissions') }}</th>
                                <th class="text-center" style="width: 10%;">{{ trans('lang.action')}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="font-w600">{{ $role->name }}</td>
                                    <td class="hidden-xs">
                                        <span class="badge badge-primary badge-pill">
                                            {{ $role->admins->count() }} {{ ucfirst(config('multiauth.prefix')) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary badge-pill">
                                            {{ $role->permissions->count() }} {{ trans('lang.permissions') }}
                                        </span>
                                    </td>
                                     <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-light js-tooltip-enabled" href="{{route('admin.role.edit',[$role->id])}}">
                                                <i class="fa fa-fw fa-pencil-alt text-info"></i>
                                            </a>

                                            <a class="btn btn-sm btn-light js-tooltip-enabled" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                                <i class="fa fa-fw fa-times text-danger"></i>
                                            </a>

                                            <form id="delete-form-{{ $role->id }}" action="{{ route('admin.role.delete',$role->id) }}" method="POST" style="display: none;">
                                                @csrf @method('delete')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection