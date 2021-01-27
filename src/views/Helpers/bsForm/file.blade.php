
<?php
    $name = !empty($name) ? $name : '';
    $path = url('/uploads/');
    $url =  !empty($url) ? $url : 'unknown file' ;
?>


<div class="form-group">
    <label>{{ ucfirst($name) }}</label>
    <div>
        <input type="file" multiple="" id="file" name="{{ $name }}" value="{{ $url }}">
        <input type="text" name="{{ $name }}" class="form-control"  readonly value="{{ $url }}">
    </div>
</div>

