@extends('layouts.backend')
@section('title') {{ trans('lang.partners') }}  @endsection
@section('content')

<div class="content">
    
    {!! bsForm::start(['route'=>['partners.update',$partner->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.edit-partners') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($partner){
                            $form->text('title',$partner->trans('title',$lang));
                        }) !!}
                        {!! bsForm::uri('uri',$partner->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$partner->photo) !!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> trans('lang.active'),
                                'not active'=> trans('lang.not-active'),
                            ],$partner->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection