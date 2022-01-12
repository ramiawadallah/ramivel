<?php 

	$href = !empty($url) ? $url : url()->current().'/create';
?>

@if(!empty($attr))
	
	<span class="float-right">
		<a href="{{ $href }}" class="btn btn-sm btn-dark">
			@foreach($attr as $key => $value)
				{{ $key }}="{{ $value }}" &nbsp
			@endforeach
			<i class="fa fa-plus"></i>
		</a>
	</span>

@else
	<span class="float-right">
		<a href="{{ $href }}" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i></a>
	</span>

@endif



