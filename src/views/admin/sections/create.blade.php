@extends('layouts.backend')
@section('title') {{ __('Section create' ) }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>'sections.store','enctype'=>'multipart/form-data']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Section create' ) }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form){
                            $form->text('title');
                            $form->text('subtitle');
                            $form->textarea('content',null,['class'=>'form-control']);
                        }) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo') !!}
                        <hr>
                        {!! bsForm::select('page_id',['' => 'None'] + App\Models\Page::where('status','active')->pluck('title', 'id')->toArray(), null)!!}
                        <hr>
                        {!! bsForm::select('type',['' => 'None' , 'Post' => 'Post', 'Service' => 'Service', 'Partner' => 'Client', 'Project' => 'Project','Service'  => 'Service','Team' => 'Team','Parallax' => 'Parallax'] , null)!!}
                        <hr>
                        {!! bsForm::radio('status',[
                            'acti__('Active'),
                            'not acti__('Active'),
                        ]) !!}
                        <hr>
                        <label>Order Section</label>
                        <br>
                        {!! bsForm::radio('order',[
                            '1'=> __('1'),
                            '2'=> __('2'),
                            '3'=> __('3'),
                            '4'=> __('4'),
                            '5'=> __('5'),
                        ]) !!}
                        <hr>
                        <label>Publish Content</label>
                        <br>
                        {!! bsForm::select('content_publish',[
                            '1'=> __('Active'),
                            '0'=> __('Not Active'),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection