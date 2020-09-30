@if (session()->has('message') || session()->has('status'))

	<div id="myToast" class="toast">
	    <div class="toast-header bg-success text-white">
	      <strong class="mr-auto">{{__('Success')}}</strong>
	      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">×</button>
	    </div>
	    <div class="toast-body">
	    	{{ session()->get('message') }} 
	    </div>
	</div>

@endif


@if ($errors->count() > 0)
    @foreach ($errors->all() as $error)
		<div id="myToast" class="toast" style="position: absolute; top: 10px; right: 10px; z-index: 99999">
		    <div class="toast-header bg-danger text-white">
		      <strong class="mr-auto ">{{__('Erorr')}}</strong>
		      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">×</button>
		    </div>
		    <div class="toast-body">
		    	<ul class="list-group list-group-flush">
			    	@foreach ($errors->all() as $error)
						  <li class="list-group-item">{{ $error }}</li>
				    @endforeach
				</ul>
		    </div>
		</div>
    @endforeach
@endif