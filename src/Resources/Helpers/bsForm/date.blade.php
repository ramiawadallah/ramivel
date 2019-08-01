<?php
   $attributes = !empty($attributes) ? $attributes : [];
   $name1 = explode('#', $name);
   $name = implode('', $name1);
   $value = !empty($value) ? $value : old($name);
?>

<div class="input-group {{ $errors->has(trim($name,'[]')) ? ' has-error' : '' }}">

   @if($errors->has(trim($name,'[]')))
      <i class="fa fa-warning tooltips" data-original-title="{{ $errors->first($name) }}"></i>
   @endif

   {!! Form::text($name,$value,array_merge([
      'class'=>'form-control input-lg datepicker',
      'data-format'=>'D, dd MM yyyy',
      'placeholder' => trans('lang.'.trim($name1[0],'[]'))
      ],$attributes)) !!}
</div>  


<?php
   $attributes = !empty($attributes) ? $attributes : [];
   $value = !empty($value) ? $value : old($name);
?>
