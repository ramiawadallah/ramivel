<?php
   $attributes = !empty($attributes) ? $attributes : [];
   $name1 = explode('#', $name);
   $name = implode('', $name1);
   $value = !empty($value) ? $value : old($name);
?>


<label for="{{ $name }}" class="control-label">{{ trans('lang.'.trim($name1[0],'[]')) }}</label>

<div class="form-group">
   <div class="form-line {{ $errors->has(trim($name,'[]')) ? 'focused error' : ' ' }}">  
   {!! Form::text($name,$value,array_merge([
      'class'=>'form-control input-lg',
      'data-role' =>'tagsinput',
      'placeholder' => trans('lang.'.trim($name1[0],'[]'))
      ],$attributes)) !!}
   </div>
</div>
 


