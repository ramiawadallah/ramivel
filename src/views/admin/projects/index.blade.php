@extends('layouts.backend')
@section('title') {{ __('Projects') }}  @endsection
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ __('Projects') }} 
                <span class="float-right">
                    {!! Btn::create() !!}
                </span>
            </h3>
        </div>

        <div class="block-content">
    
            <div class="table-responsive">
                <table id="datata" class="table table-bordered table-striped table-vcenter js-dataTable-buttons table-vcenter">
                    <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Photo') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Create at') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->trans('title') }}</td>
                                <td><img  src="{{ media($project->photo) }}" style="max-width:50px;"></td>
                                <td>{{ $project->trans('status') }}</td>
                                <td>{{ date('Y/m/d',strtotime($project->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {!! Btn::view($project->id) !!}
                                        {!! Btn::edit($project->id) !!}
                                        {!! Btn::delete($project->id,$project->trans('name')) !!}
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