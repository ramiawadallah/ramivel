@extends('layouts.backend')
@section('title') {{ trans('lang.settings') }}  @endsection
@section('content')

<div class="content">
    @include('partials.message')
    {!! bsForm::start(['route'=>['settings.update',1],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.website-main-setting') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang){
                            $form->text('title',site('title',$lang));
                            $form->text('subtitle',site('subtitle',$lang));
                            $form->text('copyright',site('copyright',$lang));
                            $form->text('address',site('address',$lang));
                            $form->textarea('content',site('content',$lang));
                        }) !!}

                        {!! bsForm::text('mainvideo',site('mainvideo')) !!}

                        {!! bsForm::text('email',site('email')) !!}
                        
                        {!! bsForm::text('phone',site('phone')) !!}

                        {!! bsForm::text('fax',site('fax')) !!}

                        {!! bsForm::text('pobox',site('pobox')) !!}

                        {!! bsForm::text('map',site('map')) !!}

                        {!! bsForm::text('keywords',site('keywords')) !!}

                        {!! bsForm::text('facebook',site('facebook')) !!}

                        {!! bsForm::text('twitter',site('twitter')) !!}

                        {!! bsForm::text('linkedin',site('linkedin')) !!}

                        {!! bsForm::text('instagram',site('instagram')) !!}

                        {!! bsForm::text('youtube',site('youtube')) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('logo',$settings->logo) !!}
                        <hr>
                        {!! bsForm::radio('maintenance',[
                            'open'=> trans('lang.maintenance-open'),
                            'close'=> trans('lang.maintenance-close'),
                        ],$settings->maintenance) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection