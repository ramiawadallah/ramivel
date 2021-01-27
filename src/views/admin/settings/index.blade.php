@extends('layouts.backend') 
@section('content')
    <form action="{{ route('admin.settings.update', $setting->id) }}" method="post" enctype="multipart/form-data">
        @csrf @method('patch')
        <div class="content">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="block py-3">
                        <div class="block-header">{{ __('Application settings') }} </div>
                        <div class="block-content">
                            <form action="{{ route('admin.settings.update', $setting->id) }}" method="post">
                            @csrf @method('patch')
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" value="{{ $setting->title }}" name="title" class="form-control" id="title">
                            </div>

                            <div class="form-group">
                                <label for="subtitle">{{ __('Sub title') }}</label>
                                <input type="text" value="{{ $setting->subtitle }}" name="subtitle" class="form-control" id="subtitle">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="text" value="{{ $setting->email }}" name="email" class="form-control" id="email">
                            </div>

                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" value="{{ $setting->phone }}" name="phone" class="form-control" id="phone">
                            </div>

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" value="{{ $setting->address }}" name="address" class="form-control" id="address">
                            </div>

                            <div class="form-group">
                                <label for="fax">{{ __('Fax') }}</label>
                                <input type="text" value="{{ $setting->fax }}" name="fax" class="form-control" id="fax">
                            </div>

                            <div class="form-group">
                                <label for="pobox">{{ __('Pobox') }}</label>
                                <input type="text" value="{{ $setting->pobox }}" name="pobox" class="form-control" id="pobox">
                            </div>

                            <div class="form-group">
                                <label for="map">{{ __('Map') }}</label>
                                <input type="text" value="{{ $setting->map }}" name="map" class="form-control" id="map">
                            </div>

                            <div class="form-group">
                                <label for="keywords">{{ __('Keywords') }}</label>
                                <input type="text" value="{{ $setting->keywords }}" name="keywords" class="form-control" id="keywords">
                            </div>

                            <div class="form-group">
                                <label for="copyright">{{ __('Copyright') }}</label>
                                <input type="text" value="{{ $setting->copyright }}" name="copyright" class="form-control" id="copyright">
                            </div>

                            <div class="form-group">
                                <label for="facebook">{{ __('Facebook') }}</label>
                                <input type="text" value="{{ $setting->facebook }}" name="facebook" class="form-control" id="facebook">
                            </div>

                            <div class="form-group">
                                <label for="twitter">{{ __('Twitter') }}</label>
                                <input type="text" value="{{ $setting->twitter }}" name="twitter" class="form-control" id="twitter">
                            </div>

                            <div class="form-group">
                                <label for="instagram">{{ __('Instagram') }}</label>
                                <input type="text" value="{{ $setting->instagram }}" name="instagram" class="form-control" id="instagram">
                            </div>

                            <div class="form-group">
                                <label for="linkedin">{{ __('Linkedin') }}</label>
                                <input type="text" value="{{ $setting->linkedin }}" name="linkedin" class="form-control" id="linkedin">
                            </div>

                            <div class="form-group">
                                <label for="youtube">{{ __('Youtube') }}</label>
                                <input type="text" value="{{ $setting->youtube }}" name="youtube" class="form-control" id="youtube">
                            </div>

                            <div class="form-group">
                                <label for="content">{{ __('Content') }}</label>
                                <input type="text" value="{{ $setting->content }}" name="content" class="form-control" id="content">
                            </div>

                        </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="block py-3">
                        <div class="block-header mb-3">{{ __('Application Logo') }}   </div>

                        <div class="box m-auto">
                            <div class="js--image-preview" style="background-image: url({{ Storage::url($setting->logo) }});">
                            </div>
                            <div class="upload-options">
                              <label>
                                <i class="far fa-edit icon-fa"></i>
                                <input type="file" name="logo" class="image-upload" accept="image/*" />
                              </label>
                            </div>
                        </div>

                        <hr/>

                        <div class="block-header mb-3">{{ __('Application Icon') }}   </div>

                        <div class="box m-auto">
                            <div class="js--image-preview" style="background-image: url({{ Storage::url($setting->icon) }});">
                                
                            </div>
                            <div class="upload-options">
                              <label>
                                <i class="far fa-edit icon-fa"></i>
                                <input type="file" name="icon" class="image-upload" accept="image/*" />
                              </label>
                            </div>
                        </div>

                        <hr/>
                            <div class="col-md-12"> 
                                {!! bsForm::file('mainvideo', $setting->mainvideo) !!}
                            </div>
                        <hr/>

                        <div class="form-group col-md-12 ml-2 mt-3">
                            <label class="d-block">{{ __('Maintenance') }}</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="example-radio-custom-inline2" value="open" name="maintenance" @if($setting->maintenance == 'open') checked @endif>
                                <label class="custom-control-label" for="example-radio-custom-inline2">Open</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="example-radio-custom-inline3" value="close" name="maintenance" @if($setting->maintenance == 'close') checked @endif>
                                <label class="custom-control-label" for="example-radio-custom-inline3">Close</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-12 mb-3">
                    <button type="submit" class="btn btn-dark btn-sm">{{ __('Change') }}</button>
                </div>
            </div>
        </div>
    </form>


@endsection