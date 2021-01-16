@extends('layouts.backend')
@section('title') {{ __('Projects') }}  @endsection
@section('content')

@push('js')

    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        $(document).ready(function(){
            $('#filesupload').dropzone({
                url:"{{ aurl('upload/image/'.$project->id) }}",
                paramName: 'file',
                uploadMultiple: false,
                maxFiles:20,
                maxFilessize:20,
                resizeWidth: 3840/2,
                resizeHeight: 3840/2,
                acceptedFiles:'image/*',
                dictDefaultMessage:'{{ __('Drop files here to upload') }}',
                dictRemoveFile:'{{ __('Remove file') }}',
                params:{
                    _token:'{{ csrf_token() }}'
                },
                addRemoveLinks:true,
                removedfile:function(file){
                    //alert(file.fid);
                    $.ajax({
                        dataType:'json',
                        type: 'post',
                        url:'{{ aurl('delete/image') }}',
                        data:{_token:'{{ csrf_token() }}',id:file.fid},
                    });

                    var fmocK;
                    return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
                },
                init:function(){
                    @foreach($project->files()->get() as $file)
                        var mock = {name:'{{ $file->name }}',fid:'{{ $file->id }}',size:'{{ $file->size }}', type:'{{ $file->mime_type }}'};
                        this.emit('addedfile',mock);
                        this.options.thumbnail.call(this,mock,"{{ Storage::url($file->full_file) }}");
                    @endforeach

                    this.on('sending',function(file,xhr,formData){
                        formData.append('fid','');
                        file.fid = '';
                    });

                    this.on('success',function(file,response){
                        file.fid = response.id;
                    });
                }
            });
        });
    </script>

@endpush()

<div class="content">
    {!! bsForm::start(['route'=>['projects.update',$project->id],'files'=>true,'method'=>'put']) !!}
        @csrf
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Edit projects') }}</div>
                    <div class="block-content">
                        {!! bsForm::translate(function($form,$lang) use($project){
                            $form->text('title',$project->trans('title',$lang));
                            $form->textarea('content',$project->trans('content',$lang),['class'=>'form-control']);
                        }) !!}
                        {!! bsForm::uri('uri',$project->uri) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="block py-3">
                    <div class="block-header">{{ __('Options') }}</div>
                    <div class="block-content">
                        {!! bsForm::image('photo',$project->photo) !!}
                        <hr>
                        {!! bsForm::text('video',$project->video) !!}
                        <hr>
                        {!! bsForm::select('partner_id',['' => 'None'] + App\Models\Partner::all()->pluck('title', 'id')->toArray(), $project->partner_id)!!}
                        <hr>
                        {!! bsForm::radio('status',[
                                'active'=> __('Active'),
                                'not active'=> __('Not active'),
                            ],$project->status) 
                        !!}
                    </div>
                </div>
            </div>
        </div>
    {!! bsForm::end() !!}

    <div class="dropzone" id="filesupload"></div>
</div>

@endsection