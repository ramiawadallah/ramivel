<?php 

$lang = app()->getLocale();
$pages = \App\Models\Page::all()->toHierarchy();
?>

@foreach($pages as $page)
    @if($page->status == "active")
      <li  class="nav-item  {{Request::is($page->uri_wildcard) ? 'active' : '' }}
        {{count($page->children) ? ($page->isChild() ? '' : 'has-sub') : ''}}">

        @if(count($page->children))  
          <span>+</span>
        @endif

        <b>
          <a class="nav-link {{count($page->children) ? ($page->isChild() ? '' : '') : ''}}"
          href="{{ url($page->uri) }}" data-text="{{ $page->trans('title',$lang) }} ">
          {{ $page->trans('title',$lang) }} 
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

{{-- <li class="has-sub">
  <a href="#">Home</a>
  <ul class="sub-menu">
    <li><a href="index-2.html">Home Layout 1</a></li>
    <li><a href="index2.html">Home Layout 2</a></li>
    <li><a href="index3.html">Home Layout 3</a></li>
    <li class="has-sub-child">
      <a href="#">Header Styles</a>
      <ul class="sub-menu">
        <li><a href="page-header-style-one.html">Header Style One</a></li>
        <li><a href="page-header-style-two.html">Header Style Two</a></li>
      </ul>
    </li>
  </ul>
</li> --}}
