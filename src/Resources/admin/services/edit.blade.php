@extends('layouts.backend')
@section('title') {{ trans('lang.services') }}  @endsection
@section('content')

<div class="content">
    
    {!! bsForm::start(['route'=>['services.update',$service->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.edit-services') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($service){
                            $form->text('title',$service->trans('title',$lang));
                            $form->textarea('content',$service->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri',$service->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$service->photo) !!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> trans('lang.active'),
                                'not active'=> trans('lang.not-active'),
                            ],$service->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection