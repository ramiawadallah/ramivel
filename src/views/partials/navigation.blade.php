<?php 

$lang = app()->getLocale();

?>


@foreach($pages as $page)
    @if($page->status == "active")
      <li  class="{{Request::is($page->uri_wildcard) ? '' : '' }}{{count($page->children) ? ($page->isChild() ? '' : 'dropdown') : ''}}">

        @if(count($page->children))  
          <span>+</span>
        @endif

        <b>
          <a class="{{count($page->children) ? ($page->isChild() ? '' : '') : ''}}"
        href="{{ url($page->uri) }}" data-text="{{ $page->trans('title',$lang) }} ">{{ $page->trans('title',$lang) }} 
          </a>
        </b>
        @if(count($page->children))
            <ul>
              @include('partials.navigation', ['pages' => $page->children])
            </ul>
        @endif
      </li>
    @endif
@endforeach
<!-- 
<li class="dropdown"><span>+</span><b><a href="index-2.html" data-text="Home">Home</a></b>
  <ul>
    <li><a href="index-kinetic-slider.html">Kinetic Slider</a></li>
      <li><a href="index-video-bg.html">Video Background</a></li>
   </ul>
</li> -->
