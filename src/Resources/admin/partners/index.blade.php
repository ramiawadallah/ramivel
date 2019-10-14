@extends('layouts.backend')
@section('title') {{ trans('lang.partners') }}  @endsection
@section('content')

<div class="content">
    <div class="block py-2">
        <div class="block-header">
            <h3 class="block-title">
                {{ trans('lang.partners') }} 
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
                            <th>{{ trans('lang.title') }}</th>
                            <th>{{ trans('lang.photo') }}</th>
                            <th>{{ trans('lang.stutes') }}</th>
                            <th>{{ trans('lang.create-at') }}</th>
                            <th>{{ trans('lang.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                            <tr>
                                <td>{{ $partner->trans('title') }}</td>
                                <td><img  src="{{ Storage::url($partner->photo) }}" style="max-width:50px;"></td>
                                <td>{{ $partner->trans('stutes') }}</td>
                                <td>{{ date('Y/m/d',strtotime($partner->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {!! Btn::view($partner->id) !!}
                                        {!! Btn::edit($partner->id) !!}
                                        {!! Btn::delete($partner->id,$partner->trans('name')) !!}
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