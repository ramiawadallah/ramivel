@php 
   $url = !empty($url) ? $url : url()->current();
@endphp

<div class="fb-share-button" data-href="{{ $url }}" data-layout="button_count" data-mobile-iframe="true"></div>