@extends('layouts.backend')
@section('title') {{ trans('lang.posts') }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>'posts.store','enctype'=>'multipart/form-data']) !!}

        @csrf
        
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.create-new-posts') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form){
                            $form->text('title');
                            $form->textarea('content');
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
                        {!! bsForm::select('category_id',['' => 'None'] + App\Category::all()->pluck('title', 'id')->toArray(), null)!!}
                        <hr>
                        {!! bsForm::radio('status',[
                            'publish'=> trans('lang.publish'),
                            'hold'=> trans('lang.hold'),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! bsForm::end() !!}
</div>

@endsection