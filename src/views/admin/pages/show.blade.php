@extends('layouts.backend')
@section('title') {{ __('Page view' ) }}  @endsection
@section('content')
    <div class="content">
        <div class="block py-3">
            <div class="block-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="block py-3">
                            <h1>{!! $page->trans('title') !!}</h1>
                            {!! $page->trans('content') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
@endsection