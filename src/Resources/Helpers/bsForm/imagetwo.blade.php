
<?php
    $name = !empty($name) ? $name : '';
    $path = url('/storage/app');
    $url =  !empty($url) ? $url : 'demo/unknown_image.png' ;
?>


<div class="form-group">
  <div class="main-img-preview">
    <img class="img-responsive thumbnail imgtwo-preview"   src="{{ $path.'/'.$url }}" alt="your image" />
    <!-- <img class="thumbnail img-preview" src="http://farm4.static.flickr.com/3316/3546531954_eef60a3d37.jpg" title="Preview Logo"> -->
  </div>
  <div class="input-group">
    <input id="fakeTwoUploadLogo" name="{{ $name }}" class="form-control fake-shadow" value="{{ $url }}"  placeholder="Choose File" disabled="disabled">
    <div class="input-group-btn">
      <div class="fileUpload btn btn-danger-upload fake-shadow">
        <span><i class="glyphicon glyphicon-upload"></i> {{ trans('lang.select_image') }}</span>
        <input id="imgtwo-id" name="{{ $name }}" type="file" class="attachment_two_upload" >
      </div>
    </div>
  </div>
</div>


