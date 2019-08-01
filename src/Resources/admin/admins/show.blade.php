@extends('layouts.backend')
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ ucfirst(config('multiauth.prefix')) }} List
                <span class="float-right">
                    <a href="{{route('admin.register')}}" class="btn btn-sm btn-success">New {{ ucfirst(config('multiauth.prefix')) }}</a>
                </span>
            </h3>
        </div>
        <div class="block-content">
            @include('partials.message')
            <div class="table-responsive">
                <table id="datata" class="table table-bordered table-striped table-vcenter js-dataTable-buttons table-vcenter">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Access</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @foreach ($admin->roles as $role)
                                <span class="label label-primary">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-light js-tooltip-enabled" href="{{route('admin.edit',[$admin->id])}}">
                                        <i class="fa fa-fw fa-pencil-alt text-info"></i>
                                    </a>

                                    <a class="btn btn-sm btn-light js-tooltip-enabled" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                        <i class="fa fa-fw fa-times text-danger"></i>
                                    </a>

                                    <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.delete',$admin->id) }}" method="POST" style="display: none;">
                                        @csrf @method('delete')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                        @if($admins->count()==0)
                        <p>No {{ config('multiauth.prefix') }} created Yet, only super {{ config('multiauth.prefix') }} is available.</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection