@extends('layouts.backend')
@section('title') {{ trans('lang.pages') }}  @endsection
@section('content')


{!! bsForm::start(['route'=>['pages.update',$page->id],'files'=>true,'method'=>'put']) !!}

<br>
<div class="row">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">
                    {{ trans('lang.edit-page') }}
                </h3>
            </div>
            <div class="block-content block-content-full">
                
                {!! bsForm::translate(function($form,$lang) use($page){

                $form->text('title',$page->trans('title',$lang));
                $form->textarea('content',$page->trans('content',$lang),['class'=>'form-control','id'=>'editor']);

                }) !!}

                {!! bsForm::uri('uri',$page->uri) !!}
                
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">{{ trans('lang.options') }}</h3>
            </div>
            <div class="block-content block-content-full">
                <small>Image size 1920 X 500</small>
                {!! bsForm::image('photo',$page->photo) !!}

                {!! bsForm::radio('stutes',[
                    'active'=> trans('lang.active'),
                    'not active'=> trans('lang.not-active'),
                ],$page->stutes) !!}
                <hr>
                {!! bsForm::select('template',$templates, $page->template)!!}
                <br>    
                {!! bsForm::select('order', ['' => 'None' , 'before' => 'Before', 'after' => 'After', 'childOf' => 'Child Of'], null)!!}
                <br>
                {!! bsForm::select('orderPage',['' => 'None'] + $orderPages->pluck('padded_title', 'id')->toArray(), null)!!}
            </div>
        </div>
    </div>
</div>


{!! bsForm::end() !!}

@endsection