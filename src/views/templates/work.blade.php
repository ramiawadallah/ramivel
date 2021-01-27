@extends('layouts.frontend')

@section('content')
	@foreach(\App\Models\Page::where('uri', Request::path())->get() as $page)
	    @if($page->type == 'video')
			<header class="page-header">
				<div class="video-bg">
				<video src="{{ Storage::url($page->video) }}" autoplay muted playsinline loop></video>
				</div>
				<!-- end video-bg -->
		      <div class="container">
		        <div class="row">
		          <div class="col-12">
		            <h1>{{ $page->trans('title') }}</h1>
		            <p>{{ $page->trans('subtitle') }}</p>
		          </div>
		          <!-- end col-12 --> 
		        </div>
		        <!-- end row --> 
		      </div>
		      <!-- end container -->
		      <!-- end bottom-bar -->
		      <aside class="left-side">
		        <div class="social-links">
		          <ul>
			        <li><a href="{{ setting()->youtube }}" data-text="youtube">youtube</a></li>
			        <li><a href="{{ setting()->instagram }}" data-text="instagram">instagram</a></li>
			      </ul>
		        </div>
		        <!-- end social-links --> 
		      </aside>
		      <!-- end left-side -->
		      <aside class="right-side"> <a href="#" data-text="{{ setting()->email }}">{{ setting()->email }}</a> </aside>
		      <!-- end right-side --> 
		    </header>
		    <!-- end page-header -->
	    @else
	    	<header class="page-header">
				<div class="photo-bg">
				<img src="{{ Storage::url($page->photo) }}" >
				</div>
				<!-- end video-bg -->
		      <div class="container">
		        <div class="row">
		          <div class="col-12">
		            <h1>{{ $page->trans('title') }}</h1>
		            <p>{{ $page->trans('subtitle') }}</p>
		          </div>
		          <!-- end col-12 --> 
		        </div>
		        <!-- end row --> 
		      </div>
		      <!-- end container -->
		      <!-- end bottom-bar -->
		      <aside class="left-side">
		        <div class="social-links">
		          <ul>
			        <li><a href="{{ setting()->youtube }}" data-text="youtube">youtube</a></li>
			        <li><a href="{{ setting()->instagram }}" data-text="instagram">instagram</a></li>
			      </ul>
		        </div>
		        <!-- end social-links --> 
		      </aside>
		      <!-- end left-side -->
		      <aside class="right-side"> <a href="#" data-text="{{ setting()->email }}">{{ setting()->email }}</a> </aside>
		      <!-- end right-side --> 
		    </header>
		    <!-- end page-header -->
	    @endif


		<section  style="margin-bottom: 0px !important; margin-top: 0px !important">
		    <div class="row working justify-content-center">
		    	@foreach(\App\Models\Project::where('status','active')->get() as $project)
	                <div class="col-md-4 col-xs-12">
	                    <div class="box9">
	                        <img src="{{ Storage::url($project->photo) }}">
	                        <div class="box-content">
	                        	@foreach(\App\Models\Partner::where('id', $project->partner_id)->get() as $partner)
	                            	<a href="{{ url($page->uri.'/'.$project->uri) }}"><img src="{{ Storage::url($partner->photo) }}"></a>
	                            @endforeach
	                        </div>
	                    </div>
	                </div>
                @endforeach
		  	</div>
		</section>

		@include('partials.smallfoot')

	@endforeach()
@endsection