
<?php
	$attributes = !empty($attributes) ? $attributes : [];
	$value = !empty($value) ? $value : old($name);
?>



<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
   <label for="{{ $name }}" class="control-label">{{ trans('lang.'.$name) }}</label>
<div class="input-icon right">   
   @if($errors->has($name))
	<i class="fa fa-warning tooltips" data-original-title="{{ $errors->first($name) }}"></i>
   @endif
<div class="input-group">
                <span class="input-group-addon">
                    <i class="icon-clock"></i>
                </span>
   {!! Form::time($name,$value,array_merge([
   	'class'=>'form-control',
   	'placeholder' => trans('lang.'.$name)
   	],$attributes)) !!}
   
</div>
</div>
</div>