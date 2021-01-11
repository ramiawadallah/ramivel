<?php 

	$href = !empty($url) ? $url : url()->current().'/'.$id.'/edit';	

?>

@if(!empty($attr))
	
		<a href="{{ $href }}" class="btn btn-sm btn-light js-tooltip-enabled" 

		@foreach($attr as $key => $value)
		{{ $key }}="{{ $value }}" &nbsp

		@endforeach
		<i class="fa fa-fw fa-pencil-alt text-info"></i>
		</a>
@else
		<a href="{{ $href }}" title="{{ trans('lang.edit') }}" class="btn btn-sm btn-light js-tooltip-enabled" >
			<i class="fa fa-fw fa-pencil-alt text-info"></i>
		</a>
@endif
