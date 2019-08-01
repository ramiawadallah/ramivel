<?php 
if(!empty($name))
{
	$name = $name ;
}elseif(empty($name) && empty($options['name']))
{
	$name = trans('lang.thefield');
}elseif(!empty($options['name'])){
	$name =$options['name'];
}
	$options = !empty($options) ? $options :'';
	if (is_numeric($options))
	{
		$url = url()->current().'/'.$options;
	}elseif(is_array($options)){
		$url = isset($options['url']) ? $options['url'] : url()->current();
	}else{
		$url = url()->current();
	}
?>

@if(is_array($options))

	{{ Form::open(['url' => [$url], 'method' => 'DELETE']) }}
			<button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" onclick="return confirm('{{trans('lang.delete_msg',['var'=>$name])}}')"

				@foreach($options as $key => $value)
					@if ($key != 'url')
						{{ $key }}="{{ $value }}" &nbsp
					@endif
				@endforeach
				class="btn-default"

			>
	            <i class="fa fa-fw fa-times text-danger"></i>
	  
	{{Form::close()}}

	@else

	{{ Form::open(['url' => [$url], 'method' => 'DELETE']) }}
			<button type="submit" class="btn btn-sm btn-light js-tooltip-enabled" onclick="return confirm('{{trans('lang.delete_msg',['var'=>$name])}}')">
	            <i class="fa fa-fw fa-times text-danger"></i>
	        </div>
	{{Form::close()}}


@endif
