
<?php
   $attributes = !empty($attributes) ? $attributes : [];
   $value = !empty($value) ? $value : old($name);
   $name1 = $name;
   $name = $name.$lang_id;
?>

<!-- @if($errors->has(trim($name,'[]')))
     <i class="fa fa-warning tooltips" data-original-title=""></i><div class="alert bg-pink alert-dismissible" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     {{ $errors->first($name) }}
@endif -->

<div class="form-group">
   <div class="form-line {{ $errors->has(trim($name,'[]')) ? 'focused error' : ' ' }}">
        {!! Form::textarea($name,$value,array_merge([
        'class'=>'form-control my-editor',
        'rows'=>'15',
        'placeholder' => trans('lang.'.$name1)
        ],$attributes)) 
        !!}
   </div>
</div>
