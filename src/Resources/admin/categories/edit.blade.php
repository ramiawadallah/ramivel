@extends('layouts.backend')
@section('title') {{ trans('lang.categories') }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>['categories.update',$category->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.edit-categories') }}</div>
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
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$category->photo) !!}
                        <hr>
                        {!! bsForm::select('order', ['' => 'None' , 'before' => 'Before', 'after' => 'After', 'childOf' => 'Child Of'], null)!!}
                        <hr>
                        {!! bsForm::select('orderCategory',['' => 'None'] + $orderCategories->pluck('padded_title', 'id')->toArray(), null)!!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> trans('lang.active'),
                                'not active'=> trans('lang.not-active'),
                            ],$category->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection