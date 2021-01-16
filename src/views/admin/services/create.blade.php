@extends('layouts.backend')
@section('title') {{ __('Services') }}  @endsection
@section('content')

<div class="content">
    
    {!! bsForm::start(['route'=>'services.store','enctype'=>'multipart/form-data']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Create services') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form){
                            $form->text('title');
                            $form->textarea('content',null,['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri') !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo') !!}
                        <hr>
                        {!! bsForm::radio('status',[
                            'active'=> trans('lang.active'),
                            'not active'=> trans('lang.not-active'),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection