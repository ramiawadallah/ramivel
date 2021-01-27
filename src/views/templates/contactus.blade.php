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


		<section class="content-section contact">
	      <div class="container">
	        <div class="row align-items-center">
	          <div class="col-12">
	            <address class="contact-box">
	            <small>Address</small>
	            <p>{{ setting()->address }}</p>
	            </address>
	          </div>
	          <!-- end col-12 -->
	          <div class="col-md-4">
	            <address class="contact-box">
	            <small>Phone</small>
	            <p>{{ setting()->phone }}</p>
	            </address>
	          </div>
	          <!-- end col-4 -->
	          <div class="col-md-4">
	            <address class="contact-box">
	            <small>E-mail</small> <a href="#">{{ setting()->email }}</a>
	            </address>
	          </div>
	          <!-- end col-4 -->
	          <div class="col-md-4">
	            <address class="contact-box">
	            <small>Career</small> <a href="#">{{ setting()->email }}</a>
	            </address>
	          </div>
	          <!-- end col-4 -->
	          <div class="col-12">
	            <div class="map">
	            	 <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3384.9738887220487!2d35.856903076171875!3d31.961605072021484!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca10ec97100cd%3A0xf5331aed2a1a64ad!2sPower%20Phone!5e0!3m2!1sen!2sjo!4v1611322384940!5m2!1sen!2sjo" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="0" aria-hidden="true" tabindex="0" info="false">
	          </iframe>
	          
	              <div class="map-note">
	                <h6>Direction</h6>
	                <p>{!! $page->trans('content') !!}</p>
	                <a href="{{ setting()->map }}" class="custom-btn">
			            <svg>
			              <rect width="218" height="56" x="1" y="1" rx="0" fill="none" stroke="#ffffff"></rect>
			            </svg>
		            	<span>Direction</span>
		            </a> 
		          </div>
	              <!-- end map-note --> 
	            </div>
	            <!--   end map --> 
	          </div>
	          <!-- end col-12 -->

	         
	          <div class="contact-form col-md-6 col-xs-12 m-auto">
	              <form id="contact" name="contact" method="post" action="{{ url('send_email') }}">
	              		@CSRF
	              		<div class="row">
			                <div class="form-group col-md-6">
			                  <p>Full Name</p>
			                  <input type="text" name="name" id="name" autocomplete="off" required>
			                </div>
			                <!-- end form-group -->
			                <div class="form-group col-md-6">
			                  <p>Your E-mail Address *</p>
			                  <input type="text" name="email" id="email" autocomplete="off" required>
			                </div>

			                <div class="form-group col-md-6">
			                  <p>Your Phone *</p>
			                  <input type="text" name="phone" id="phone" autocomplete="off" required>
			                </div>

			                <div class="form-group col-md-6">
			                  <p>Email Subject *</p>
			                  <input type="text" name="subject" id="subject" autocomplete="off" required>
			                </div>

			                <div class="form-group col-md-12">
			                  <p>Write Your Project Description</p>
			                  <textarea name="message" id="message" autocomplete="off" required></textarea>
			                </div>
			            </div>
	                <!-- end form-group -->
	                <div class="form-group" style="margin-top: 15px;">
	                  <button class="m-auto btn-block" id="submit" type="submit" name="submit">SUBMIT</button>
	                </div>
	                <!-- end form-group -->
	              </form>
	              <!-- end form -->

	              <div class="form-group">
		              <div id="success" class="alert alert-success" role="alert"> 
		                Your message was sent successfully! We will be in touch as soon as we can.
		              </div>
		              <!-- end success -->
			          <div id="error" class="alert alert-danger" role="alert"> 
			            Something went wrong, try refreshing and submitting the form again.
			          </div>
		                <!-- end error --> 
	              </div>
	              <!-- end form-group --> 
	          </div>
	          <!-- end contact-form --> 

	        </div>
	        <!-- end row --> 
	      </div>
	      <!-- end container --> 
	    </section>
		<!-- end content-section -->

		@include('partials.smallfoot')
		
	@endforeach()
@endsection