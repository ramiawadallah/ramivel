@extends('layouts.frontend')
@section('title') {{ transdata($page->title) }} @endsection()

@section('content')
	@if($page->view)
		{!! $page->view->render() !!}
	@else
			<?php  
            if(empty($page->photo)){
                    $photo = "unknown_image.png";
                }else{
                    $photo = $page->photo;
                }
            ?>
            <div class="shortcode-html">
              <section class="g-bg-size-cover g-bg-pos-center g-bg-cover g-bg-black-opacity-0_5--after g-color-white g-py-50 g-mb-20" style="background-image: url({{ url('storage/app/'.$photo) }});">
                <div class="container g-bg-cover__inner">
                  <header class="g-mb-20 wow animated fadeInUp">
                    <h2 class="h1 g-font-weight-300 text-uppercase">{{ transdata($page->title) }}</h2>
                  </header>

                  <ul class="u-list-inline wow animated fadeInUp">
                    <li class="list-inline-item g-mr-7">
                      <a class="u-link-v5 g-color-white g-color-primary--hover" href="{{ url('/') }}">Home</a>
                      <i class="fa fa-angle-right g-ml-7"></i>
                    </li>
                    <li class="list-inline-item g-mr-7">
                      <a class="u-link-v5 g-color-white g-color-primary--hover" href="#!">{{ strtoupper(transdata($page->title)) }}</a>
                    </li>
                  </ul>
                </div>
              </section>
            </div>

		   <div class="container clearfix">    
		   	{!! transdata($page->content) !!}
	   	 </div>
    @endif
@endsection