@extends('layouts.backend')
@section('title') {{ __('Sliders') }}  @endsection
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ __('Sliders') }} 
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
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{ $slider->trans('title') }}</td>
                                <td><img  src="{{ media($slider->photo) }}" style="max-width:50px;"></td>
                                <td>{{ $slider->trans('status') }}</td>
                                <td>{{ date('Y/m/d',strtotime($slider->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {!! Btn::view($slider->id) !!}
                                        {!! Btn::edit($slider->id) !!}
                                        {!! Btn::delete($slider->id,$slider->trans('name')) !!}
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