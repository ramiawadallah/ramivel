@extends('layouts.backend')
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ __(ucfirst(config('multiauth.prefix')) . ' guard list') }} 
                <span class="float-right">
                    <a href="{{ route('admin.guards.create') }}" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i></a>
                </span>
            </h3>
        </div>
        <div class="block-content">

            <div class="table-responsive">
                <table id="datata" class="table table-bordered table-striped table-vcenter js-dataTable-buttons table-vcenter">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($guards as $guard)
                        <tr>
                            <td>{{ $guard->name }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-light js-tooltip-enabled" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $guard->id }}').submit();">
                                        <i class="fa fa-fw fa-times text-danger"></i>
                                    </a>

                                    <form id="delete-form-{{ $guard->id }}" action="{{ route('admin.guards.delete',$guard->id) }}" method="POST" style="display: none;">
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