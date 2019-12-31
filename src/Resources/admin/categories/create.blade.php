@extends('layouts.backend')
@section('title') {{ trans('lang.categories') }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>'categories.store','enctype'=>'multipart/form-data']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.create-new-categories') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form){
                            $form->text('title');
                        }) !!}
                        {!! bsForm::uri('uri') !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo') !!}
                        <hr>
                        {!! bsForm::select('order', ['' => 'None' , 'before' => 'Before', 'after' => 'After', 'childOf' => 'Child Of'], null)!!}
                        <hr>
                        {!! bsForm::select('orderCategory',['' => 'None'] + $orderCategories->pluck('padded_title', 'id')->toArray(), null)!!}
                        <hr>
                        {!! bsForm::radio('status',[
                            'active'=> trans('lang.active'),
                            'not active'=> trans('lang.not-active'),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection