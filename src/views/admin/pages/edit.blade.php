@extends('layouts.backend')
@section('title') {{ __('Page edit' ) }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>['pages.update',$page->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Page edit' ) }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($page){
                            $form->text('title',$page->trans('title',$lang));
                            $form->text('subtitle',$page->trans('subtitle',$lang));
                            $form->textarea('content',$page->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri',$page->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$page->photo) !!}
                        <hr>
                        {!! bsForm::file('video',$page->video) !!}
                        <hr>
                        {!! bsForm::radio('type',[
                                'photo'=> __('Photo'),
                                'video'=> __('Video'),
                            ],$page->type) 
                        !!}
                        <hr>
                        {!! bsForm::select('template',$templates, $page->template)!!}
                        <hr>
                        {!! bsForm::select('order', ['' => 'None' , 'before' => 'Before', 'after' => 'After', 'childOf' => 'Child Of'], null)!!}
                        <hr>
                        {!! bsForm::select('orderPage',['' => 'None'] + $orderPages->pluck('padded_title', 'id')->toArray(), null)!!}                        
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> __('Active'),
                                'not active'=> __('Not-active'),
                            ],$page->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection