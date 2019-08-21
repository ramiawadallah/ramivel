@extends('layouts.backend')
@section('title') {{ trans('lang.settings') }}  @endsection
@section('content')

{!! bsForm::start(['route'=>['settings.update',1],'files'=>true,'method'=>'put']) !!}


<br>
<div class="row">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">
                    {{ trans('lang.website-main-setting') }}
                </h3>
            </div>
            <div class="block-content block-content-full">
                
                {!! bsForm::translate(function($form,$lang){
                    $form->text('title',site('title',$lang));
                    $form->text('subtitle',site('subtitle',$lang));
                    $form->text('copyright',site('copyright',$lang));
                    $form->text('address_jordan',site('address_jordan',$lang));
                    $form->text('address_sudan',site('address_sudan',$lang));
                    $form->textarea('desc',site('desc',$lang));
                }) !!}

                {!! bsForm::text('mainvideo',site('mainvideo')) !!}

                <div class="form-group">
                    <label class="alert alert-info">Jordan Information</label>
                </div>

                {!! bsForm::text('email_jordan',site('email_jordan')) !!}
                
                {!! bsForm::text('phone_jordan',site('phone_jordan')) !!}

                {!! bsForm::text('fax_jordan',site('fax_jordan')) !!}

                {!! bsForm::text('pobox_jordan',site('pobox_jordan')) !!}

                {!! bsForm::text('map_jordan',site('map_jordan')) !!}

                <hr>

                <div class="form-group">
                    <label class="alert alert-info">Sudan Information</label>
                </div>

                {!! bsForm::text('email_sudan',site('email_sudan')) !!}
                
                {!! bsForm::text('phone_sudan',site('phone_sudan')) !!}

                {!! bsForm::text('fax_sudan',site('fax_sudan')) !!}

                {!! bsForm::text('pobox_sudan',site('pobox_sudan')) !!}

                {!! bsForm::text('map_sudan',site('map_sudan')) !!}



                {!! bsForm::text('keywords',site('keywords')) !!}

                {!! bsForm::text('facebook',site('facebook')) !!}

                {!! bsForm::text('twitter',site('twitter')) !!}

                {!! bsForm::text('linkedin',site('linkedin')) !!}

                {!! bsForm::text('instagram',site('instagram')) !!}

                {!! bsForm::text('youtube',site('youtube')) !!}
                
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">{{ trans('lang.options') }}</h3>
            </div>
            <div class="block-content block-content-full">
                {!! bsForm::imageone('logo',$settings->logo) !!}
                {!! bsForm::imagetwo('image_one',$settings->image_one) !!}
                {!! bsForm::imagethree('image_two',$settings->image_two) !!}
                <hr>
                {!! bsForm::radio('maintenance',[
                    'open'=> trans('lang.maintenance-open'),
                    'close'=> trans('lang.maintenance-close'),
                ],$settings->maintenance) !!}
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}


@endsection