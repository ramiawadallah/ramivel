
<?php
	$attributes = !empty($attributes) ? $attributes : [];
	$values = isset($value) ? $value : '';
   $style = isset($attributes['style']) ? $attributes['style'] : 'inline';
?>

<!-- <div class="demo-radio-button {{ $errors->has($name) ? ' has-error' : '' }}">
	<label>{{ trans('lang.'.$name) }}</label>
	<br>
	@foreach ($options as $value => $label)
		
		<input name="{{ $name }}"  value="{{ $value }}"  type="radio" id="{{ $value }}" class="radio-col-red" @if($value == $values) checked @endif />
		<label for="{{ $value }}">{{ $label }}</label>

	@endforeach
</div>
 -->
@foreach ($options as $value => $label)
<div class="custom-control custom-radio custom-control-inline">
	
    	<input type="radio" id="{{ $value }}" name="{{ $name }}"  value="{{ $value }}" class="custom-control-input" @if($value == $values) checked @endif>
    	<label class="custom-control-label m-0" for="{{ $value }}">{{ $label }}</label>
    
</div>
@endforeach