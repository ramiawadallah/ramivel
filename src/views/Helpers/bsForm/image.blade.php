
<?php
    $name = !empty($name) ? $name : '';
    $url =  !empty($url) ? $url : 'demo/unknown_image.png' ;
?>

<div class="container">
    <div class="avatar-upload">
        <div class="avatar-edit">
            <input type='file' id="imageUpload" value="{{ $url }}" name="{{ $name }}" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"><i style="font-size: 20px; position: absolute; left: 7px; top: 8px;" class="far fa-edit"></i></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url({{ Storage::url($url)  }});">
            </div>
        </div>
    </div>
</div>
@if($errors->has($name))
  <small class="font-w600 text-danger animated fadeIn">* Data Required</small>
@endif()


    