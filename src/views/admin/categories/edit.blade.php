@extends('layouts.backend')
@section('title') {{ __('Category edit' ) }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>['categories.update',$category->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Category edit' ) }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($category){
                            $form->text('title',$category->trans('title',$lang));
                        }) !!}
                        {!! bsForm::uri('uri',$category->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$category->photo) !!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> __('Active'),
                                'not active'=> __('Not-active'),
                            ],$category->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection