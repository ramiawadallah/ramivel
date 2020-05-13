@extends('layouts.backend')
@section('title') {{ trans('lang.settings') }}  @endsection
@section('content')

<div class="content">
    {!! bsForm::start(['route'=>['settings.update',1],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ trans('lang.website-main-setting') }}</div>
                    <div class="block-content">

                        {!! bsForm::text('title',$settings->title) !!}

                        {!! bsForm::text('subtitle',$settings->subtitle) !!}

                        {!! bsForm::text('address',$settings->address) !!}

                        {!! bsForm::text('copyright',$settings->copyright) !!}

                        {!! bsForm::textarea('content',$settings->content) !!}

                        {!! bsForm::text('mainvideo',$settings->mainvideo) !!}

                        {!! bsForm::text('email',$settings->email) !!}
                        
                        {!! bsForm::text('phone',$settings->phone) !!}

                        {!! bsForm::text('fax',$settings->fax)!!}

                        {!! bsForm::text('pobox',$settings->pobox) !!}

                        {!! bsForm::text('map',$settings->map) !!}

                        {!! bsForm::text('keywords',$settings->keywords) !!}

                        {!! bsForm::text('facebook',$settings->facebook) !!}

                        {!! bsForm::text('twitter',$settings->twitter) !!}

                        {!! bsForm::text('linkedin',$settings->linkedin) !!}

                        {!! bsForm::text('instagram',$settings->instagram)!!}

                        {!! bsForm::text('youtube',$settings->youtube)!!}
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
                            'open'=> trans('lang.open'),
                            'close'=> trans('lang.close'),
                        ],$settings->maintenance) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}
</div>

@endsection