@extends('layouts.backend')
@section('title') {{ trans('lang.sliders') }}  @endsection
@section('content')
    <div class="content">
        <div class="block py-3">
            <div class="block-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="block py-3">
                            <h1>{!! $slider->trans('title') !!}</h1>
                            {!! $slider->trans('content') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
@endsection