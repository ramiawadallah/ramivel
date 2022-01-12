@extends('layouts.backend') 
@section('content')
	
<div class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="block py-3">
                <div class="block-header">{{ __('Your media uplodet') }} </div>
                <div class="block-content">
                	<div class="row gutters-tiny items-push js-gallery push js-gallery-enabled">
	                	@foreach($medias as $media)
							<div class="col-sm-3 animated fadeIn">
						        <div class="options-container fx-item-rotate-r">
						            <img class="img-fluid options-item" style="background-size: cover; height: 15	0px; width: 100%" src="{{ $media->getUrl('thumb') }}" alt="{{ $media->name }}" >
						            <div class="options-overlay bg-black-75">
						                <div class="options-overlay-content">

						                    <h3 class="h4 font-w400 text-white mb-1">
						                    	 {{ $media->name }}
						                    </h3>

						                    <h4 class="h6 font-w400 text-white-75 mb-3">{{ $media->collection_name }}</h4>

						                    <a class="btn btn-sm btn-primary img-lightbox test-popup-link icon-image" href="{{ $media->getUrl() }}" data-toggle="tooltip" data-placement="top" title="Show this image" >
						                        <i class="fa fa-eye"></i>
						                    </a>

						                    <a class="btn btn-sm btn-secondary icon-image"  href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Use this image as avatar" onclick="event.preventDefault(); document.getElementById('selcteForm{{ $media->id }}').submit();">
						                        <i class="fa fa-check-circle"></i>
						                    </a>
						               

						                    <a class="btn btn-sm btn-warning text-white icon-image" href="javascript:void(0)" onclick="myFunction{{$media->id}}()" data-toggle="tooltip" data-placement="top" title="Copy image path" >
						                        <i class="fa fa-copy"></i>
						                    </a>

						                    <script>
						                    	function myFunction{{$media->id}}() {
												  var copyText = document.getElementById("copyUrl{{$media->id}}");
												  copyText.select();
												  copyText.setSelectionRange(0, 99999)
												  document.execCommand("copy");
												  alert("Copied the text: " + copyText.value);
												}
						                    </script>

						                    <form action="{{ route('admin.media.updateavatar',auth()->user()->id) }}" style="display:none;" id="selcteForm{{ $media->id }}" method="post">
						                    	@csrf
						                    	<input type="submit" type="hidden">
						                    	<input type="hidden" name="SelectedAvatar" value="{{ $media->id }}">
						                    </form>

						                    <a class="btn btn-sm btn-info icon-image" href="{{ $media->getUrl() }}" download="{{ $media->getUrl() }}" data-toggle="tooltip" data-placement="top" title="Download this image" >
						                        <i class="fa fa-cloud-download-alt"></i>
						                    </a>

						                    <a class="btn btn-sm btn-danger text-white icon-image" href="javascript:void(0)" onclick="event.preventDefault();
			                                        document.getElementById('destroyForm{{ $media->id }}').submit();" data-toggle="tooltip" data-placement="top" title="Delete this image">
						                        <i class="fa fa-ban"></i>
						                    </a>
						                    <form action="{{ route('admin.media.destroyavatar',$media->id) }}" style="display:none;" id="destroyForm{{ $media->id }}" method="POST">
						                    	@csrf @method('delete')
						                    	<input type="submit" type="hidden">
						                    	<input type="hidden" name="SelectedMediaAvatar" value="{{ $media->id }}">
						                    </form>

						                   	<div><input style="font-size: .7em;" type="text" value="{{ $media->getUrl() }}" id="copyUrl{{$media->id}}"></div>

						                </div>
						            </div>
						        </div>
						    </div>
					    @endforeach
					</div>
			</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-12">
	        <div class="block py-3">
	        	<form action="{{ route('admin.media.store') }}" method="post" enctype="multipart/form-data">
				@csrf
	                <div class="block-header mb-3">{{ __('Upload photo') }}   </div>

	                <div class="box m-auto">
	                    <div class="js--image-preview"></div>
	                    <div class="upload-options">
	                      <label>
	                        <i class="far fa-edit icon-fa"></i>
	                        <input type="file" name="media" class="image-upload" accept="image/*" required=""/>
	                      </label>
	                    </div>
	                </div>

	                <div class="col-sm-12 mt-3 ml-auto">
			            <button type="submit" class="btn btn-dark btn-sm">{{ __('Upload') }}</button>
			        </div>
			    </form>
	        </div>
	    </div>
	</div>
</div>
	
@endsection