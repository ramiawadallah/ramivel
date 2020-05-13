@extends('layouts.backend')
@section('title') {{ trans('lang.categories') }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>'categories.store','enctype'=>'multipart/form-data']) !!}

        @csrf
        
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.create-new-categories') }}</div>
                    <div class="block-content">
                        {!! bsForm::text('title') !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo') !!}
                    </div>
                </div>
            </div>
        </div>
        {!! bsForm::end() !!}
</div>

@endsection