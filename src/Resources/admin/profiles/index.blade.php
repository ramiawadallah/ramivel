@extends('layouts.backend')
@section('title') {{ trans('lang.profiles') }}  @endsection
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ trans('lang.profiles') }} 
                <span class="float-right">
                    {!! Btn::create() !!}
                </span>
            </h3>
        </div>

        <div class="block-content">
            @include('partials.message')
            <div class="table-responsive">
                <table id="datata" class="table table-bordered table-striped table-vcenter js-dataTable-buttons table-vcenter">
                    <thead>
                        <tr>
                            <th width="10">{!! bsForm::deleteAll() !!}</th>
                            <th>{{ trans('lang.title') }}</th>
                            <th>{{ trans('lang.photo') }}</th>
                            <th>{{ trans('lang.stutes') }}</th>
                            <th>{{ trans('lang.create-at') }}</th>
                            <th>{{ trans('lang.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td class="text-center">{!! bsForm::deleteSelect($profile->id) !!}</td>
                                <td>{{ $profile->trans('title') }}</td>
                                <td><img  src="{{ Storage::url($profile->photo) }}" style="max-width:50px;"></td>
                                <td>{{ $profile->trans('stutes') }}</td>
                                <td>{{ date('Y/m/d',strtotime($profile->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {!! Btn::view($profile->id) !!}
                                        {!! Btn::edit($profile->id) !!}
                                        {!! Btn::delete($profile->id,$profile->trans('name')) !!}
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