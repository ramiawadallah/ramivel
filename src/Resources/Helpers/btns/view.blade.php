<?php 

	$href = !empty($url) ? $url : url()->current().'/'.$id;

		

?>
@if(!empty($attr))
		<a href="{{ $href }}" class="btn btn-sm btn-light js-tooltip-enabled" 
			@foreach($attr as $key => $value)
			{{ $key }}="{{ $value }}" &nbsp

			@endforeach

			class="btn btn-info btn-sm btn-icon icon-left"
			>
			<i class="far fa-eye"></i>
		</a>
@else
		<a href="{{ $href }}"  class="btn btn-sm btn-light js-tooltip-enabled">
		    <i class="far fa-eye"></i>
		</a>

@endif
