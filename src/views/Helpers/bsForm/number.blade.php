
<?php
	$attributes = !empty($attributes) ? $attributes : [];
	$value = !empty($value) ? $value : old($name);
?>



<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
   <label for="{{ $name }}" class="control-label">{{ __(ucfirst($name)) }}</label>
<div class="input-icon right">   
   @if($errors->has($name))
	<i class="fa fa-warning tooltips" data-original-title="{{ $errors->first($name) }}"></i>
   @endif
   {!! Form::number($name,$value,array_merge([
   	'class'=>'form-control',
   	'placeholder' => __(ucfirst($name))
   	],$attributes)) !!}
   
</div>
</div>