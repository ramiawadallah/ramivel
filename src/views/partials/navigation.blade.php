<?php 

$lang = app()->getLocale();

?>


@foreach($pages as $page)
    @if($page->status=="active")
      <li  class="{{Request::is($page->uri_wildcard) ? '' : '' }}{{count($page->children) ? ($page->isChild() ? '' : 'submenu') : ''}}">
          <a class="{{count($page->children) ? ($page->isChild() ? '' : 'dropdown-toggle') : ''}}"
        href="{{ url($page->uri) }}">{{ $page->trans('title',$lang) }} </a>
            @if(count($page->children))
                <ul class="submenu">
                  @include('partials.navigation', ['pages' => $page->children])
                </ul>
            @endif
      </li>
    @endif
@endforeach