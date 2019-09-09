@extends('layouts.backend')
@section('title') {{ trans('lang.pages') }}  @endsection
@section('content')

<div class="content">
    @include('partials.message')
    {!! bsForm::start(['route'=>['pages.update',$page->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.edit-pages') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($page){
                            $form->text('title',$page->trans('title',$lang));
                            $form->textarea('content',$page->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri',$page->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$page->photo) !!}
                        <hr>
                        {!! bsForm::select('template',$templates, null)!!}
                        <hr>
                        {!! bsForm::select('order', ['' => 'None' , 'before' => 'Before', 'after' => 'After', 'childOf' => 'Child Of'], null)!!}
                        <hr>
                        {!! bsForm::select('orderPage',['' => 'None'] + $orderPages->pluck('padded_title', 'id')->toArray(), null)!!}
                        <hr>
                        {!! bsForm::radio('stutes',[
                                'active'=> trans('lang.active'),
                                'not active'=> trans('lang.not-active'),
                            ],$page->stutes) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection