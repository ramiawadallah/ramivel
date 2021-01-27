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


	     <!-- end page-header -->
    <section class="content-section">
      <div class="container">
        <div class="row">
          <div class="col-12">

          	@foreach($posts as $post)
            <div class="blog-post">
              <figure class="post-image">
              	<img height="400" src="{{ Storage::url($post->photo) }}" alt="Image">
              </figure>
              <!-- end post-image -->
              <div class="post-content">
                <div class="post-inner"> <small class="post-date">{{ $post->created_at->toDateTimeString() }}</small>
                  <h3 class="post-title">
                  {{ $post->trans('title') }}
              	  </h3>
                  <div class="post-author"><!-- <img  src="images/author01.jpg" alt="Image"> --> <b>by <a href="#">{{ \App\Models\Admin::where('id',$post->created_by)->first()->name }}</a></b> </div>
                  <!-- end post-author -->
                  <div class="post-link"> <a href="{{ url('blog/'.$post->uri) }}" data-text="READ MORE">READ MORE</a> </div>
                  <!-- end post-link --> 
                </div>
                <!-- end post-inner --> 
              </div>
              <!-- end post-content --> 
            </div>
            <!-- end blog-post -->
 			@endforeach


            <ul class="pagination">
              {{ $posts->links('partials.pg') }}
            </ul>
            <!-- end pagination --> 
          </div>
          <!-- end col-12 --> 
        </div>
        <!-- end row --> 
      </div>
      <!-- end container --> 
    </section>


   @include('partials.smallfoot')
		
	@endforeach()
@endsection