<?php 

$lang = app()->getLocale();

?>


@foreach( $pages as $page)
    <li  class="nav-item {{Request::is($page->uri_wildcard) ? '' : '' }}{{count($page->children) ? ($page->isChild() ? 'nav-item' : 'dropdown') : ''}}">
      
    <a class="{{count($page->children) ? ($page->isChild() ? 'dropdown-item' : 'nav-link dropdown-toggle') : 'nav-link'}}" 
    	href="{{ url($page->uri) }}">{{ $page->trans('title',$lang) }} </a>
      
      @if(count($page->children))
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @include('partials.navigation', ['pages' => $page->children])
          </ul>
      @endif
    </li>
@endforeach


<!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="index.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Home
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="index-2.html">home 2</a></li>
        <li><a class="dropdown-item" href="index-3.html">home 3</a></li>
    </ul>
</li> -->