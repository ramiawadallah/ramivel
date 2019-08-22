
<?php
	$attributes = !empty($attributes) ? $attributes : [];
   $name1 = explode('#', $name);
   $name = implode('', $name1);
	$value = !empty($value) ? $value : old($name);
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="form-group">
       <div class="form-line {{ $errors->has(trim($name,'[]')) ? 'focused error' : ' ' }}">
           {!! Form::textarea($name,$value,array_merge([
            'class'=>'form-control my-editor',
            'rows'=>'15',
            'placeholder' => trans('lang.'.trim($name1[0],'[]'))
            ],$attributes)) !!}
       </div>
   </div>
</div>