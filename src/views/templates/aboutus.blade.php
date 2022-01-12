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

	    @if(\App\Models\Service::count() >= 1)
	     <section class="content-section">
		  <div class="container">
		    <div class="row justify-content-center">
		      <div class="col-12">
		        <div class="section-title">
		          <h6>Introduction of  user interface</h6>
		          <h2>Solutions</h2>
		        </div>
		        <!-- end section-title --> 
		      </div>
		      <!-- end col-12 -->

		      @foreach(\App\Models\Service::where('status', 'active')->get() as $key => $service)
		      <div class="col-lg-4">
		        <div class="icon-content-list-block">
		          <figure><img src="{{ Storage::url($service->photo) }}" alt="Image"></figure>
		          <small>@if($key >= 10){{ $key+1 }}@else 0{{ $key+1 }} @endif</small>
		          <h5>{{ $service->trans('title') }}</h5>
		          @if($service->show_more == 'yes')
		          	<!-- <p>{!! str_limit($service->trans('content'), 100) !!}</p> -->
		          	<a href="{{ url('service/'.$service->uri) }}" class="custom-btn">
			            <svg>
			              <rect width="218" height="56" x="1" y="1" rx="0" fill="none" stroke="#000"></rect>
			            </svg>
			            <span style="color:#000 !important;">Read More</span> 
			        </a>
			       @endif	
		        </div>
		        <!-- end icon-content-list-block --> 
		       @endforeach
		      </div>
		    </div>
		    <!-- end row --> 
		  </div>
		  <!-- end container --> 
		</section>
		<!-- end content-section -->
		@endif

	      <section class="content-section no-spacing">
		  <div class="container">
		    <div class="row align-items-center no-gutters">
		      <div class="col-lg-6">
		        <div class="left-side-content">
		          <div class="inner">
		            <p>
		            	{!! $page->trans('content') !!}
		            </p>
		            <a href="{{ url('work') }}" class="custom-btn">
		            <svg>
		              <rect width="218" height="56" x="1" y="1" rx="0" fill="none" stroke="#ffffff"></rect>
		            </svg>
		            <span>SEE ALL PROJECTS</span> </a> </div>
		          <!-- inner --> 
		        </div>
		        <!-- end left-side-content --> 
		      </div>
		      <!-- end col-6 -->
		      <div class="col-lg-6">
		        <figure class="right-side-image"> <img src="{{ Storage::url($page->photo) }}" alt="Image" class="image">
		          <!-- <figcaption> 
		          	<img src="images/logo-awwwards.png" alt="Image"> <small>Award Winning Website</small> 
		          </figcaption> -->
		        </figure>
		        <!-- end right-side-image --> 
		      </div>
		      <!-- end col-6 --> 
		    </div>
		    <!-- end row --> 
		  </div>
		  <!-- end container --> 
		  
		</section>


		<section class="content-section">
			  <div class="container">
			    <div class="row">
			      <div class="col-12">
			        <div class="section-title">
			          <h2>In the Office</h2>
			        </div>
			        <!-- end section-title --> 
			      </div>
			      <!-- end col-12 -->
			      @foreach(\App\Models\Team::all() as $team)
			      		<div class="col-lg-3 col-md-6">
					        <figure class="team"> 
					          <img src="{{ Storage::url($team->photo) }}" alt="Image">
					          <figcaption>
					          	<img src="{{ Storage::url($team->cover) }}" alt="Image">
					            <h5>{{ $team->name }}</h5>
					            <small>{{ $team->title }}</small>
					            <ul>
					              <li><a href="#"><i class="fab fa-github"></i></a></li>
					              <li><a href="#"><i class="fab fa-slack"></i></a></li>
					              <li><a href="#"><i class="fab fa-medium-m"></i></a></li>
					              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
					              <li><a href="#"><i class="fab fa-behance"></i></a></li>
					            </ul>
					          </figcaption>
					        </figure>
				      	</div>
			      @endforeach
			  </div>
			</div>
		</section>

		@include('partials.smallfoot')
		
	@endforeach()
@endsection