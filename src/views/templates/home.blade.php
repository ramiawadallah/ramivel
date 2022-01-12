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

		<!-- <section class="content-section bg-image-fixed" data-background="{{ Storage::url($page->photo) }}">
		  <div class="container">
		    <div class="row justify-content-center">
		      {{ setting()->trans('content') }}
		    </div>
		  </div>
		</section> -->

		<section class="content-section">
		  <div class="container">
		    <div class="row no-gutters justify-content-center">
		      <div class="col-12">
		        <div class="section-title">
		          <h6>Amazing collabration with amazing brands</h6>
		          <h2>Digital Partners</h2>
		        </div>
		        <!-- end section-title --> 
		      </div>

		      @foreach(\App\Models\Partner::all() as $partner)
			      <!-- end col-12 -->
			      <div class="col-lg-3 col-md-4 col-6">
			        <figure class="clients"><img src="{{ Storage::url($partner->photo) }}" alt="Image">
			          <figcaption >
			          	<!-- <span>{{ $partner->title }}</span><br> -->
			          	<a href="{{ url('partner/'.$partner->uri) }}">{{ $partner->link }}</a>
			          </figcaption>
			        </figure>
			      </div>
		      @endforeach
		      
		    </div>
		    <!-- end row --> 
		  </div>
		  <!-- end container --> 
		</section>
		<!-- end content-section -->
		
		@include('partials.bigfoot')
	@endforeach()
@endsection
