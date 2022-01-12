
<?php
    $name = !empty($name) ? $name : '';
    $url =  !empty($url) ? $url : 'demo/unknown_image.png' ;
?>

<div class="box m-auto">
    <div class="js--image-preview" style="background-image: url({{ Storage::url($url)  }});">
    </div>
    <div class="upload-options">
      <label>
        <i class="far fa-edit icon-fa"></i>
        <input type="file" name="{{ $name }}" class="image-upload" accept="image/*" />
      </label>
    </div>
</div>

@if($errors->has($name))
  <small class="font-w600 text-danger animated fadeIn">* Data Required</small>
@endif()


    