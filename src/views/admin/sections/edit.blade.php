@extends('layouts.backend')
@section('title') {{ __('Section edit' ) }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>['sections.update',$section->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Section edit' ) }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($section){
                            $form->text('title',$section->trans('title',$lang));
                            $form->text('subtitle',$section->trans('subtitle',$lang));
                            $form->textarea('content',$section->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$section->photo) !!}
                        <hr>
                        {!! bsForm::select('page_id',['' => 'None'] + App\Models\Page::where('status','active')->pluck('title', 'id')->toArray(), $section->page_id )!!}
                        <hr>
                        {!! bsForm::select('type',['' => 'None' , 'Post' => 'Post', 'Service' => 'Service', 'Partner' => 'Client', 'Project' => 'Project','Service' => 'Service' ,'Parallax' => 'Parallax'] , $section->type )!!}
                        <hr>
                        {!! bsForm::radio('status',[
                            'active'=> __('Active'),
                            'not active'=> __('Not-active'),
                        ], $section->status) !!}
                        <hr>
                        <label>Order Section</label>
                        <br>
                        {!! bsForm::radio('order',[
                            '1'=> __('1'),
                            '2'=> __('2'),
                            '3'=> __('3'),
                            '4'=> __('4'),
                            '5'=> __('5'),
                        ], $section->order) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection