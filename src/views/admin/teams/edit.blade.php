@extends('layouts.backend')
@section('title') {{ __('Team edit' ) }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>['teams.update',$team->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Team edit' ) }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($team){
                            $form->text('name',$team->trans('name',$lang));
                            $form->text('title',$team->trans('title',$lang));
                            $form->textarea('content',$team->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri',$team->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$team->photo) !!}
                        <hr>
                        {!! bsForm::image('cover',$team->cover) !!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> __('Active'),
                                'not active'=> __('Not-active'),
                            ],$team->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection