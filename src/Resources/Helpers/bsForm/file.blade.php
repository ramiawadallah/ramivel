
<?php
    $name = !empty($name) ? $name : '';
    $path = url('/uploads/');
    $url =  !empty($url) ? $url : 'unknown file' ;
?>


<div class="form-group">
    <label>{{ trans('lang.select_file') }}</label>
    <div class="input-group">
        <input class="col-12" type="file" multiple="" id="file" name="{{ $name }}" value="{{ $url }}">
        <br>
        <br>
        <input type="text" name="{{ $name }}" class="form-control col-12"  readonly value="{{ $url }}">
    </div>
</div>

