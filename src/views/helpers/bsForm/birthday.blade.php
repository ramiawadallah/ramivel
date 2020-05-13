
<?php
	$attributes = isset($attributes) ? $attributes : [];
	$values = isset($values) ? $values : [];
   $value_day =  isset($values['day']) ? $values['day'] : old('birthday_day');
   $value_month =  isset($values['month']) ? $values['month'] : old('birthday_month');
   $value_year =  isset($values['year']) ? $values['year'] : old('birthday_year');
   #########
   $days = [];
      for ($i=1; $i < 10; $i++) { $days[$i] = $i; }
      for ($i=10; $i < 32; $i++) { $days[$i] = $i; }
   $months = [];
      for ($i=1; $i < 10; $i++) { $months[$i] = $i; }
      for ($i=10; $i < 13; $i++) { $months[$i] = $i; }
   $years = [];
      for ($i=1930; $i < 2016; $i++) { $years[$i] = $i; }
?>
<label>{{ trans('lang.birthday') }}</label>
<div class="row">
   <div class="col-md-4">
      
<div class="form-group{{ $errors->has('birthday_day') ? ' has-error' : '' }}">
   <label for="birthday_day" class="control-label">{{ trans('lang.birthday_day') }}</label>
<div class="input-icon right">   
   @if($errors->has('birthday_day'))
   <i class="fa fa-warning tooltips" data-original-title="{{ $errors->first('birthday_day') }}"></i>
   @endif
   {!! Form::select('birthday_day',$days,$value_day,array_merge([
      'class'=>'form-control',
      'placeholder' => trans('lang.'.'birthday_day')
      ],$attributes)) !!}
   
</div>
</div>

   </div>
   <div class="col-md-4">
      

<div class="form-group{{ $errors->has('birthday_month') ? ' has-error' : '' }}">
   <label for="birthday_month" class="control-label">{{ trans('lang.birthday_month') }}</label>
<div class="input-icon right">   
   @if($errors->has('birthday_month'))
   <i class="fa fa-warning tooltips" data-original-title="{{ $errors->first('birthday_month') }}"></i>
   @endif
   {!! Form::select('birthday_month',$months,$value_month,array_merge([
      'class'=>'form-control',
      'placeholder' => trans('lang.'.'birthday_month')
      ],$attributes)) !!}
   
</div>
</div>

   </div>
   <div class="col-md-4">
      

<div class="form-group{{ $errors->has('birthday_year') ? ' has-error' : '' }}">
   <label for="birthday_year" class="control-label">{{ trans('lang.birthday_year') }}</label>
<div class="input-icon right">   
   @if($errors->has('birthday_year'))
   <i class="fa fa-warning tooltips" data-original-title="{{ $errors->first('birthday_year') }}"></i>
   @endif
   {!! Form::select('birthday_year',$years,$value_year,array_merge([
      'class'=>'form-control',
      'placeholder' => trans('lang.'.'birthday_year')
      ],$attributes)) !!}
   
</div>
</div>

   </div>
</div>
