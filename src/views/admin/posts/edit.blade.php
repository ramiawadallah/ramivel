@extends('layouts.backend')
@section('title') {{ __('Post edit' ) }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>['posts.update',$post->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Post edit' ) }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($post){
                            $form->text('title',$post->trans('title',$lang));
                            $form->textarea('content',$post->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri',$post->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$post->photo) !!}
                        <hr>
                        {!! bsForm::select('category_id',['' => 'None'] + App\Models\Category::all()->pluck('title', 'id')->toArray(), $post->category_id)!!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> __('Active'),
                                'not active'=> __('Not-active'),
                            ],$post->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection