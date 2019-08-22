<?php
   $attributes = !empty($attributes) ? $attributes : [];
   $name1 = explode('#', $name);
   $name = implode('', $name1);
   $value = !empty($value) ? $value : old($name);
?>

<div class="form-group{{ $errors->has(trim($name,'[]')) ? ' has-error' : '' }}">
   <label for="{{ $name }}" class="control-label">{{ trans('lang.'.trim($name1[0],'[]')) }}</label>
<div class="input-icon right">
   @if($errors->has(trim($name,'[]')))
   <i class="fa fa-warning tooltips" data-original-title="{{ $errors->first($name) }}"></i>
   @endif
   {!! Form::text($name,$value,array_merge([
      'class'=>'form-control input-lg',
      'placeholder' => trans('lang.'.trim($name1[0],'[]'))
      ],$attributes)) !!}
   
</div>
</div>