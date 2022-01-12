
<?php
    $name = !empty($name) ? $name : '';
    $path = url('/uploads/products/');
    $url =  !empty($url) ? $url : 'unknown_image.png' ;
?>

<div class="col-xs-12">
    <ul class = "cvf_uploaded_files"></ul>
</div>

<div class="form-group">
    <label>{{ __(ucfirst('Select image')) }}</label>
    <div class="input-group">
        <span class="input-group-btn">
            <span class="btn btn-default btn-file">
                {{ __('Select image') }} <input class = "form-control user_picked_files" type="file" multiple="" name="{{ $name }}[]">
            </span>
        </span>
        <input style="display: none;" type="text" name="{{ $name }}" class="form-control" ">
    </div>
    
</div>



