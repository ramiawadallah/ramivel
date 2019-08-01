@if ($breadcrumbs)
	<ul class="page-breadcrumb">
		@foreach ($breadcrumbs as $breadcrumb)
			@if ($breadcrumb->url && !$breadcrumb->last)
			<li>
		        <a href="{{{ $breadcrumb->url }}}">
		           @if($breadcrumb->first) 
		           		<i class="icon-home"></i> 
		           @else 
		           		@if (!empty($breadcrumb->icon))
		           			<i class="{{ $breadcrumb->icon }}"></i>
		           		@endif 
		           @endif 
		           {{{ $breadcrumb->title }}}
		        </a>
		        @php $align = app()->getLocale() == 'en' ? 'right' : 'left' @endphp
		        <i class="fa fa-angle-{{ $align }}"></i>
		    </li>
			@else
			<li>   
					@if($breadcrumb->first) 
		           		<i class="icon-home"></i> 
		           		@else 
		           		@if (!empty($breadcrumb->icon))
		           			<i class="{{ $breadcrumb->icon }}"></i>
		           		@endif
		            @endif 
				<span>{{{ $breadcrumb->title }}}</span> 
			</li>
			@endif
		@endforeach
	</ul>
@endif
