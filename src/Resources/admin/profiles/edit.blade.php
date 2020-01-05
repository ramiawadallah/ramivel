@extends('layouts.backend')
@section('title') {{ trans('lang.profiles') }}  @endsection
@section('content')

<div class="content">
    @include('partials.message')
    {!! bsForm::start(['route'=>['profiles.update',$profile->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.edit-profiles') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($profile){
                            $form->text('title',$profile->trans('title',$lang));
                            $form->textarea('content',$profile->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri',$profile->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$profile->photo) !!}
                        <hr>
                        {!! bsForm::radio('stutes',[
                                'active'=> trans('lang.active'),
                                'not active'=> trans('lang.not-active'),
                            ],$profile->stutes) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection