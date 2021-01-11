
<?php
    $name = !empty($name) ? $name : '';
    $path = url('/uploads/');
    $url =  !empty($url) ? $url : 'unknown file' ;
?>


<div class="form-group">
    <label>{{ trans('lang.select_file') }}</label>
    <div class="input-group">
        <span class="input-group-btn">
            <span class="btn btn-default btn-file">
                Uploade File <input type="file" multiple="" id="file" name="{{ $name }}" value="{{ $url }}">
            </span>
        </span>
        <input type="text" name="{{ $name }}" class="form-control"  readonly value="{{ $url }}">
    </div>
</div>

