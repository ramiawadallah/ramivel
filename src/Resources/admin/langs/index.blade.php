@extends('layouts.backend')
@section('title') {{ trans('lang.languages') }}  @endsection
@section('content')

<div class="col-lg-12">
    <div class="block block-mode-loading-oneui">
        <div class="block-header border-bottom">
            {{ trans('lang.languages') }} 
            <hr>
            {!! Btn::create() !!} 
        </div>
        <div class="block-content block-content-full">
               
                <table id="example-with-json-button" class="table table-hover table-vcenter js-dataTable-buttons" data-options='{"searching":true}'>
                    <thead>
                        <tr>
                            <th>{{ trans('lang.name') }}</th>
                            <th>{{ trans('lang.created_at') }}</th>
                            <th>{{ trans('lang.trans_files')}}</th>
                            <th>{{ trans('lang.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach(\App\Lang::all() as $language)
                            <tr>
                                
                                 <td>{{ $language->trans('name') }}</td>
                                 <td>{{ date('Y/m/d',strtotime($language->created_at)) }}</td>
                                 <td>
                                    <a class="btn btn-primary" data-toggle="modal" href='#modal-files-{{ $language->id }}'>{{ trans('lang.trans_files') }}</a>      
                                    <div class="modal fade" id="modal-files-{{ $language->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="align-self-center">
                                                        <h5>{{ trans('lang.trans_files')}}</h5>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- start -->
                                                        <div class="card no-b">
                                                            <div class="card-header white pb-0">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="align-self-center">
                                                                        <ul class="nav nav-pills mb-3" role="tablist">
                                                                            @foreach (langFiles($language->code) as $key => $file)
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }} show r-20" id="w3--{{ $key }}-{{ $language->id }}" data-toggle="tab" href="#w3-{{ $key }}-{{ $language->id }}" role="tab" aria-controls="{{ $key }}-{{ $language->id }}" aria-expanded="true" aria-selected="true">{{ ucfirst(explode('.', $file['name'])[0]) }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="card-body no-p">
                                                                <div class="tab-content">
                                                                    @foreach (langFiles($language->code) as $key => $file)
                                                                        <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}" id="w3-{{ $key }}-{{ $language->id }}" role="tabpanel" aria-labelledby="w3-{{ $key }}-{{ $language->id }}">
                                                                            
                                                                               {!! Form::open(['route' => 'update_file']) !!}

                                                                                    <div file="{{ $file['name'] }}"  dir="" lang-id="{{ $language->id }}">

                                                                                        {{-- <textarea name="content[]" file="{{ $file['name'] }}" lang-id="{{ $language->id }}" class="content form-control" id="" cols="30" rows="20"> --}}
                                                                                        <?php
                                                                                        // $content = file_get_contents($file['path']);
                                                                                        $content = @ include $file['path'];
                                                                                        ?>
                                                                                        {{-- </textarea> --}}
                                                                                            <div class="alert" style="height:400px;overflow: auto; width: 100%; " dir="rtl">
                                                                                                @foreach ($content as $k => $v)
                                                                                                    @if (!is_array($v))
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <div class="form-line">
                                                                                                                    <input id="name" value="{{ $v }}" class="form-control" placeholder="Title" name="content_{{ $file['name'] }}[]" type="text">
                                                                                                                    <input type="hidden" name="keys_{{ $file['name'] }}[]" class="form-control" value="{{ $k }}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-6">
                                                                                                            <button class="btn bg-blue-grey btn-lg btn-block" type="button">{{ $k }}</button>
                                                                                                        </div>                                                                                                           
                                                                                                    </div>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                                <div class="clearfix"></div>
                                                                                            </div>

                                                                                            <input type="hidden" name="fileName[]" value="{{ $file['name'] }}">
                                                                                            <input type="hidden" name="lang" value="{{ $language->id }}">
                                                                                    
                                                                                    </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <!-- end -->


                                                </div>


                                            <div class="modal-footer">
                                                     <div class="col-xs-12">
                                                        <button type="lang_files_submit" class="btn btn-warning left">
                                                            <i class="icon-save"></i>
                                                            <span> {{ trans('lang.save') }}</span>
                                                        </button>

                                                        <button type="lang_files_submit" class="btn btn-danger right" data-dismiss="modal">
                                                            <i class="icon-close"></i>
                                                            <span> {{ trans('lang.close') }}</span>
                                                        </button>
                                                    </div>
                                            </div>

                                              {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>

                                 </td>
                                 <td>
                                     {!! Btn::view($language->id) !!}
                                     {!! Btn::edit($language->id) !!}
                                     {!! Btn::delete($language->id,$language->trans('name')) !!}
                                 </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>




@endsection