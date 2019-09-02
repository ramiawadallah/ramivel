@extends('layouts.backend')
@section('title') {{ trans('lang.languages') }}  @endsection
@section('content')

{!! bsForm::start(['route'=>['langs.update',$lang->id],'files'=>true,'method'=>'put']) !!}

<br>
<div class="row">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">
                    {{ trans('lang.edit-language') }}
                </h3>
            </div>
            <div class="block-content block-content-full">
                
                {!!bsForm::text('name',$lang->name) !!}
                {!!bsForm::text('code',$lang->code) !!}
                
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">{{ trans('lang.options') }}</h3>
            </div>
            <div class="block-content block-content-full">
                {!! bsForm::radio('direction',[
                    'ltr'=> trans('lang.ltr'),
                    'rtl'=> trans('lang.rtl'),
                ],$lang->direction) !!}

                <br><br>

                <div class="form-group">
                    <div class="form-check">
                        <label for="checkbox" class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1" name="default" id="checkbox" @if($lang->default == 1) checked @endif()>
                            {{ trans('lang.default_lang') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection