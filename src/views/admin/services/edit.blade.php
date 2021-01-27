@extends('layouts.backend')
@section('title') {{ __('Services') }}  @endsection
@section('content')

<div class="content">
    
    {!! bsForm::start(['route'=>['services.update',$service->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Edit services') }}</div>
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
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$service->photo) !!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> __('Active'),
                                'not active'=> __('Not active'),
                            ],$service->status) 
                        !!}
                        <hr>
                        {!! bsForm::radio('show_more',[
                                'yes'=> __('Yes'),
                                'no'=> __('No'),
                            ],$service->show_more) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection