<?php
   $attributes = !empty($attributes) ? $attributes : [];
   $value = !empty($value) ? $value : old($name);
   $name1 = $name;
   $name = $name.$lang_id;
?>

<label for="{{ $name }}" class="control-label">{{ __(ucfirst($name1)) }}</label>
<div class="form-group">
   <div class="form-line {{ $errors->has(trim($name,'[]')) ? 'focused error' : ' ' }}">
         {!! Form::text($name,$value,array_merge([
            'id'=>'name',
            'class'=>'form-control',
            'placeholder' => __(ucfirst($name1))
            ],$attributes)) 
        !!}
   </div>
</div>

   