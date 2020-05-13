<?php 

	$href = !empty($url) ? $url : url()->current().'/create';
?>

@if(!empty($attr))

	<a href="{{ $href }}" class="btn btn-sm btn-success"

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp
	@endforeach

	>
	<i class="fa fa-plus"></i>
	</a>

@else
	<a href="{{ $href }}" class="btn btn-sm btn-success">
	<i class="fa fa-plus"></i>
	{{ trans('lang.create')}}
	</a>

@endif

