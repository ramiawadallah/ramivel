@extends('layouts.backend')
@section('title') {{ __('Partner edit' ) }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>['partners.update',$partner->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Partner edit' ) }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($partner){
                            $form->text('title',$partner->trans('title',$lang));
                            $form->textarea('content',$partner->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri',$partner->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$partner->photo) !!}
                        <hr>
                        {!! bsForm::text('link',$partner->link) !!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> __('Active'),
                                'not active'=> __('Not-active'),
                            ],$partner->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection