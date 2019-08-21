@extends('layouts.backend')
@section('title') {{ trans('lang.pages') }}  @endsection
@section('content')

{!! bsForm::start(['route'=>'pages.store','files'=>true]) !!}

<br>
<div class="row">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">
                    {{ trans('lang.create-new-page') }}
                </h3>
            </div>
            <div class="block-content block-content-full">
                
                {!! bsForm::translate(function($form){
                    $form->text('title');
                    $form->textarea('content',null,['class'=>'form-control','id'=>'editor']);
                }) !!}

                {!! bsForm::uri('uri') !!}
                
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
                {!! bsForm::image('photo') !!}

                {!! bsForm::radio('stutes',[
                    'active'=> trans('lang.active'),
                    'not active'=> trans('lang.not-active')
                ],true) !!}
                <hr>
                {!! bsForm::select('template',$templates, null)!!}
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


