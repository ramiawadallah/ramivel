@extends('layouts.backend')
@section('title') {{ trans('lang.sliders') }}  @endsection
@section('content')

<div class="content">
    
    {!! bsForm::start(['route'=>['sliders.update',$slider->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.edit-sliders') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($slider){
                            $form->text('title',$slider->trans('title',$lang));
                        }) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$slider->photo) !!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> trans('lang.active'),
                                'not active'=> trans('lang.not-active'),
                            ],$slider->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection