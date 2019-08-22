
<?php
	$attributes = !empty($attributes) ? $attributes : [];
	$values = isset($value) ? $value : [];
   $style = isset($attributes['style']) ? $attributes['style'] : 'inline';
?>


<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label class="control-label">{{ $name == null ? '': trans('lang.'.$name) }}</label>
    <div class="input-group">
        <div class="icheck-{{ $style }}">
        @foreach ($options as $key => $value)
            <label>
                <input type="checkbox" @if(in_array($value, $values)) checked @endif name="{{ $key }}" value="{{ $value }}" class="icheck" data-checkbox="icheckbox_square-grey"> {{ trans('lang.'.$labels[$key]) }} 
            </label>
        @endforeach
            
        </div>
    </div>
</div>

