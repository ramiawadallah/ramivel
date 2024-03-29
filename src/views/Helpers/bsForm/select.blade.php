
<?php
   $attributes = !empty($attributes) ? $attributes : [];
	$options = !empty($options) ? $options : [];
	$value = !empty($value) ? $value : old($name);
?>

<div class="{{ $errors->has($name) ? ' has-error' : '' }}">
   <p>
       <b>{{ __(ucfirst(str_replace('_id','',trim($name,'[]')))) }}</b>
   </p>
   {!! Form::select($name,$options,$value,array_merge([
      'class'=>'form-control show-tick',
      'data-show-subtext' => 'true'
      ],$attributes)) !!}
</div>